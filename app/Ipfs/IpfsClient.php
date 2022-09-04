<?php

namespace App\Ipfs;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class IpfsClient {
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::withBasicAuth(config('services.ipfs.project_id'), config('services.ipfs.secret'))
            ->asMultipart()
            ->acceptJson()
            ->baseUrl(config('services.ipfs.endpoint'));
    }

    public function __call($method, $arguments)
    {
        return $this->client->{$method}(...$arguments);
    }
}
