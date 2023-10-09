<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {ref} from 'vue'
import {Dialog, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {XMarkIcon} from "@heroicons/vue/20/solid/index.js";

defineProps({
    shouldCreateFirstCycle: Boolean,
})

const openModal = ref(false)

const form = useForm({
    starting_date: '',
})

function handleSubmission (event) {
    event.preventDefault()

    form.post(route('create-first-cycle'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            openModal.value = false;
        },
    })
}
</script>

<template>
    <Head title="Home"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Home</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div
                        v-if="shouldCreateFirstCycle"
                        class="absolute top-0 left-0 w-full h-auto py-2 duration-300 ease-out bg-fuchsia-100 shadow-sm sm:p-6 sm:h-10"
                    >
                        <div class="flex items-center justify-center w-full h-full px-3 mx-auto max-w-7xl">
                            <button
                                type="button"
                                @click="openModal = true"
                                class="flex flex-row items-center justify-between sm:justify-center w-full h-full text-xs leading-6 text-black duration-150 ease-out opacity-80 hover:opacity-100 cursor-pointer"
                            >
                                <span class="block pt-1 pb-2 leading-none sm:inline sm:pt-0 sm:pb-0">Looks like you haven't started any cycle</span>
                                <span class="hidden w-px h-4 mx-3 rounded-full sm:block bg-neutral-200"></span>
                                <span class="flex items-center">
                                    <strong class="font-semibold">Create your first cycle</strong>
                                </span>
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <TransitionRoot as="template" :show="openModal">
        <Dialog as="div" class="relative w-auto h-auto z-40">
            <div v-show="openModal" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                    >
                    <div class="absolute inset-0 w-full h-full bg-white backdrop-blur-sm bg-opacity-70"></div>
                </TransitionChild>

                <TransitionChild
                    as="div"
                    enter="ease-out duration-300"
                    enter-start="opacity-0 -translate-y-2 sm:scale-95"
                    enter-end="opacity-100 translate-y-0 sm:scale-100"
                    leave="ease-in duration-200"
                    leave-start="opacity-100 translate-y-0 sm:scale-100"
                    leave-end="opacity-0 -translate-y-2 sm:scale-95"
                    class="relative w-full py-6 bg-white border shadow-lg px-7 border-neutral-200 sm:max-w-lg sm:rounded-lg">
                    <div class="flex items-center justify-between pb-3">
                        <h3 class="text-base font-semibold capitalize tracking-wide">Cycle's starting date</h3>
                        <button @click="openModal=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                            <XMarkIcon class="w-5 h-5" />
                        </button>
                    </div>
                    <div class="relative w-auto pb-4">
                        <label for="starting_date" class="sr-only">Starting Date</label>
                        <input
                            type="date"
                            v-model="form.starting_date"
                            id="starting_date"
                            class="block w-full border-gray-200 rounded-md text-sm focus:border-yukarte-500 focus:ring-yukarte-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                        />
                    </div>
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                        <button @click="openModal=false" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-yukarte-100 focus:ring-offset-2">Cancel</button>
                        <button @click="handleSubmission" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-yukarte-900 focus:ring-offset-2 bg-yukarte-950 hover:bg-yukarte-900">Continue</button>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
