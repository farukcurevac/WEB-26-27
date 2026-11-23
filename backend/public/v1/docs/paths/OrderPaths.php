<?php

use OpenApi\Annotations as OA;

class OrderPaths
{
    /**
     * @OA\Get(
     *     path="/orders",
     *     tags={"orders"},
     *     summary="List all orders or filter by user_id",
     *     @OA\Parameter(name="user_id", in="query", required=false, description="Filter orders by user ID", example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="List of orders", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Order"))),
     *     @OA\Response(response=404, description="User not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getOrders() {}

    /**
     * @OA\Get(
     *     path="/users/{id}/orders",
     *     tags={"users", "orders"},
     *     summary="Get orders of a specific user",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="User orders", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Order"))),
     *     @OA\Response(response=404, description="User not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getUsersByIdOrders() {}

    /**
     * @OA\Get(
     *     path="/orders/{id}",
     *     tags={"orders"},
     *     summary="Get order by ID",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Order details", @OA\JsonContent(ref="#/components/schemas/Order")),
     *     @OA\Response(response=404, description="Order not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getOrdersById() {}

    /**
     * @OA\Post(
     *     path="/orders",
     *     tags={"orders"},
     *     summary="Create a new order",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/OrderInput")),
     *     @OA\Response(response=201, description="Order created", @OA\JsonContent(ref="#/components/schemas/Order")),
     *     @OA\Response(response=400, description="Validation error", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function postOrders() {}

    /**
     * @OA\Post(
     *     path="/orders/checkout",
     *     tags={"orders"},
     *     summary="Checkout user cart into a new order (transactional)",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/CheckoutInput")),
     *     @OA\Response(response=201, description="Order created from cart items", @OA\JsonContent(ref="#/components/schemas/Order")),
     *     @OA\Response(response=400, description="Cart is empty or validation failed", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="User not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function postOrdersCheckout() {}

    /**
     * @OA\Put(
     *     path="/orders/{id}",
     *     tags={"orders"},
     *     summary="Update an order",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/OrderInput")),
     *     @OA\Response(response=200, description="Order updated", @OA\JsonContent(ref="#/components/schemas/Order")),
     *     @OA\Response(response=400, description="Validation error", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="Order not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function putOrdersById() {}

    /**
     * @OA\Delete(
     *     path="/orders/{id}",
     *     tags={"orders"},
     *     summary="Delete an order",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Order deleted", @OA\JsonContent(ref="#/components/schemas/Message")),
     *     @OA\Response(response=404, description="Order not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function deleteOrdersById() {}
}