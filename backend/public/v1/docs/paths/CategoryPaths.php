<?php

use OpenApi\Annotations as OA;

class CategoryPaths
{
    /**
     * @OA\Get(
     *     path="/categories",
     *     tags={"categories"},
     *     summary="Get all categories",
     *     @OA\Response(
     *         response=200,
     *         description="List of all categories",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Category"))
     *     )
     * )
     */
    public function getCategories() {}

    /**
     * @OA\Get(
     *     path="/categories/{id}",
     *     tags={"categories"},
     *     summary="Get category by ID",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Category details", @OA\JsonContent(ref="#/components/schemas/Category")),
     *     @OA\Response(response=404, description="Category not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getCategoriesById() {}

    /**
     * @OA\Post(
     *     path="/categories",
     *     tags={"categories"},
     *     summary="Create a new category",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/CategoryInput")),
     *     @OA\Response(response=201, description="Category created", @OA\JsonContent(ref="#/components/schemas/Category")),
     *     @OA\Response(response=400, description="Validation error or duplicate name", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function postCategories() {}

    /**
     * @OA\Put(
     *     path="/categories/{id}",
     *     tags={"categories"},
     *     summary="Update a category",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/CategoryInput")),
     *     @OA\Response(response=200, description="Category updated", @OA\JsonContent(ref="#/components/schemas/Category")),
     *     @OA\Response(response=400, description="Validation error", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="Category not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function putCategoriesById() {}

    /**
     * @OA\Delete(
     *     path="/categories/{id}",
     *     tags={"categories"},
     *     summary="Delete a category",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Category deleted", @OA\JsonContent(ref="#/components/schemas/Message")),
     *     @OA\Response(response=400, description="Category still has products", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="Category not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function deleteCategoriesById() {}
}