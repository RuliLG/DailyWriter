<?php

namespace App\Actions\StableDiffusion;

use Lorisleiva\Actions\Concerns\AsAction;
use RuliLG\StableDiffusion\Models\StableDiffusionResult;
use RuliLG\StableDiffusion\StableDiffusion;

class UpdateMissingStableDiffusionResults
{
    use AsAction;

    public string $commandSignature = 'stablediffusion:update-missing-results';

    public function handle()
    {
        $results = StableDiffusionResult::unfinished()->get();
        foreach ($results as $result) {
            StableDiffusion::get($result->replicate_id);
        }
    }
}
