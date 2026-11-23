<?php

use OpenApi\Annotations as OA;

class BrandPaths
{
    /**
     * @OA\Get(
     *     path="/brands",
     *     tags={"brands"},
     *     summary="Get all brands",
     *     @OA\Response(
     *         response=200,
     *         description="List of all brands",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Brand"))
     *     )
     * )
     */
    public function getBrands() {}

    /**
     * @OA\Get(
     *     path="/brands/{id}",
     *     tags={"brands"},
     *     summary="Get brand by ID",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Brand details", @OA\JsonContent(ref="#/components/schemas/Brand")),
     *     @OA\Response(response=404, description="Brand not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getBrandsById() {}

    /**
     * @OA\Post(
     *     path="/brands",
     *     tags={"brands"},
     *     summary="Create a new brand",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/BrandInput")),
     *     @OA\Response(response=201, description="Brand created", @OA\JsonContent(ref="#/components/schemas/Brand")),
     *     @OA\Response(response=400, description="Validation error or duplicate name", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function postBrands() {}

    /**
     * @OA\Put(
     *     path="/brands/{id}",
     *     tags={"brands"},
     *     summary="Update a brand",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/BrandInput")),
     *     @OA\Response(response=200, description="Brand updated", @OA\JsonContent(ref="#/components/schemas/Brand")),
     *     @OA\Response(response=400, description="Validation error", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="Brand not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function putBrandsById() {}

    /**
     * @OA\Delete(
     *     path="/brands/{id}",
     *     tags={"brands"},
     *     summary="Delete a brand",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Brand deleted", @OA\JsonContent(ref="#/components/schemas/Message")),
     *     @OA\Response(response=400, description="Brand still has products", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="Brand not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function deleteBrandsById() {}
}