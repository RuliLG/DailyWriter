<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import Card from '@/Components/Card.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <BreezeGuestLayout logoColor="text-green-dark" backgroundColor="bg-yellow-light" backgroundImage="/assets/banner1.png">
        <template #banner>
            <Card class="relative w-full max-w-2xl">
                <h2 class="text-2xl text-green-dark font-bold">¿Necesitas inspiración?</h2>
                <p class="text-green-dark xl:text-xl mt-4">
                    500 palabras (2 páginas) diarias.<br />
                    La técnica The Morning Pages es un ejercicio de autoconocimiento y desbloqueo. Se diseñó originalmente para ayudar a los artistas para superar sus bloqueos creativos. Sin embargo este hábito diario es valioso para todos los aspectos de la vida, desde el matrimonio hasta la crianza de los hijos y los factores estresantes diarios relacionados con el trabajo. Cualquiera puede comenzar a escribir "Morning Page´s para inyectar claridad, enfoque y dirección en sus vidas. <br />
                    500 palabras a diario supone que en 40 días podrías tener tu libro de 20.000 palabras. <br /><br />
                    Queremos acompañarte en el camino.
                </p>
            </Card>
        </template>
        <template #default>
            <Head title="Log in" />
            <h2 class="text-2xl text-green-dark font-bold text-center">Accede</h2>
            <form @submit.prevent="submit">
                <div>
                    <BreezeLabel for="email" value="Email" />
                    <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                    <BreezeInputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <BreezeLabel for="password" value="Password" />
                    <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                    <BreezeInputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600">Recordar mi usuario</span>
                    </label>
                </div>

                <BreezeButton class="w-full mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Iniciar Sesión
                </BreezeButton>
                <div class="h-px bg-grey-dark w-full my-6"></div>
                <div class="text-center flex justify-center items-center flex-col space-y-4">
                    <Link :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        ¿Olvidaste tu contraseña?
                    </Link>
                    <Link :href="route('register')" class="text-sm text-primary-1000 hover:text-gray-900">
                        ¿No tienes cuenta? <span class="font-bold underline">Regístrate</span>
                    </Link>
                </div>
            </form>
        </template>
    </BreezeGuestLayout>
</template>
