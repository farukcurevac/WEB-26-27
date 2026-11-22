<?php

use OpenApi\Annotations as OA;

class PaymentPaths
{
    /**
     * @OA\Get(
     *     path="/payments",
     *     tags={"payments"},
     *     summary="Get all payments",
     *     @OA\Response(response=200, description="List of all payments", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Payment")))
     * )
     */
    public function getPayments() {}

    /**
     * @OA\Get(
     *     path="/payments/{id}",
     *     tags={"payments"},
     *     summary="Get payment by ID",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Payment details", @OA\JsonContent(ref="#/components/schemas/Payment")),
     *     @OA\Response(response=404, description="Payment not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getPaymentsById() {}

    /**
     * @OA\Get(
     *     path="/orders/{id}/payment",
     *     tags={"orders", "payments"},
     *     summary="Get payment for a specific order",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Order payment details", @OA\JsonContent(ref="#/components/schemas/Payment")),
     *     @OA\Response(response=404, description="Order or payment not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getOrdersByIdPayment() {}

    /**
     * @OA\Post(
     *     path="/payments",
     *     tags={"payments"},
     *     summary="Record a payment for an order",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/PaymentInput")),
     *     @OA\Response(response=201, description="Payment created", @OA\JsonContent(ref="#/components/schemas/Payment")),
     *     @OA\Response(response=400, description="Validation error or duplicate payment", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="Order not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function postPayments() {}

    /**
     * @OA\Put(
     *     path="/payments/{id}",
     *     tags={"payments"},
     *     summary="Update a payment",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/PaymentInput")),
     *     @OA\Response(response=200, description="Payment updated", @OA\JsonContent(ref="#/components/schemas/Payment")),
     *     @OA\Response(response=400, description="Validation error", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="Payment not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function putPaymentsById() {}

    /**
     * @OA\Delete(
     *     path="/payments/{id}",
     *     tags={"payments"},
     *     summary="Delete a payment",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Payment deleted", @OA\JsonContent(ref="#/components/schemas/Message")),
     *     @OA\Response(response=404, description="Payment not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function deletePaymentsById() {}
}