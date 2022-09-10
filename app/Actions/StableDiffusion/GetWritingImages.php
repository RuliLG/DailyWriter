<?php

namespace App\Actions\StableDiffusion;

use App\Models\Writing;
use Lorisleiva\Actions\Concerns\AsAction;
use RuliLG\StableDiffusion\Models\StableDiffusionResult;
use RuliLG\StableDiffusion\StableDiffusion;

class GetWritingImages
{
    use AsAction;

    public function handle(Writing $writing): ?StableDiffusionResult
    {
        if ($writing->stable_diffusion_result) {
            return StableDiffusion::get($writing->stable_diffusion_result->replicate_id);
        }

        return null;
    }
}
