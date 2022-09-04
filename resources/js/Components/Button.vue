<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex text-center justify-center items-center px-4 py-2 bg-primary-700 border border-transparent rounded font-semibold text-sm text-white hover:bg-primary-600 active:bg-primary-800 focus:outline-none focus:border-primary-900 focus:shadow-outline-gray transition ease-in-out duration-150">
        <slot />
    </button>
</template>
