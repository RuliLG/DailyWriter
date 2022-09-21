<template>
    <Head title="Suscribirme" />
    <BreezePaywallLayout>
        <div class="w-full max-w-xl bg-white p-8 relative rounded-xl shadow-2xl">
            <h1 class="font-bold text-green-dark text-center text-2xl">{{ $page.props.paywall.title }}</h1>
            <p class="text-center text-primary-900 mt-4">{{ $page.props.paywall.text }}</p>
            <ul class="w-full max-w-xs mx-auto mt-8">
                <li class="flex items-center justify-start">
                    <svg class="mr-3 flex-shrink-0" width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.9403 0.940003C14.2221 0.671781 14.597 0.523497 14.986 0.526441C15.3749 0.529384 15.7476 0.683325 16.0252 0.955779C16.3029 1.22823 16.4638 1.59789 16.4741 1.98675C16.4844 2.37561 16.3432 2.75326 16.0803 3.04L8.10032 13.02C7.9631 13.1678 7.79748 13.2864 7.61338 13.3687C7.42927 13.4511 7.23046 13.4954 7.02882 13.4992C6.82718 13.5029 6.62686 13.4659 6.43983 13.3905C6.2528 13.315 6.08291 13.2026 5.94032 13.06L0.648315 7.768C0.500942 7.63068 0.382737 7.46508 0.300753 7.28108C0.218769 7.09708 0.174685 6.89845 0.171132 6.69705C0.167578 6.49564 0.204628 6.29558 0.28007 6.10881C0.355512 5.92203 0.467801 5.75236 0.610239 5.60993C0.752676 5.46749 0.922344 5.3552 1.10912 5.27976C1.2959 5.20432 1.49595 5.16727 1.69736 5.17082C1.89877 5.17437 2.09739 5.21846 2.28139 5.30044C2.46539 5.38243 2.63099 5.50063 2.76832 5.648L6.95632 9.834L13.9023 0.984004C13.9148 0.968606 13.9282 0.953916 13.9423 0.940003H13.9403Z" fill="#4CAF50"/>
                    </svg>
                    <p class="text-primary-900">Escribe sin límites</p>
                </li>
                <li class="flex items-center justify-start">
                    <svg class="mr-3 flex-shrink-0" width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.9403 0.940003C14.2221 0.671781 14.597 0.523497 14.986 0.526441C15.3749 0.529384 15.7476 0.683325 16.0252 0.955779C16.3029 1.22823 16.4638 1.59789 16.4741 1.98675C16.4844 2.37561 16.3432 2.75326 16.0803 3.04L8.10032 13.02C7.9631 13.1678 7.79748 13.2864 7.61338 13.3687C7.42927 13.4511 7.23046 13.4954 7.02882 13.4992C6.82718 13.5029 6.62686 13.4659 6.43983 13.3905C6.2528 13.315 6.08291 13.2026 5.94032 13.06L0.648315 7.768C0.500942 7.63068 0.382737 7.46508 0.300753 7.28108C0.218769 7.09708 0.174685 6.89845 0.171132 6.69705C0.167578 6.49564 0.204628 6.29558 0.28007 6.10881C0.355512 5.92203 0.467801 5.75236 0.610239 5.60993C0.752676 5.46749 0.922344 5.3552 1.10912 5.27976C1.2959 5.20432 1.49595 5.16727 1.69736 5.17082C1.89877 5.17437 2.09739 5.21846 2.28139 5.30044C2.46539 5.38243 2.63099 5.50063 2.76832 5.648L6.95632 9.834L13.9023 0.984004C13.9148 0.968606 13.9282 0.953916 13.9423 0.940003H13.9403Z" fill="#4CAF50"/>
                    </svg>
                    <p class="text-primary-900">Genera imágenes que reflejen tus pensamientos con IA</p>
                </li>
                <li class="flex items-center justify-start">
                    <svg class="mr-3 flex-shrink-0" width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.9403 0.940003C14.2221 0.671781 14.597 0.523497 14.986 0.526441C15.3749 0.529384 15.7476 0.683325 16.0252 0.955779C16.3029 1.22823 16.4638 1.59789 16.4741 1.98675C16.4844 2.37561 16.3432 2.75326 16.0803 3.04L8.10032 13.02C7.9631 13.1678 7.79748 13.2864 7.61338 13.3687C7.42927 13.4511 7.23046 13.4954 7.02882 13.4992C6.82718 13.5029 6.62686 13.4659 6.43983 13.3905C6.2528 13.315 6.08291 13.2026 5.94032 13.06L0.648315 7.768C0.500942 7.63068 0.382737 7.46508 0.300753 7.28108C0.218769 7.09708 0.174685 6.89845 0.171132 6.69705C0.167578 6.49564 0.204628 6.29558 0.28007 6.10881C0.355512 5.92203 0.467801 5.75236 0.610239 5.60993C0.752676 5.46749 0.922344 5.3552 1.10912 5.27976C1.2959 5.20432 1.49595 5.16727 1.69736 5.17082C1.89877 5.17437 2.09739 5.21846 2.28139 5.30044C2.46539 5.38243 2.63099 5.50063 2.76832 5.648L6.95632 9.834L13.9023 0.984004C13.9148 0.968606 13.9282 0.953916 13.9423 0.940003H13.9403Z" fill="#4CAF50"/>
                    </svg>
                    <p class="text-primary-900">Otra cosa más</p>
                </li>
            </ul>

            <div class="flex justify-center mt-12">
                <a :href="route('subscribe')" class="inline-flex text-center justify-center items-center px-4 py-2 bg-primary-700 border border-transparent rounded font-semibold text-sm text-white hover:bg-primary-600 active:bg-primary-800 focus:outline-none focus:border-primary-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                    Suscríbete ahora (5€)
                </a>
            </div>
        </div>
    </BreezePaywallLayout>
</template>

<script>
import BreezePaywallLayout from '@/Layouts/Paywall.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeButton from '@/Components/Button.vue';


export default {
    name: 'Write',
    components: {
        Head,
        Link,
        BreezePaywallLayout,
        BreezeButton,
    },
    data () {
        return {
        }
    },
    mounted () {

    },
    computed: {
    },
    methods: {

    }
}
</script>
