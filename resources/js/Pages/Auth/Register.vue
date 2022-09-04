<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import Card from '@/Components/Card.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
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
            <Head title="Register" />

            <h2 class="text-2xl text-green-dark font-bold text-center">Registrarse</h2>
            <form @submit.prevent="submit">
                <div class="mt-4">
                    <BreezeLabel for="email" value="Email" />
                    <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                    <BreezeInputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <BreezeLabel for="password" value="Password" />
                    <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                    <BreezeInputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <BreezeCheckbox v-model:checked="form.terms" />
                        <span class="ml-2 text-sm text-gray-600">He leído y acepto los términos y condiciones</span>
                    </label>
                </div>

                <BreezeButton class="w-full mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Crear cuenta
                </BreezeButton>

                <div class="flex items-center justify-center mt-4">
                    <Link :href="route('login')" class="text-sm text-primary-1000 hover:text-gray-900">
                        ¿Ya tienes una cuenta? <span class="font-bold underline">Accede</span>
                    </Link>

                </div>
            </form>
        </template>
    </BreezeGuestLayout>
</template>
