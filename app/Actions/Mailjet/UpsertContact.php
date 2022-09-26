<?php

namespace App\Actions\Mailjet;

use App\Models\User;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Mailjet\LaravelMailjet\Facades\Mailjet;
use Mailjet\Resources;

class UpsertContact
{
    use AsAction;

    public function handle(User $user)
    {
        if (CheckIfContactExists::run($user)) {
            try {
                Mailjet::put(Resources::$Contact, [
                    'id' => $user->mailjet_id,
                    'body' => [
                        'Name' => $user->name,
                        'IsExcludedFromCampaigns' => $user->is_excluded_from_campaigns ?? false,
                    ],
                ]);
            } catch (\Exception $e) {
                // ... content not changed
            }
        } else {
            $response = Mailjet::createContact([
                'Name' => $user->name,
                'Email' => $user->email,
                'IsExcludedFromCampaigns' => $user->is_excluded_from_campaigns ?? false,
            ]);

            $response = $response->getData();
            if (isset($response[0])) {
                $response = $response[0];
            }

            if (! isset($response['ID'])) {
                throw new Exception('Mailjet contact creation failed');
            }

            $user->mailjet_id = $response['ID'];
            $user->save();
        }

        Mailjet::createListRecipient([
            'ContactID' => $user->mailjet_id,
            'ListID' => config('services.mailjet.list_id'),
        ]);
    }
}
