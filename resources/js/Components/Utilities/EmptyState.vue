<script setup>
import { XCircleIcon } from "@heroicons/vue/20/solid/index.js";

defineProps({
    message: {
        type: String,
        required: false,
        default: 'No data to show',
    },
    description: {
        type: String,
        required: false,
        default: 'Please add some data to show',
    },
})
</script>

<template>
    <div class="p-6 text-center">
        <XCircleIcon class="mx-auto h-12 w-12 text-gray-400"/>

        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">{{ message }}</h3>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ description }}</p>
        <div class="mt-6">
            <slot></slot>
        </div>
    </div>
</template>

