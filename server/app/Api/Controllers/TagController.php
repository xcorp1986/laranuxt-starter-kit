<?php

namespace App\Api\Controllers;

use App\Models\Tag;
use OpenApi\Annotations as OA;
use App\Transformers\TagTransformer;

class TagController extends ApiController
{
    /**
     * @OA\Get(
     *     path="/cms/tags",
     *     tags={"cms"},
     *     operationId="getTags",
     *     summary="Tags",
     *     description="Tags",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Tag")
     *             )
     *         )
     *     )
     * )
     *
     * @return \Spatie\Fractal\Fractal
     */
    public function index()
    {
        return fractal(Tag::all(), new TagTransformer());
    }

    /**
     * @OA\Get(
     *     path="/cms/tags/{slug}",
     *     tags={"cms"},
     *     operationId="getTag",
     *     summary="Tag detail",
     *     description="Tag detail",
     *     @OA\Parameter(ref="#/components/parameters/slug"),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Tag")
     *     )
     * )
     *
     * @param \App\Models\Tag $tag
     *
     * @return \Spatie\Fractal\Fractal
     */
    public function show(Tag $tag)
    {
        return fractal($tag, new TagTransformer());
    }
}
