<script lang="ts">
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";

export default {
    components: {
        BreezeAuthenticatedLayout, Head
    },
    props: {
        favorites: Object
    },
    setup() {
        const destroy = (id: number): void => {
            if (confirm('Are you sure?')) {
                Inertia.delete(route('favorites.destroy',id));
            }
        }

        return { destroy }
    }

    // const items = computed(() => usePage().props.value.favorites);

    // const destroy = async (itemId) => {

    //     if (confirm('Are you sure?')) {
    //         await Inertia.delete(route('favorites.destroy',itemId));
    //         Inertia.reload()
    //     }
    }
</script>

<template>
    <Head title="Favorites" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Favorites
            </h2>

            <table>
                <thead>
                    <th>Quote</th>
                    <th>Action</th>
                </thead>
                <tbody class="bg-white divide-y divide-grey-200 divide-solid">
                    <tr v-for="item in favorites" :key="item['quote']">
                        <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-grey-500">{{ item['quote'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-grey-500">
                            <button class="bg-red-600 p-2 text-white" @click="destroy(item['id'])">
                                Trash
                            </button>
                        </td>
                    </tr>
                </tbody>

            </table>
        </template>
    </BreezeAuthenticatedLayout>
</template>
