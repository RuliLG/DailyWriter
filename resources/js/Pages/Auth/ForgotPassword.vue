<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import Card from '@/Components/Card.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <BreezeGuestLayout logoColor="text-green-dark" backgroundColor="bg-grey" backgroundImage="/assets/banner3.png">
        <template #banner>
            <Card class="relative w-full max-w-2xl">
                <h2 class="text-2xl text-green-dark font-bold">¿Necesitas inspiración?</h2>
                <p class="text-green-dark text-xl mt-4">Nam id dignissim purus, sit amet posuere est. Vivamus sit amet eros ut nulla ornare fermentum eu eget nisi. Aliquam erat volutpat. Nam congue dapibus vestibulum. Donec in aliquet diam, at semper arcu. Pellentesque consectetur tellus sollicitudin feugiat porta. Donec in ex congue, euismod arcu vitae, consectetur turpis.</p>
            </Card>
        </template>
        <template #default>
            <Head title="Forgot Password" />
            <h2 class="text-2xl text-green-dark font-bold text-center">Recupera tu contraseña</h2>
            <p class="text-primary-1000 mt-4 text-center">Introduce tu email para que podamos enviarte el enlace para restablecer la contraseña.</p>

            <div v-if="status" class="mt-4 font-medium text-lg text-center text-green-dark">
                {{ status }}
                <Link :href="route('login')">
                    <BreezeButton class="w-full mt-4">Iniciar sesión</BreezeButton>
                </Link>
            </div>

            <form v-else @submit.prevent="submit">
                <div>
                    <BreezeLabel for="email" value="Email" />
                    <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                    <BreezeInputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <BreezeButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Restablecer contraseña
                    </BreezeButton>
                </div>
            </form>
        </template>
    </BreezeGuestLayout>
</template>
