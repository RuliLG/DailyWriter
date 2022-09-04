<?php

namespace App\Actions\Writing;

use App\Actions\Ipfs\StoreOnIpfs;
use App\Models\User;
use App\Models\Writing;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreWriting
{
    use AsAction;

    public function handle(string $content, string $date, User $user): Writing
    {
        return Writing::updateOrCreate([
            'user_id' => $user->id,
            'date' => $date,
        ], [
            'hash' => StoreOnIpfs::run($content),
            'word_count' => str_word_count(strip_tags($content), 0, '1234567890'),
        ]);
    }
}
