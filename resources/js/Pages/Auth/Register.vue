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
                <p class="text-green-dark text-xl mt-4">
                    500 palabras (2 páginas) diarias.<br />
                    La técnica The Morning Pages es un ejercicio de autoconocimiento y desbloqueo. Se diseñó originalmente para ayudar a los artistas para superar sus bloqueos creativos. Sin embargo este hábito diario es valioso para todos los aspectos de la vida, desde el matrimonio hasta la crianza de los hijos y los factores estresantes diarios relacionados con el trabajo. Cualquiera puede comenzar a escribir "Morning Page´s para inyectar claridad, enfoque y dirección en sus vidas. <br />
                    500 palabras a diario supone que en 40 días podrías tener tu libro de 20.000 palabras. <br /><br />
                    Queremos acompañarte en el camino.
                </p>
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
                        <BreezeCheckbox required v-model:checked="form.terms" />
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
