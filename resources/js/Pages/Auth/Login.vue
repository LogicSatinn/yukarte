<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    username: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Sign in" />

    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-60 w-auto" src="../../../art/yukarte-logos_transparent.png" alt="Yukarte" />
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" @submit.prevent="submit">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <div class="mt-1">
                            <input
                                    id="username"
                                    v-model="form.username"
                                    type="text"
                                    autocomplete="username"
                                    required
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-yukarte-500 focus:outline-none focus:ring-yukarte-500 sm:text-sm"
                            />

                            <InputError class="mt-2" :message="form.errors.username" />
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1">
                            <input
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    autocomplete="current-password"
                                    required
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-yukarte-500 focus:outline-none focus:ring-yukarte-500 sm:text-sm"
                            />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" v-model="form.remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-yukarte-600 focus:ring-yukarte-500" />
                            <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
                        </div>

                        <div class="text-sm">
                            <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="font-medium text-yukarte-600 hover:text-yukarte-500"
                            >
                                Forgot your password?
                            </Link>
                        </div>
                    </div>

                    <div>
                        <button
                                type="submit"
                                :class="{'opacity-25': form.processing}"
                                :disabled="form.processing"
                                class="flex w-full justify-center rounded-md border border-transparent bg-yukarte-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-yukarte-700 focus:outline-none focus:ring-2 focus:ring-yukarte-500 focus:ring-offset-2"
                        >
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
