<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-digimon-logo-4">
        <div title="Logo">
            <Link href="/">
            <ApplicationLogo class="mw-10 h-50 max-h-32 mx-auto fill-current text-gray-500" />
            </Link>
        </div>

        <div class="w-7/8 max-w-9/10 my-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
