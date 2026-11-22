<?php

use OpenApi\Annotations as OA;

class CurrencyPaths
{
    /**
     * @OA\Get(
     *     path="/currency/convert",
     *     tags={"currency"},
     *     summary="Convert currency using external exchange rate API",
     *     @OA\Parameter(name="amount", in="query", required=true, description="Amount to convert", example=329, @OA\Schema(type="number", format="float")),
     *     @OA\Parameter(name="from", in="query", required=false, description="Source currency (BAM, EUR, USD, GBP, CHF)", example="BAM", @OA\Schema(type="string")),
     *     @OA\Parameter(name="to", in="query", required=false, description="Target currency (BAM, EUR, USD, GBP, CHF)", example="EUR", @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Converted currency result", @OA\JsonContent(ref="#/components/schemas/CurrencyConversion")),
     *     @OA\Response(response=400, description="Invalid amount or unsupported currency", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=503, description="External currency API unreachable or timed out", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getCurrencyConvert() {}
}