<?php

namespace App\Actions\OpenAI;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class SummarizeTextForPrompt
{
    use AsAction;

    public function handle(string $text): ?string
    {
        $text = strip_tags($text);
        $text = preg_replace('/\s+/', ' ', $text);

        $textIsFlagged = CheckTextModeration::run($text);
        if ($textIsFlagged) {
            return null;
        }

        $response = Http::withToken(config('services.openai.token'))
            ->asJson()
            ->post('https://api.openai.com/v1/completions', [
                'prompt' => "Text: {$text}\nSummary:",
                'model' => config('services.openai.model'),
                'max_tokens' => 150,
                'stop' => ['END', 'Summary:', 'Text:'],
            ])
            ->json();

        return Arr::get($response, 'choices.0.text');
    }
}
