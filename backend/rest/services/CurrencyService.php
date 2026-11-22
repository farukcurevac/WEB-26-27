<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../utils/exceptions.php';
require_once __DIR__ . '/../../utils/Validator.php';

class CurrencyService
{
    public function convert($amount, $from = 'BAM', $to = 'EUR')
    {
        Validator::numeric($amount, 'amount', 0.01);
        $from = strtoupper(trim($from));
        $to = strtoupper(trim($to));

        $allowed = ['BAM', 'EUR', 'USD', 'GBP', 'CHF'];
        Validator::one_of($from, 'from', $allowed);
        Validator::one_of($to, 'to', $allowed);

        $baseUrl = rtrim(Config::EXTERNAL_API_URL(), '/');
        $apiKey = Config::EXTERNAL_API_KEY();
        $url = "{$baseUrl}/{$from}";

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'X-API-Key: ' . $apiKey
            ]
        ]);

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false || $curlError !== '') {
            throw new ExternalServiceException("External currency service timed out or is unreachable.");
        }

        $data = json_decode($response, true);
        if ($httpCode >= 400 || !is_array($data) || !isset($data['rates'][$to])) {
            throw new ExternalServiceException("Failed to retrieve valid exchange rate from external API.");
        }

        $rate = (float) $data['rates'][$to];
        return [
            'from' => $from,
            'to' => $to,
            'amount' => (float) $amount,
            'rate' => $rate,
            'converted_amount' => round((float) $amount * $rate, 2)
        ];
    }
}