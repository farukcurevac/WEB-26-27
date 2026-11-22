<?php

use OpenApi\Annotations as OA;

class OrderItemPaths
{
    /**
     * @OA\Get(
     *     path="/order-items",
     *     tags={"order-items"},
     *     summary="List all order items or filter by order_id",
     *     @OA\Parameter(name="order_id", in="query", required=false, description="Filter items by order ID", example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="List of order items", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/OrderItem"))),
     *     @OA\Response(response=404, description="Order not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getOrderItems() {}

    /**
     * @OA\Get(
     *     path="/orders/{id}/items",
     *     tags={"orders", "order-items"},
     *     summary="Get items of a specific order",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Order items", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/OrderItem"))),
     *     @OA\Response(response=404, description="Order not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getOrdersByIdItems() {}

    /**
     * @OA\Get(
     *     path="/order-items/{id}",
     *     tags={"order-items"},
     *     summary="Get order item by ID",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Order item details", @OA\JsonContent(ref="#/components/schemas/OrderItem")),
     *     @OA\Response(response=404, description="Order item not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getOrderItemsById() {}

    /**
     * @OA\Post(
     *     path="/order-items",
     *     tags={"order-items"},
     *     summary="Create a new order item",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/OrderItemInput")),
     *     @OA\Response(response=201, description="Order item created", @OA\JsonContent(ref="#/components/schemas/OrderItem")),
     *     @OA\Response(response=400, description="Validation error", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function postOrderItems() {}

    /**
     * @OA\Put(
     *     path="/order-items/{id}",
     *     tags={"order-items"},
     *     summary="Update an order item",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/OrderItemInput")),
     *     @OA\Response(response=200, description="Order item updated", @OA\JsonContent(ref="#/components/schemas/OrderItem")),
     *     @OA\Response(response=400, description="Validation error", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="Order item not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function putOrderItemsById() {}

    /**
     * @OA\Delete(
     *     path="/order-items/{id}",
     *     tags={"order-items"},
     *     summary="Delete an order item",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Order item deleted", @OA\JsonContent(ref="#/components/schemas/Message")),
     *     @OA\Response(response=404, description="Order item not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function deleteOrderItemsById() {}
}