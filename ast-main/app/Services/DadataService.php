<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use function App\Helpers\collectR;

class DadataService
{
    public function __construct()
    {
        $this->token = config('dadata.token');
        $this->secret = config('dadata.secret');
        $this->timeout = config('dadata.timeou');
        $this->url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party";
    }

    public function getOrganizationByInn($inn)
    {
        $response  = $this->dadataRequest($inn);
        return collectR(json_decode($response, true) ?? [])?->get('suggestions')?->first() ?? null;
    }

    public function dadataRequest($inn)
    {

        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => "Token " . $this->token,
        ])->post($this->url, [
            'query' => $inn,
        ])->body();
    }

}
