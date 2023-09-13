<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EmptyState from "@/Components/Utilities/EmptyState.vue";
import {Head, Link} from "@inertiajs/vue3";
import {PlusIcon} from "@heroicons/vue/20/solid/index.js";
import {PaperClipIcon} from "@heroicons/vue/20/solid/index.js";
import {ChevronRightIcon} from "@heroicons/vue/20/solid/index.js";

defineProps({
    routine: Object,
})
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Routine"/>

        <template #header>
            <div class="flex flex-row items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Routine</h2>

                <Link
                    class="gap-x-1 flex flex-row items-center text-sm font-semibold py-2 px-4 rounded-md bg-yukarte-600 text-white"
                    :href="route('routine.create')"
                >
                    <PlusIcon class="w-5 h-5" />

                    <span class="text-sm font-semibold text-white">
                        New Routine
                    </span>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div
                            v-if="Object.values(routine).length > 0"
                            v-for="(lifts, day) in routine"
                            :key="day"
                        >
                            <div class="overflow-hidden bg-white mt-4 shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ day }}</h3>
                                </div>
                                <div class="border-t border-gray-200 px-4 py-5 sm:px-6" >
                                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2" v-for="(liftDetails, liftType) in lifts" :key="liftType">
                                        <div v-if="liftType.toLowerCase().startsWith('main')" class="py-2 sm:col-span-2">
                                            <dt class="text-sm font-medium text-gray-500">Main Lifts</dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                <ul class="space-y-3 text-sm" v-for="liftName in liftDetails">
                                                    <li class="flex space-x-1">
                                                        <ChevronRightIcon class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" />
                                                        <span class="text-sm text-gray-900 dark:text-gray-400">
                                                          {{ liftName }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </dd>
                                        </div>
                                        <div v-if="liftType.toLowerCase().startsWith('secondary')" class="py-2 sm:col-span-2">
                                            <dt class="text-sm font-medium text-gray-500">Secondary Lifts</dt>
                                            <dd class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2 mt-1 px-2 py-1 text-sm text-gray-900">
                                                <div class="sm:col-span-1" v-for="(liftStats, liftName) in liftDetails">
                                                    <dt class="text-sm font-medium text-gray-500">{{ liftName }}</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">
                                                        <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                                            <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                                                <div class="flex w-0 flex-1 items-center">
                                                                    <span class="ml-2 w-0 flex-1 truncate">Percentage based on training max</span>
                                                                </div>
                                                                <div class="ml-4 flex-shrink-0">
                                                                    <span class="font-medium text-gray-600 hover:text-gray-500">{{ liftStats.percentage_based_on_training_max }}</span>
                                                                </div>
                                                            </li>
                                                            <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                                                <div class="flex w-0 flex-1 items-center">
                                                                    <span class="ml-2 w-0 flex-1 truncate">Sets</span>
                                                                </div>
                                                                <div class="ml-4 flex-shrink-0">
                                                                    <span class="font-medium text-gray-600 hover:text-gray-500">{{ liftStats.sets }}</span>
                                                                </div>
                                                            </li>
                                                            <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                                                <div class="flex w-0 flex-1 items-center">
                                                                    <span class="ml-2 w-0 flex-1 truncate">Reps</span>
                                                                </div>
                                                                <div class="ml-4 flex-shrink-0">
                                                                    <span class="font-medium text-gray-600 hover:text-gray-500">{{ liftStats.reps }}</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </dd>
                                                </div>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <EmptyState>
                                <Link
                                    :href="route('routine.create')"
                                    class="flex flex-row items-center justify-center bg-yukarte-500 text-white px-4 py-2 rounded-md"
                                >
                                    <PlusIcon class="w-5 h-5"/>

                                    <span class="text-sm font-semibold text-white">
                                        Create Routine
                                    </span>
                                </Link>
                            </EmptyState>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
