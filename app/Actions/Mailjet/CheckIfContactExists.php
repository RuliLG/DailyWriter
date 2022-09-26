<?php

namespace App\Actions\Mailjet;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Mailjet\LaravelMailjet\Facades\Mailjet;

class CheckIfContactExists
{
    use AsAction;

    public function handle(User $user)
    {
        try {
            $contact = Mailjet::getSingleContact($user->email);
            $body = $contact->getBody();
        } catch (\Exception $e) {
            return false;
        }

        if (isset($body) && $body['Count'] === 1 && ! $user->mailjet_id) {
            $data = $body['Data'][0];
            $user->mailjet_id = $data['ID'];
            $user->save();
        }

        return true;
    }
}
