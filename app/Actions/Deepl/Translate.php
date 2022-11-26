<?php

namespace App\Actions\Deepl;

use App\Models\Translation;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class Translate
{
    use AsAction;

    public function handle(string $text)
    {
        // we're only going to translate the first 1000 characters to reduce the cost
        $text = substr($text, 0, 1000);
        $hash = sha1($text);
        $translation = Translation::where('hash', $hash)->first();
        if ($translation) {
            return $translation->en;
        }

        $query = [
            'text' => [$text],
            'target_lang' => 'EN',
        ];

        $response = Http::withToken(config('services.deepl.token'), 'DeepL-Auth-Key')
            ->asForm()
            ->post('https://api.deepl.com/v2/translate?' . http_build_query($query), $query)
            ->throw();

        $translation = new Translation;
        $translation->hash = $hash;
        $translation->en = $response['translations'][0]['text'];
        $translation->save();

        return $translation->en;
    }
}
