<?php

namespace App\Actions\StableDiffusion;

use App\Models\Writing;
use Lorisleiva\Actions\Concerns\AsAction;
use RuliLG\StableDiffusion\Prompt;
use RuliLG\StableDiffusion\StableDiffusion;

class GenerateWritingImages
{
    use AsAction;

    public function handle(Writing $writing)
    {
        $prompt = GetPromptFromText::run($writing->content);
        if (!$prompt) {
            return;
        }

        $result = StableDiffusion::make()
            ->withPrompt(
                Prompt::make()
                    ->with($prompt)
                    ->abstractArt()
                    ->digitalPaint()
                    ->resolution8k()
                    ->trendingOnArtStation()
                    ->photograph()
                    ->hyperrealistic()
                    ->postProcessing()
                    ->octaneRender()
            )
            ->width(1024)
            ->height(768)
            ->generate(4);

        $writing->stable_diffusion_result_id = $result->id;
        $writing->save();
    }
}
