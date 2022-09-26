<script setup>
import { ref } from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-white-100">
            <nav class="bg-yellow-light print:hidden">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('write')" class="text-green-dark py-4">
                                    <BreezeApplicationLogo class="block h-12 w-auto" />
                                </Link>
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden sm:flex">
                            <BreezeNavLink :href="route('write')" :active="route().current('write') || route().current('write.date')">
                                Escribir
                            </BreezeNavLink>

                            <a href="https://dailywriterme.substack.com/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center p-4 text-sm font-medium text-primary-1000 hover:bg-yellow focus:outline-none focus:bg-yellow-700 transition duration-150 ease-in-out">
                                Blog
                            </a>

                            <a href="https://discord.gg/4PTc5FzPHj" target="_blank" rel="noopener noreferrer" class="inline-flex items-center p-4 text-sm font-medium text-primary-1000 hover:bg-yellow focus:outline-none focus:bg-yellow-700 transition duration-150 ease-in-out">
                                Discord
                            </a>

                            <BreezeNavLink v-if="!$page.props.auth.subscribed" :href="route('subscribe.landing')" :active="route().current('subscribe.landing')">
                                Suscribirme
                            </BreezeNavLink>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <BreezeDropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center p-0 m-0 border border-transparent rounded-full bg-transparent focus:outline-none">
                                                <img :src="$page.props.auth.user.profile_picture_url" alt="Perfil" class="h-12 w-12 object-cover object-center rounded-full">
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <a v-if="!$page.props.auth.subscribed" :href="route('subscribe.landing')" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                            Suscribirme
                                        </a>
                                        <a :href="route('billing-portal')" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                            Portal de suscripción
                                        </a>
                                        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Cerrar sesión
                                        </BreezeDropdownLink>
                                    </template>
                                </BreezeDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('write')" :active="route().current('write')">
                            Dashboard
                        </BreezeResponsiveNavLink>
                        <a href="https://dailywriterme.substack.com/" target="_blank" rel="noopener noreferrer" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                            Blog
                        </a>
                        <a href="https://discord.gg/4PTc5FzPHj" target="_blank" rel="noopener noreferrer" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                            Discord
                        </a>
                        <BreezeResponsiveNavLink v-if="!$page.props.auth.subscribed" :href="route('subscribe.landing')" :active="route().current('subscribe.landing')">
                            Suscribirme
                        </BreezeResponsiveNavLink>
                        <a :href="route('billing-portal')" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                            Portal de suscripción
                        </a>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </BreezeResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
