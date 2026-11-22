<?php

use OpenApi\Annotations as OA;

class CartItemPaths
{
    /**
     * @OA\Get(
     *     path="/cart-items",
     *     tags={"cart-items"},
     *     summary="List all cart items or filter by user_id",
     *     @OA\Parameter(name="user_id", in="query", required=false, description="Filter cart items by user ID", example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="List of cart items", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CartItem"))),
     *     @OA\Response(response=404, description="User not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getCartItems() {}

    /**
     * @OA\Get(
     *     path="/users/{id}/cart",
     *     tags={"users", "cart-items"},
     *     summary="Get cart items of a specific user",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="User cart items", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CartItem"))),
     *     @OA\Response(response=404, description="User not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getUsersByIdCart() {}

    /**
     * @OA\Get(
     *     path="/cart-items/{id}",
     *     tags={"cart-items"},
     *     summary="Get cart item by ID",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Cart item details", @OA\JsonContent(ref="#/components/schemas/CartItem")),
     *     @OA\Response(response=404, description="Cart item not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getCartItemsById() {}

    /**
     * @OA\Post(
     *     path="/cart-items",
     *     tags={"cart-items"},
     *     summary="Add item to cart",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/CartItemInput")),
     *     @OA\Response(response=201, description="Cart item created", @OA\JsonContent(ref="#/components/schemas/CartItem")),
     *     @OA\Response(response=400, description="Validation error", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="User or product not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function postCartItems() {}

    /**
     * @OA\Put(
     *     path="/cart-items/{id}",
     *     tags={"cart-items"},
     *     summary="Update cart item",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/CartItemInput")),
     *     @OA\Response(response=200, description="Cart item updated", @OA\JsonContent(ref="#/components/schemas/CartItem")),
     *     @OA\Response(response=400, description="Validation error", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="Cart item not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function putCartItemsById() {}

    /**
     * @OA\Delete(
     *     path="/cart-items/{id}",
     *     tags={"cart-items"},
     *     summary="Delete cart item",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Cart item deleted", @OA\JsonContent(ref="#/components/schemas/Message")),
     *     @OA\Response(response=404, description="Cart item not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function deleteCartItemsById() {}
}