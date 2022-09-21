<?php

namespace App\Models;

use App\Enums\SubscriptionStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use function Illuminate\Events\queueable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'trial_ends_at' => 'datetime',
    ];

    protected $appends = [
        'profile_picture_url',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(queueable(function ($customer) {
            $customer->createAsStripeCustomer();
        }));

        static::updated(queueable(function ($customer) {
            if ($customer->hasStripeId()) {
                $customer->syncStripeCustomerDetails();
            }
        }));
    }


    public function writings()
    {
        return $this->hasMany(Writing::class);
    }

    public function profilePictureUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)))
        );
    }

    public function onTrialOrSubscribed(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->trial_ends_at?->isFuture() || $this->subscribed(),
        );
    }

    public function subscriptionStatus(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->subscribed()) {
                    return SubscriptionStatus::subscribed;
                }

                if ($this->subscriptions()->count() > 0) {
                    return SubscriptionStatus::unsubscribed;
                }

                if ($this->trial_ends_at?->isFuture()) {
                    return SubscriptionStatus::onTrial;
                }

                return SubscriptionStatus::trialEnded;
            }
        );
    }
}
