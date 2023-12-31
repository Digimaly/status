<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue'
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import moment from 'moment'

const props = defineProps({
    sites: Object,
    downtimes: Object,
});

// const navigation = [
//     { name: 'Product', href: '#' },
//     { name: 'Features', href: '#' },
//     { name: 'Marketplace', href: '#' },
//     { name: 'Company', href: '#' },
// ]

const mobileMenuOpen = ref(false)

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Every 5 seconds, we'll reload the page to get the latest data.
setInterval(() => {
    router.reload({
        preserveState: true,
        preserveScroll: true,
    })

    console.log('Reloaded status.');
}, 1000)
</script>

<template>
    <Head title="Welcome" />

    <header class="bg-white border-b border-base-300">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <a :href="$page.props.appHome" class="-m-1.5 p-1.5">
                <img class="h-8 w-auto" :src="$page.props.appLogo" :alt="appName" v-if="$page.props.appLogo" />
                <span class="text-xl font-bold text-gray-900" v-else>{{ appName }}</span>
            </a>
            <div class="flex lg:hidden">
                <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = true">
                    <span class="sr-only">Open main menu</span>
                    <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
<!--                <a v-for="item in navigation" :key="item.name" :href="item.href" class="text-sm font-semibold leading-6 text-gray-900">{{ item.name }}</a>-->
                <Link :href="route('login')" class="text-sm font-semibold leading-6 text-gray-900">Log in <span aria-hidden="true">&rarr;</span></Link>
            </div>
        </nav>
        <Dialog as="div" class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
            <div class="fixed inset-0 z-10" />
            <DialogPanel class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
                    </a>
                    <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
                        <span class="sr-only">Close menu</span>
                        <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
<!--                            <a v-for="item in navigation" :key="item.name" :href="item.href" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ item.name }}</a>-->
                        </div>
                        <div class="py-6">
                            <Link :href="route('login')" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</Link>
                        </div>
                    </div>
                </div>
            </DialogPanel>
        </Dialog>
    </header>

    <div class="max-w-7xl mx-auto px-2">
        <div v-if="sites.length > 0">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 my-6">
                <div v-for="site in sites" :key="site.id" class="border rounded-lg px-4 py-2">
                        <div class="flex">
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold">{{ site.name }}</h2>
                                <span class="text-base-content/75">{{ site.url }}</span>
                            </div>
                            <div class="grid grid-cols-1">
                                <div class="flex justify-end">
                                    <span v-if="!site.is_down" class="badge badge-success">
                                    Online
                                    </span>
                                    <span v-else class="badge badge-error">
                                    Offline
                                </span>
                                </div>

                                <div>
                                    <span class="text-sm text-base-content">Last checked {{ site.updated_at }}.</span>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="border-t pt-6">
                <div class="pb-5">
                    <h3 class="text-base font-semibold leading-6 text-lg text-gray-900">Downtimes</h3>
                </div>

                <div v-if="downtimes.length > 0">
                    <ul role="list" class="divide-y divide-gray-100">
                        <li v-for="downtime in downtimes" :key="downtime.id" class="flex justify-between gap-x-6 py-5">
                            <div class="flex-1">
                                <p>DOWNTIME #{{ downtime.id }}</p>
                                <div v-if="downtime.updated_at == null">
                                    <p class="text-sm text-base-content/75">Downtime started {{ downtime.created_at }}.</p>
                                </div>
                                <div v-else>
                                    <p class="text-sm text-base-content/75">Downtime ended {{ downtime.updated_at }}.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 text-right">
                                <span>
                                    <span v-if="downtime.updated_at == null" class="badge badge-error">
                                        Ongoing
                                    </span>
                                    <span v-else class="badge badge-success">
                                        Resolved
                                    </span>
                                </span>
                                <span class="text-sm text-base-content/75">Downtime lasted {{ downtime.duration }}.</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div v-else>
                    <p>There has been no downtimes.</p>
                </div>
            </div>
        </div>
        <div v-else>
            <p class="text-center text-3xl pt-12">You have not created any sites, so we cannot gather data from your sites.</p>
            <p class="text-center text-3xl py-12">If you haven't set up an account so you can manage the sites, you can run the command below:</p>
            <div class="mockup-code">
                <pre data-prefix="$">php artisan make:user</pre>
                <pre data-prefix="//">You can run this each time you need to create another user, so you can make separate accounts per user.</pre>
            </div>
        </div>
    </div>
</template>
