<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { PlusIcon } from '@heroicons/vue/20/solid'
import { GlobeAltIcon } from "@heroicons/vue/24/outline/index.js";
import {Link} from "@inertiajs/vue3";

defineProps({
    sites: Object
})
</script>

<template>
    <AppLayout title="Sites">
        <template #header>
            <div class="flex">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                    Sites
                </h2>
                <div>
                    <Link :href="route('sites.create')" class="btn btn-primary btn-sm">New Site</Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="sites.length > 0">

                </div>
                <div v-else>
                    <div class="text-center">
                        <GlobeAltIcon class="mx-auto h-12 w-12 text-gray-400" aria-hidden="true" />
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">No Sites</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by adding a site.</p>
                        <div class="mt-6">
                            <Link :href="route('sites.create')" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                <PlusIcon class="-ml-0.5 mr-1.5 h-5 w-5" aria-hidden="true" />
                                New Site
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
