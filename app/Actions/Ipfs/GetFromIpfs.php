<?php

namespace App\Actions\Ipfs;

use App\Ipfs\IpfsClient;
use Lorisleiva\Actions\Concerns\AsAction;

class GetFromIpfs
{
    use AsAction;

    public string $commandSignature = 'ipfs:get';

    public function handle(string $hash): ?string
    {
        $ipfs = new IpfsClient();
        $response = $ipfs->post('/api/v0/cat?arg=' . $hash)->body();

        $json = json_decode($response, true);
        if ($json && isset($json['Type']) && $json['Type'] === 'error') {
            return null;
        }

        return $response;
    }
}
