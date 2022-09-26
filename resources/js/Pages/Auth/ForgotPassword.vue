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
                <p class="text-green-dark text-xl mt-4">
                    500 palabras (2 páginas) diarias.<br />
                    La técnica The Morning Pages es un ejercicio de autoconocimiento y desbloqueo. Se diseñó originalmente para ayudar a los artistas para superar sus bloqueos creativos. Sin embargo este hábito diario es valioso para todos los aspectos de la vida, desde el matrimonio hasta la crianza de los hijos y los factores estresantes diarios relacionados con el trabajo. Cualquiera puede comenzar a escribir "Morning Page´s para inyectar claridad, enfoque y dirección en sus vidas. <br />
                    500 palabras a diario supone que en 40 días podrías tener tu libro de 20.000 palabras. <br /><br />
                    Queremos acompañarte en el camino.
                </p>
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
