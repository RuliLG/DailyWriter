<template>
    <div
        class="min-h-screen relative grid md:grid-cols-10"
        :class="[backgroundColor].join(' ')"
    >
        <div class="px-4 py-8 md:px-8 lg:px-16 xl:px-32 relative flex items-center justify-center md:col-span-5 lg:col-span-6">
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-fixed" :style="{ backgroundImage: `url('${backgroundImage}')`}"></div>
            <div class="bg-gradient-to-t from-gradient to-transparent absolute inset-0"></div>
            <slot name="banner"></slot>
        </div>
        <div class="p-4 order-first md:p-8 lg:p-16 flex flex-col items-center justify-center md:col-span-5 lg:col-span-4 md:order-none">
            <div class="w-full">
                <Link href="/" class="block mx-auto">
                    <BreezeApplicationLogo class="mx-auto w-auto h-20 block" :class="[logoColor].join(' ')" />
                </Link>
                <Card class="mt-8 max-w-md mx-auto">
                    <slot></slot>
                </Card>
            </div>
        </div>
    </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import Card from '@/Components/Card.vue';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    name: 'AuthScreen',
    components: {
        Link,
        BreezeApplicationLogo,
        Card,
    },
    props: {
        logoColor: {
            type: String,
            default: 'text-white',
        },
        backgroundImage: {
            type: String,
            default: '',
        },
        backgroundColor: {
            type: String,
            default: 'bg-primary-500',
        },
    }
}
</script>>
