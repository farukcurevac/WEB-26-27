<?php

Flight::route('GET /payments', function () {
    Flight::json(Flight::payment_service()->get_all());
});

Flight::route('GET /payments/@id:[0-9]+', function ($id) {
    Flight::json(Flight::payment_service()->get_by_id($id));
});

Flight::route('GET /orders/@id:[0-9]+/payment', function ($id) {
    Flight::json(Flight::payment_service()->get_payment_by_order($id));
});

Flight::route('POST /payments', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::payment_service()->add($data), 201);
});

Flight::route('PUT /payments/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::payment_service()->update($data, $id));
});

Flight::route('DELETE /payments/@id:[0-9]+', function ($id) {
    Flight::payment_service()->delete($id);
    Flight::json(['message' => 'Payment deleted.']);
});