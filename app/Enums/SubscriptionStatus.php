<?php

namespace App\Enums;

enum SubscriptionStatus
{
    case onTrial;
    case trialEnded;
    case subscribed;
    case unsubscribed;

    public function paywallTitle(): string
    {
        return match($this) {
            self::onTrial => '¿Te está gustando la prueba gratuita?',
            self::trialEnded => 'El tiempo de prueba ha terminado',
            self::subscribed => '¡Gracias por tu suscripción!',
            self::unsubscribed => 'Tu suscripción ha terminado :(',
        };
    }

    public function paywallText(): string
    {
        return match($this) {
            self::onTrial => 'Suscríbete para acceder de nuevo y poder seguir plasmando tus pensamientos cada día',
            self::trialEnded => 'La prueba gratuita de 7 días ha terminado, suscríbete para acceder de nuevo y poder seguir plasmando tus pensamientos cada día',
            self::subscribed => 'Gracias a usuarios como tú podemos seguir mejorando la plataforma día a día',
            self::unsubscribed => 'Tu suscripción ha terminado, pero aún tienes acceso a todos los textos que has escrito hasta ahora',
        };
    }
}
