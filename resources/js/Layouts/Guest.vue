<template>
    <div
        class="min-h-screen relative grid md:grid-cols-10"
        :class="[backgroundColor].join(' ')"
    >
        <div class="col-span-6 px-32 relative flex items-center justify-center">
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-fixed" :style="{ backgroundImage: `url('${backgroundImage}')`}"></div>
            <div class="bg-gradient-to-t from-gradient to-transparent absolute inset-0"></div>
            <slot name="banner"></slot>
        </div>
        <div class="col-span-4 p-16 flex flex-col items-center justify-center">
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
