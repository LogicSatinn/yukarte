<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, useForm} from "@inertiajs/vue3";

const form = useForm({
    routine: null,
});

function submit() {
    form.post(route('routine.store'));
}
</script>

<template>
    <Head title="New Routine"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">New Routine</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form class="gap-y-3" @submit.prevent="submit">
                            <div class="gap-y-2 flex flex-col md:flex-row md:items-center justify-start md:justify-between">
                                <label for="routine" class="block gap-y-1">
                                    <span class="block text-sm font-normal text-gray-600">Upload your routine</span>
                                    <input
                                        type="file"
                                        id="routine"
                                        @input="form.routine = $event.target.files[0]"
                                        class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yukarte-500 file:text-white hover:file:bg-yukarte-600"
                                    />
                                </label>

                                <button type="submit" class="w-20 bg-yukarte-500 text-sm font-semibold text-white rounded-md px-4 py-2">
                                    Submit
                                </button>
                            </div>
                            <div>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 tracking-wide">Yaml only.</p>
                                <p v-if="form.errors.routine" class="mt-1 text-sm text-red-600 dark:text-red-300 tracking-wide">{{ form.errors.routine }}</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
