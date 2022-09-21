<template>
    <div
        class="relative"
    >
        <nav class="bg-white flex justify-center items-center p-4 fixed top-0 left-0 w-full z-10">
            <Link href="/" class="block mx-auto">
                <BreezeApplicationLogo class="mx-auto w-auto h-10 block text-primary-500" :class="[logoColor].join(' ')" />
            </Link>
        </nav>
        <div class="h-screen relative flex items-center justify-center py-16">
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-fixed" :style="{ backgroundImage: `url('/assets/banner3.png')` }"></div>
            <slot></slot>
        </div>
        <footer class="bg-white flex justify-center items-center p-4 fixed bottom-0 left-0 w-full z-10">
            &copy; {{ year }} dailywriter.com - Todos los derechos reservados
        </footer>
    </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import Card from '@/Components/Card.vue';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    name: 'PaywallScreen',
    components: {
        Link,
        BreezeApplicationLogo,
        Card,
    },
    computed: {
        year () {
            return new Date().getFullYear()
        },
    },
}
</script>>
