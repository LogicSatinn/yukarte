<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EmptyState from "@/Components/Utilities/EmptyState.vue";
import {Head, Link} from "@inertiajs/vue3";
import {PlusIcon} from "@heroicons/vue/20/solid/index.js";

defineProps({
    routine: Array,
})
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Routine"/>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Routine</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div v-if="routine.length > 0">

                        </div>
                        <div v-else>
                            <EmptyState>
                                <Link
                                    :href="route('routine.create')"
                                    class="flex flex-row items-center justify-center bg-yukarte-500 text-white px-4 py-2 rounded-md text-sm font-medium"
                                >
                                    <PlusIcon class="w-5 h-5"/>
                                    Create Routine
                                </Link>
                            </EmptyState>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
