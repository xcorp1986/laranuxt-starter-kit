<?php

namespace App\Api\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Laravel OpenAPI",
 *     description="Laravel Front OpenApi"
 * )
 *
 * @OA\Parameter(
 *     name="page",
 *     description="Page offset",
 *     in="query",
 *     @OA\Schema(
 *         type="integer"
 *     )
 * )
 * @OA\Parameter(
 *     name="perPage",
 *     description="Results by page",
 *     in="query",
 *     @OA\Schema(
 *         type="integer"
 *     )
 * )
 * @OA\Parameter(
 *     name="slug",
 *     description="Identifiant URL",
 *     required=true,
 *     in="path",
 *     @OA\Schema(
 *         type="string"
 *     )
 * )
 *
 * @OA\Tag(
 *     name="cms",
 *     description="Content (post or page)"
 * )
 * @OA\Tag(
 *     name="enums",
 *     description="Enums"
 * )
 */
class ApiController extends Controller
{
    public function __construct()
    {
        app('config')->set('app.url', request()->getSchemeAndHttpHost());

        /*
         * Route bindings
         */
        Route::bind('tag', function ($slug) {
            $locale = app()->getLocale();

            return Tag::where("slug->$locale", '=', $slug)->firstOrFail();
        });

        Route::bind('post', function ($slug) {
            return Post::posts()->bySlug($slug)->firstOrFail();
        });

        Route::bind('page', function ($slug) {
            return Post::pages()->bySlug($slug)->firstOrFail();
        });
    }
}
