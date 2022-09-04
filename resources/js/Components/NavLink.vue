<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'inline-flex items-center p-4 bg-yellow text-sm font-medium text-primary-1000 focus:outline-none transition duration-150 ease-in-out'
    : 'inline-flex items-center p-4 text-sm font-medium text-primary-1000 hover:bg-yellow focus:outline-none focus:bg-yellow-700 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
