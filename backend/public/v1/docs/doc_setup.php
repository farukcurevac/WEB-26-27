<?php

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="KICKS & CO. API",
 *     description="REST API of KICKS & CO. – Online Sneaker Store – IT 2001 Web Programming.",
 *     version="1.0",
 *     @OA\Contact(name="KICKS & CO. Team", email="support@kicksco.ba")
 * )
 * @OA\Server(url=API_BASE_URL, description="This server")
 *
 * @OA\Schema(
 *     schema="Error",
 *     required={"status", "error"},
 *     @OA\Property(property="status", type="integer", example=400),
 *     @OA\Property(property="error", type="string", example="Field 'name' is required.")
 * )
 * @OA\Schema(
 *     schema="Message",
 *     @OA\Property(property="message", type="string", example="Resource deleted.")
 * )
 * @OA\Schema(
 *     schema="BrandInput",
 *     required={"name"},
 *     @OA\Property(property="name", type="string", example="New Balance"),
 *     @OA\Property(property="logo_url", type="string", example="https://example.com/nb.svg")
 * )
 * @OA\Schema(
 *     schema="Brand",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/BrandInput"),
 *         @OA\Schema(@OA\Property(property="id", type="integer", example=1))
 *     }
 * )
 * @OA\Schema(
 *     schema="CategoryInput",
 *     required={"name"},
 *     @OA\Property(property="name", type="string", example="Running"),
 *     @OA\Property(property="description", type="string", example="Performance running sneakers")
 * )
 * @OA\Schema(
 *     schema="Category",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/CategoryInput"),
 *         @OA\Schema(@OA\Property(property="id", type="integer", example=1))
 *     }
 * )
 * @OA\Schema(
 *     schema="ProductInput",
 *     required={"brand_id", "category_id", "name", "price"},
 *     @OA\Property(property="brand_id", type="integer", example=1),
 *     @OA\Property(property="category_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Nike Air Max Plus OG"),
 *     @OA\Property(property="description", type="string", example="Tuned Air cushioning classic"),
 *     @OA\Property(property="price", type="number", format="float", example=329.00),
 *     @OA\Property(property="image_url", type="string", example="https://example.com/airmax.jpg"),
 *     @OA\Property(property="is_active", type="integer", example=1)
 * )
 * @OA\Schema(
 *     schema="Product",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/ProductInput"),
 *         @OA\Schema(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="brand_name", type="string", example="Nike"),
 *             @OA\Property(property="category_name", type="string", example="Lifestyle"),
 *             @OA\Property(property="created_at", type="string", format="date-time")
 *         )
 *     }
 * )
 * @OA\Schema(
 *     schema="UserInput",
 *     required={"first_name", "last_name", "email", "password"},
 *     @OA\Property(property="first_name", type="string", example="Faruk"),
 *     @OA\Property(property="last_name", type="string", example="Curevac"),
 *     @OA\Property(property="email", type="string", example="faruk@example.com"),
 *     @OA\Property(property="password", type="string", example="Secret123")
 * )
 * @OA\Schema(
 *     schema="User",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="first_name", type="string", example="Faruk"),
 *     @OA\Property(property="last_name", type="string", example="Curevac"),
 *     @OA\Property(property="email", type="string", example="faruk@example.com"),
 *     @OA\Property(property="role", type="string", example="customer"),
 *     @OA\Property(property="created_at", type="string", format="date-time")
 * )
 * @OA\Schema(
 *     schema="CartItemInput",
 *     required={"user_id", "product_id", "size", "quantity"},
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="product_id", type="integer", example=1),
 *     @OA\Property(property="size", type="string", example="42"),
 *     @OA\Property(property="quantity", type="integer", example=1)
 * )
 * @OA\Schema(
 *     schema="CartItem",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/CartItemInput"),
 *         @OA\Schema(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="product_name", type="string", example="Nike Air Max Plus OG"),
 *             @OA\Property(property="price", type="number", format="float", example=329.00)
 *         )
 *     }
 * )
 * @OA\Schema(
 *     schema="OrderInput",
 *     required={"user_id", "shipping_address"},
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="shipping_address", type="string", example="Zmaja od Bosne 8, Sarajevo"),
 *     @OA\Property(property="status", type="string", example="pending"),
 *     @OA\Property(property="total_amount", type="number", format="float", example=329.00)
 * )
 * @OA\Schema(
 *     schema="Order",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/OrderInput"),
 *         @OA\Schema(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="created_at", type="string", format="date-time")
 *         )
 *     }
 * )
 * @OA\Schema(
 *     schema="CheckoutInput",
 *     required={"user_id", "shipping_address"},
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="shipping_address", type="string", example="Zmaja od Bosne 8, Sarajevo")
 * )
 * @OA\Schema(
 *     schema="OrderItemInput",
 *     required={"order_id", "product_id", "size", "quantity", "unit_price"},
 *     @OA\Property(property="order_id", type="integer", example=1),
 *     @OA\Property(property="product_id", type="integer", example=1),
 *     @OA\Property(property="size", type="string", example="42"),
 *     @OA\Property(property="quantity", type="integer", example=1),
 *     @OA\Property(property="unit_price", type="number", format="float", example=329.00)
 * )
 * @OA\Schema(
 *     schema="OrderItem",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/OrderItemInput"),
 *         @OA\Schema(@OA\Property(property="id", type="integer", example=1))
 *     }
 * )
 * @OA\Schema(
 *     schema="PaymentInput",
 *     required={"order_id", "payment_method", "amount"},
 *     @OA\Property(property="order_id", type="integer", example=1),
 *     @OA\Property(property="payment_method", type="string", example="card"),
 *     @OA\Property(property="amount", type="number", format="float", example=329.00),
 *     @OA\Property(property="status", type="string", example="completed")
 * )
 * @OA\Schema(
 *     schema="Payment",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/PaymentInput"),
 *         @OA\Schema(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="paid_at", type="string", format="date-time")
 *         )
 *     }
 * )
 * @OA\Schema(
 *     schema="CurrencyConversion",
 *     @OA\Property(property="from", type="string", example="BAM"),
 *     @OA\Property(property="to", type="string", example="EUR"),
 *     @OA\Property(property="amount", type="number", format="float", example=329.00),
 *     @OA\Property(property="rate", type="number", format="float", example=0.511292),
 *     @OA\Property(property="converted_amount", type="number", format="float", example=168.22)
 * )
 */
class OpenApiSpec {}