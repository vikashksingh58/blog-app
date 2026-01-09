<?php

namespace App\Http\Middleware;

use App\Models\UserActivity;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && ! $this->shouldIgnore($request)) {
            $this->logActivity($request);
        }

        return $next($request);
    }

    private function shouldIgnore(Request $request): bool
    {
        return $request->is([
            'storage/*',
            '_debugbar/*',
            'livewire/*',
            'favicon.ico',
            '*.css',
            '*.js',
            '*.png',
            '*.jpg',
            '*.svg'
        ]);
    }

    /**
     * Log user activity to database
     */
    private function logActivity(Request $request): void
    {
        try {
            UserActivity::create([
                'user_id' => Auth::id(),
                'activity_type' => $this->getActivityType($request),
                'description' => $this->getActivityDescription($request),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'details' => [
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'route' => $request->route()?->getName(),
                ],
            ]);
        } catch (\Exception $e) {
            // Log error but don't break the request
            logger()->error('Activity logging failed: ' . $e->getMessage());
        }
    }

    /**
     * Determine activity type from request
     */
    // private function getActivityType(Request $request): string
    // {
    //     $method = $request->method();
    //     $routeName = $request->route()?->getName() ?? '';

    //     if (str_contains($routeName, 'login')) {
    //         return 'login';
    //     }

    //     if (str_contains($routeName, 'logout')) {
    //         return 'logout';
    //     }

    //     if (str_contains($routeName, 'post')) {
    //         return match ($method) {
    //             'POST' => 'post_created',
    //             'PUT', 'PATCH' => 'post_updated',
    //             'DELETE' => 'post_deleted',
    //             default => 'post_viewed',
    //         };
    //     }

    //     if (str_contains($routeName, 'comment')) {
    //         return match ($method) {
    //             'POST' => 'comment_created',
    //             'PUT', 'PATCH' => 'comment_updated',
    //             'DELETE' => 'comment_deleted',
    //             default => 'comment_viewed',
    //         };
    //     }

    //     return 'page_visit';
    // }

    private function getActivityType(Request $request): string
    {
        if ($request->routeIs('login')) return 'login';
        if ($request->routeIs('logout')) return 'logout';

        if ($request->routeIs('posts.*')) {
            return match ($request->method()) {
                'POST' => 'post_created',
                'PUT', 'PATCH' => 'post_updated',
                'DELETE' => 'post_deleted',
                default => 'post_viewed',
            };
        }

        if ($request->routeIs('comments.*')) {
            return match ($request->method()) {
                'POST' => 'comment_created',
                'PUT', 'PATCH' => 'comment_updated',
                'DELETE' => 'comment_deleted',
                default => 'comment_viewed',
            };
        }

        return 'page_visit';
    }

    /**
     * Generate activity description
     */
    private function getActivityDescription(Request $request): string
    {
        $activityType = $this->getActivityType($request);
        $userName = Auth::user()->name;

        return match ($activityType) {
            'login' => "{$userName} logged in",
            'logout' => "{$userName} logged out",
            'post_created' => "{$userName} created a post",
            'post_updated' => "{$userName} updated a post",
            'post_deleted' => "{$userName} deleted a post",
            'post_viewed' => "{$userName} viewed a post",
            'comment_created' => "{$userName} added a comment",
            'comment_updated' => "{$userName} updated a comment",
            'comment_deleted' => "{$userName} deleted a comment",
            default => "{$userName} visited " . $request->path(),
        };
    }
}
