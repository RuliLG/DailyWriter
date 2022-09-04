<?php

namespace App\Actions\Ipfs;

use App\Ipfs\IpfsClient;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOnIpfs
{
    use AsAction;

    public function handle(string $content): string
    {
        $ipfs = new IpfsClient();
        $response = $ipfs
            ->attach('file', $content, Str::uuid() . '.html')
            ->post('/api/v0/add?pin=false')
            ->json();

        return $response['Hash'];
    }
}
