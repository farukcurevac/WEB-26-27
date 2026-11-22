<?php

Flight::route('GET /currency/convert', function () {
    $query = Flight::request()->query;
    $amount = $query['amount'] ?? null;
    $from = $query['from'] ?? 'BAM';
    $to = $query['to'] ?? 'EUR';

    Flight::json(Flight::currency_service()->convert($amount, $from, $to));
});