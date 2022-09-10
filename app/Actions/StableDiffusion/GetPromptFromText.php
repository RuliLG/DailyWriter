<?php

namespace App\Actions\StableDiffusion;

use App\Actions\Deepl\Translate;
use App\Actions\OpenAI\SummarizeTextForPrompt;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPromptFromText
{
    use AsAction;

    public function handle(string $text): ?string
    {
        $english = Translate::run($text);
        $prompt = SummarizeTextForPrompt::run($english);
        return $prompt;
    }
}
