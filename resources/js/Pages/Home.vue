<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {ref} from 'vue'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'

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
                        class="absolute top-0 left-0 w-full h-auto py-2 duration-300 ease-out bg-fuchsia-100 shadow-sm sm:p-6 sm:h-10">
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
        <Dialog as="div" class="relative z-10" @close="openModal = false">
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"/>
            </TransitionChild>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100"
                        leave="ease-in duration-200"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                        <DialogPanel
                            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                        <DialogTitle as="h3" class="text-sm font-semibold text-gray-900">
                                            When will this cycle start?
                                        </DialogTitle>
                                        <div class="mt-2">
                                            <form >
                                                <label for="starting_date" class="sr-only">Starting Date</label>
                                                <input
                                                    type="date"
                                                    v-model="form.starting_date"
                                                    id="starting_date"
                                                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-yukarte-500 focus:ring-yukarte-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                                                />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button
                                    type="button"
                                    class="inline-flex w-full justify-center rounded-md bg-yukarte-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yukarte-500 sm:ml-3 sm:w-auto"
                                    @click="handleSubmission"
                                >
                                    Proceed
                                </button>
                                <button
                                    type="button"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                    @click="openModal = false"
                                    ref="cancelButtonRef"
                                >
                                    Cancel
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
