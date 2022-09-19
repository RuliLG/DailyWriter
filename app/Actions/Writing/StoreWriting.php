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
        $writing = Writing::where('user_id', $user->id)
            ->whereDate('date', $date)
            ->first();
        $hash = StoreOnIpfs::run($content);
        $wordCount = str_word_count(strip_tags($content), 0, '1234567890');
        if (!$writing) {
            $writing = Writing::create([
                'user_id' => $user->id,
                'date' => $date,
                'hash' => $hash,
                'word_count' => $wordCount,
            ]);
        } else {
            $writing->hash = $hash;
            $writing->word_count = $wordCount;
            $writing->save();
        }

        return $writing;
    }
}
