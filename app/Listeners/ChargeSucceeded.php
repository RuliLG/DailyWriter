<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Laravel\Cashier\Cashier;
use Spatie\WebhookClient\Models\WebhookCall;

class ChargeSucceeded implements ShouldQueue
{
    public function handle(WebhookCall $webhookCall)
    {
        $customerId = Arr::get($webhookCall->payload, 'data.object.customer');
        $invoiceId = Arr::get($webhookCall->payload, 'data.object.invoice');
        $invoice = Cashier::stripe()->invoices->retrieve($invoiceId);
        $subscriptionId = $invoice->subscription;
        $subscription = Cashier::stripe()->subscriptions->retrieve($subscriptionId);
        $user = User::where('stripe_id', $customerId)->firstOrFail();

        $firstItem = $subscription->items->first();
        $isSinglePrice = $subscription->items->count() === 1;
        if (! $user->subscriptions()->exists()) {
            $localSubscription = $user->subscriptions()->create([
                'name' => 'default',
                'stripe_id' => $subscriptionId,
                'stripe_status' => $subscription->status,
                'stripe_price' => $isSinglePrice ? $firstItem->price->id : null,
                'quantity' => $isSinglePrice ? ($firstItem->quantity ?? null) : null,
                'trial_ends_at' => null,
                'ends_at' => date('Y-m-d H:i:s', $subscription->current_period_end),
            ]);

            /** @var \Stripe\SubscriptionItem $item */
            foreach ($subscription->items as $item) {
                $localSubscription->items()->create([
                    'stripe_id' => $item->id,
                    'stripe_product' => $item->price->product,
                    'stripe_price' => $item->price->id,
                    'quantity' => $item->quantity ?? null,
                ]);
            }
        } else {
            $localSubscription = $user->subscriptions()->first();
            $localSubscription->update([
                'stripe_id' => $subscriptionId,
                'stripe_status' => $subscription->status,
                'stripe_price' => $isSinglePrice ? $firstItem->price->id : null,
                'quantity' => $isSinglePrice ? ($firstItem->quantity ?? null) : null,
                'trial_ends_at' => null,
                'ends_at' => date('Y-m-d H:i:s', $subscription->current_period_end),
            ]);
        }
    }
}
