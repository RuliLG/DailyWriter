<script setup>
import { computed } from 'vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Card from '@/Components/Card.vue';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <BreezeGuestLayout logoColor="text-white" backgroundColor="bg-green-dark" backgroundImage="/assets/banner2.png">
        <template #banner>
            <Card class="relative w-full max-w-2xl">
                <h2 class="text-2xl text-green-dark font-bold">¿Necesitas inspiración?</h2>
                <p class="text-green-dark text-xl mt-4">Nam id dignissim purus, sit amet posuere est. Vivamus sit amet eros ut nulla ornare fermentum eu eget nisi. Aliquam erat volutpat. Nam congue dapibus vestibulum. Donec in aliquet diam, at semper arcu. Pellentesque consectetur tellus sollicitudin feugiat porta. Donec in ex congue, euismod arcu vitae, consectetur turpis.</p>
            </Card>
        </template>
        <template #default>
            <Head title="Email Verification" />

            <div class="mb-4 text-sm text-gray-600">
                Muchas gracias por registrarte! Antes de empezar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte por email?
            </div>

            <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent" >
                Te hemos enviado un nuevo enlace de verificación.
            </div>

            <form @submit.prevent="submit">
                <div class="mt-4 flex items-center justify-between">
                    <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Reenviar correo de verificación
                    </BreezeButton>

                    <Link :href="route('logout')" method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900">Cerrar sesión</Link>
                </div>
            </form>
        </template>
    </BreezeGuestLayout>
</template>
