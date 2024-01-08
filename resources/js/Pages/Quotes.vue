<script setup lang="ts">
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref, reactive, onMounted, computed } from "vue";

const quoteData = ref([]);
const deactive = reactive([])

interface QuoteItem {
    quote: string;
}

const isButtonDisabled = (item: QuoteItem): boolean => {
    return deactive.includes(item.quote);
}

const quotes = async (): Promise<void> => {
    const response = await fetch("http://localhost/api/quotes");
    if (!response.ok) {
        throw new Error(`Error en la solicitud: ${response.status}`);
    }
    quoteData.value = await response.json();
};

const selection = (item: QuoteItem): void => {

    deactive.push(item.quote);

    axios.post('http://localhost/api/quote', {
        quote: item.quote
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.status}`);
            }
        })
        .catch((error) => {
            console.log(error)
        })
}

onMounted(() => {
    quotes();
});
</script>

<template>
    <Head title="Quotes" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Quotes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-row-reverse">
                            <div class="w-24">
                                <button class="w-full bg-green-600 text-white p-2" @click="quotes()">Reload</button>
                            </div>
                        </div>

                        <div class="container max-w-4xl px-4 mx-auto sm:px-8">
                            <div class="py-8">
                                <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
                                    <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                                        <table class="min-w-full leading-normal">
                                            <thead>
                                                <tr>
                                                    <th scope="col"
                                                        class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                        Quotes
                                                    </th>
                                                    <th scope="col"
                                                        class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in quoteData" :key="index">
                                                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                        <div class="flex items-center">
                                                            <div class="ml-3">
                                                                <p class="text-gray-900 whitespace-no-wrap">
                                                                    {{ item.quote }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                        <button
                                                            :class="isButtonDisabled(item) ? 'bg-red-600 text-white p-2' : 'bg-sky-600 text-white p-2'"
                                                            class="w-full"
                                                            @click="selection(item)" :disabled="isButtonDisabled(item)">
                                                            {{ isButtonDisabled(item) ? 'Added' : 'Add Favorite' }}
                                                        </button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
