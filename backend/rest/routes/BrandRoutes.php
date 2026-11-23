<?php

Flight::route('GET /brands', function () {
    Flight::json(Flight::brand_service()->get_all());
});

Flight::route('GET /brands/@id:[0-9]+', function ($id) {
    Flight::json(Flight::brand_service()->get_by_id($id));
});

Flight::route('POST /brands', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::brand_service()->add($data), 201);
});

Flight::route('PUT /brands/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::brand_service()->update($data, $id));
});

Flight::route('DELETE /brands/@id:[0-9]+', function ($id) {
    Flight::brand_service()->delete($id);
    Flight::json(['message' => 'Brand deleted.']);
});