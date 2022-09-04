<template>
    <button type="button" @click="print" class="inline-flex items-center text-sm justfify-center px-4 py-2 text-primary-1000 space-x-2 print:hidden">
        <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.25 4H2.75C1.505 4 0.5 5.005 0.5 6.25V10.75H3.5V13.75H12.5V10.75H15.5V6.25C15.5 5.005 14.495 4 13.25 4ZM11 12.25H5V8.5H11V12.25ZM13.25 7C12.8375 7 12.5 6.6625 12.5 6.25C12.5 5.8375 12.8375 5.5 13.25 5.5C13.6625 5.5 14 5.8375 14 6.25C14 6.6625 13.6625 7 13.25 7ZM12.5 0.25H3.5V3.25H12.5V0.25Z" fill="#09262B"/>
        </svg>
        <span>Imprimir</span>
    </button>
</template>

<script>
export default {
    name: 'PrintButton',
    methods: {
        print () {
            window.print()
        }
    }
}
</script>
