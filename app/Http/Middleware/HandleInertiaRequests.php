<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'snackbar' => fn () => $request->session()->get('snackbar'),
                'video_url' => fn () => $request->session()->get('video_url'),
            ],
            'appName' => config('app.name'),

            // Lazily...
            'user' => function () {
                $user = Auth::user();
                return $user ? [
                    [
                        'name' => $user->name,
                    ],
                    'can' => [
                        'create' => $user->can('create', Product::class),
                        'update' => $user->can('update', Product::class),
                        'delete' => $user->can('delete', Product::class),
                    ]
                ] : null;
            }
        ]);
    }
}
