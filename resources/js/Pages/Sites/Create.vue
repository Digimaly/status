<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm} from "@inertiajs/vue3";
import {ref, watch} from "vue";

const props = defineProps({
    types: Object
})

const form = useForm({
    name: "",
    url: "",
    type: "http",
    siteData: ""
})

const httpData = ref({
    url: "",
    method: "GET",
    requiredBearerToken: false,
    bearerToken: "",
    headers: [],
    body: "",
    timing: 15,
});

// Watch for updates for httpData
watch(httpData, (newValue) => {
    updateFormData(httpData)
});

const updateHttpMethod = (event) => {
    httpData.value.method = event.target.value;
    updateFormData(httpData);
}

const updateHttpUrl = (event) => {
    httpData.value.url = event.target.value;
    updateFormData(httpData);
}

const updateHttpTiming = (event) => {
    httpData.value.timing = event.target.value;
    updateFormData(httpData);
}

const updateFormData = (data) => {
    form.siteData = data.value;
    console.log(form.siteData);
}

const submit = () => {
    if(form.type == 'http'){
        form.siteData = httpData.value;
    }

    form.post(route('sites.store'), {
        onSuccess: () => {
            console.log('success');
        },
        onError: () => {
            console.log('error');
            console.log('Form Errors', form.errors)
            console.log('Form Data', form)
        }
    });
}

</script>

<template>
    <AppLayout title="New Site">
        <template #header>
            <div class="flex">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                    New Site
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit">
                    <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
                        <div class="px-4 py-5 sm:p-6 space-y-2">
                            <div class="form-control">
                                <label for="name" class="label">
                                    <span class="label-text">Name</span>
                                </label>
                                <input type="text" v-model="form.name" id="url" class="input input-bordered w-full" placeholder="My Awesome Site">
                                <label class="label" v-if="form.errors.name">
                                    <span class="label-text-alt text-error">{{form.errors.name}}</span>
                                </label>
                            </div>

                            <div class="form-control">
                                <label for="url" class="label">
                                    <span class="label-text">URL</span>
                                </label>
                                <input type="text" v-model="form.url" id="url" @keyup="updateHttpUrl($event)" class="input input-bordered w-full" placeholder="https://digimaly.com">
                                <label class="label" v-if="form.errors.url">
                                    <span class="label-text-alt text-error">{{form.errors.url}}</span>
                                </label>
                            </div>

                            <div class="form-control">
                                <label for="type" class="label">
                                    <span class="label-text">Type</span>
                                </label>
                                <select v-model="form.type" id="type" class="select select-bordered w-full">
                                    <option v-for="type in types" :value="type" :key="type">
                                        {{ type }}
                                    </option>
                                </select>
                                <label class="label" v-if="form.errors.type">
                                    <span class="label-text-alt text-error">{{form.errors.type}}</span>
                                </label>
                            </div>

                            <div v-if="form.type === 'http'">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-2 gap-y-4">
                                    <div class="form-control">
                                        <label for="httpDataUrl" class="label">
                                            <span class="label-text">Ping URL</span>
                                        </label>
                                        <input type="text" v-model="httpData.url" id="httpDataUrl" @keyup="updateHttpUrl($event)" class="input input-bordered w-full" placeholder="https://digimaly.com">
                                    </div>
                                    <div class="form-control">
                                        <label for="httpDataGet" class="label">
                                            <span class="label-text">Method</span>
                                        </label>
                                        <select v-model="httpData.method" @change="updateHttpMethod($event)" id="httpDataGet" class="select select-bordered w-full">
                                            <option value="GET">GET</option>
                                            <option value="POST">POST</option>
                                            <option value="PUT">PUT</option>
                                            <option value="PATCH">PATCH</option>
                                            <option value="DELETE">DELETE</option>
                                        </select>
                                    </div>

                                    <div class="form-control">
                                        <label for="httpDataTiming" class="label">
                                            <span class="label-text">Time Between Pings</span>
                                        </label>
                                        <select v-model="httpData.timing" @change="updateHttpTiming($event)" id="httpDataGet" class="select select-bordered w-full">
                                            <option value="15">15 Seconds</option>
                                            <option value="30">30 Seconds</option>
                                            <option value="60">1 Minute</option>
                                            <option value="120">2 Minutes</option>
                                            <option value="300">5 Minutes</option>
                                            <option value="600">10 Minutes</option>
                                            <option value="900">15 Minutes</option>
                                            <option value="1800">30 Minutes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                That's not ready yet
                            </div>
                        </div>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex justify-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
