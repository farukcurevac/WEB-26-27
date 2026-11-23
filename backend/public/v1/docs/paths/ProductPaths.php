<?php

use OpenApi\Annotations as OA;

class ProductPaths
{
    /**
     * @OA\Get(
     *     path="/products",
     *     tags={"products"},
     *     summary="List or filter products",
     *     @OA\Parameter(name="brand_id", in="query", required=false, description="Only products of this brand", example=1, @OA\Schema(type="integer")),
     *     @OA\Parameter(name="category_id", in="query", required=false, description="Only products of this category", example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="List of products", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Product"))),
     *     @OA\Response(response=400, description="Invalid filter parameter", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="Brand or category not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getProducts() {}

    /**
     * @OA\Get(
     *     path="/products/{id}",
     *     tags={"products"},
     *     summary="Get product by ID",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Product details", @OA\JsonContent(ref="#/components/schemas/Product")),
     *     @OA\Response(response=404, description="Product not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getProductsById() {}

    /**
     * @OA\Post(
     *     path="/products",
     *     tags={"products"},
     *     summary="Create a new product",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ProductInput")),
     *     @OA\Response(response=201, description="Product created", @OA\JsonContent(ref="#/components/schemas/Product")),
     *     @OA\Response(response=400, description="Validation error", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="Brand or category not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function postProducts() {}

    /**
     * @OA\Put(
     *     path="/products/{id}",
     *     tags={"products"},
     *     summary="Update a product",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ProductInput")),
     *     @OA\Response(response=200, description="Product updated", @OA\JsonContent(ref="#/components/schemas/Product")),
     *     @OA\Response(response=400, description="Validation error", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="Product not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function putProductsById() {}

    /**
     * @OA\Delete(
     *     path="/products/{id}",
     *     tags={"products"},
     *     summary="Delete a product",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Product deleted", @OA\JsonContent(ref="#/components/schemas/Message")),
     *     @OA\Response(response=404, description="Product not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function deleteProductsById() {}
}