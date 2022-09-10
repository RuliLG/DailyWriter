<?php

namespace App\Actions\OpenAI;

use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class CheckTextModeration
{
    use AsAction;

    public function handle(string $text): bool
    {
        return Http::withToken(config('services.openai.token'))
            ->asJson()
            ->post('https://api.openai.com/v1/moderations', [
                'input' => $text,
            ])
            ->json('results.0.flagged', true);
    }
}
