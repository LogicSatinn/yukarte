<script setup>
defineProps({
    quote: {
        type: String,
        required: true,
    },
    mainLiftsForTheDay: {
        type: Object,
        required: true,
    },
    secondaryLiftsForTheDay: {
        type: Object,
        required: true,
    },
})
</script>

<template>
    <main>
        <section>
            <div class="relative mt-8">
                <div class="lg:mx-auto lg:grid lg:max-w-7xl lg:grid-cols-2 lg:items-start lg:gap-24 lg:px-8">
                    <div class="relative sm:py-16 lg:py-0">
                        <div class="relative mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:max-w-none lg:px-0 lg:py-20">
                            <div class="relative overflow-hidden rounded-2xl pt-64 pb-10 shadow-xl">
                                <img class="absolute inset-0 h-full w-full object-cover" src="../../../images/d2587f2979b484a4bae0a2096dcb845e.png" alt="">
                                <div class="absolute inset-0 bg-yukarte-500 mix-blend-multiply"></div>
                                <div class="absolute inset-0 bg-gradient-to-t from-yukarte-300 via-yukarte-400 opacity-90"></div>
                                <div class="relative px-8">
                                    <blockquote class="mt-8">
                                        <div
                                            class="relative text-sm font-semibold leading-loose text-white underline underline-offset-4 decoration-yukarte-800 decoration-4 md:flex-grow">
                                            <p class="relative">
                                                {{ quote }}
                                            </p>
                                        </div>

                                        <footer class="mt-4">
                                            <p class="text-sm font-semibold leading-loose tracking-wide text-white">
                                                Yukarte</p>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative py-8 sm:py-16 lg:py-0">
                        <div
                            class="relative mx-auto max-w-md space-y-8 px-4 sm:max-w-3xl sm:px-6 lg:max-w-none lg:px-0 lg:py-20">
                            <ul role="list" class="grid grid-cols-1 gap-6">
                                <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow-lg"
                                    v-for="(mainLiftSpecifics, mainLiftForTheDay) in mainLiftsForTheDay"
                                    :key="mainLiftForTheDay">
                                    <div class="flex w-full items-center justify-between space-x-6 p-6">
                                        <div class="flex-1 truncate">
                                            <div class="flex items-center space-x-3">
                                                <h3 class="truncate text-base font-semibold leading-loose tracking-wide text-gray-900 uppercase underline underline-offset-4 decoration-yukarte-800 decoration-4">
                                                    {{ mainLiftForTheDay }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="-mt-px flex">
                                            <div class="flex w-0 flex-1" v-for="(item, index) in mainLiftSpecifics"
                                                 :key="index">
                                                <div
                                                    class="relative -mr-px inline-flex w-0 flex-1 items-center justify-start rounded-bl-lg border border-transparent py-4 px-6 text-sm font-medium text-gray-700 hover:text-gray-500">
                                                    <span class="ordinal slashed-zero">{{
                                                            item['reps']
                                                        }} x {{ item['volume'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <div class="border border-gray-200 shadow-lg rounded-lg bg-white px-4 py-5 sm:px-6">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900">Secondary Lifts</h3>

                                <ul role="list" class="divide-y divide-gray-200">
                                    <li class="flex items-center justify-between py-4 sm:px-0"
                                        v-for="(secondaryLiftSpecifics, secondaryLiftForTheDay) in secondaryLiftsForTheDay"
                                        :key="secondaryLiftForTheDay">
                                        <div class="flex flex-col gap-1.5">
                                            <span class="text-sm font-medium uppercase">{{
                                                    secondaryLiftForTheDay
                                                }}</span>
                                            <span class="text-xs font-bold uppercase">{{
                                                    secondaryLiftSpecifics['volume']
                                                }}KG</span>
                                        </div>

                                        <span class="text-sm font-semibold leading-loose tracking-wide">{{
                                                secondaryLiftSpecifics['sets']
                                            }} x {{ secondaryLiftSpecifics['reps'] }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
