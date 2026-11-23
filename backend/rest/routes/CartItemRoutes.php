<?php

Flight::route('GET /cart-items', function () {
    $query = Flight::request()->query;
    if (isset($query['user_id'])) {
        Flight::json(Flight::cart_item_service()->get_cart_by_user($query['user_id']));
        return;
    }
    Flight::json(Flight::cart_item_service()->get_all());
});

Flight::route('GET /users/@id:[0-9]+/cart', function ($id) {
    Flight::json(Flight::cart_item_service()->get_cart_by_user($id));
});

Flight::route('GET /cart-items/@id:[0-9]+', function ($id) {
    Flight::json(Flight::cart_item_service()->get_by_id($id));
});

Flight::route('POST /cart-items', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cart_item_service()->add($data), 201);
});

Flight::route('PUT /cart-items/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cart_item_service()->update($data, $id));
});

Flight::route('DELETE /cart-items/@id:[0-9]+', function ($id) {
    Flight::cart_item_service()->delete($id);
    Flight::json(['message' => 'Cart item deleted.']);
});