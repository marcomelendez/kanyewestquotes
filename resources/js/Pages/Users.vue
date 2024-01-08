<script lang="ts">
import ComponentButton from '@/Components/Button.vue';
import ComponentLayout from "@/Layouts/Admin.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

export default {
    components: {
        ComponentButton, ComponentLayout
    },
    props: {
        users: Object
    },
    setup() {

        const status = (value:boolean): string => {

            return value ? 'ACTIVO' : 'INACTIVO'
        }

        return {
            ComponentButton, ComponentLayout, status
        }
    },
}
</script>

<template>
     <Head title="Dashboard" />
    <ComponentLayout>
        <ComponentErrors class="mb-4" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <!-- {{ user.name }} -->
            </h2>
        </template>

        <div class="max-w-4xl mx-auto sm:px-4 lg:px-8 bg-white my-3 p-3">
            <table>
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Active</th>
                    <th>Action</th>
                </thead>
                <tbody class="bg-white divide-y divide-grey-200 divide-solid">
                    <tr v-for="item in users" :key="item.id">
                        <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-grey-500">{{ item.name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-grey-500">{{ item.email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-grey-500">{{ status(item.active) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-grey-500">
                            <button class="bg-red-600 p-2 text-white" @click="destroy(item['id'])">
                                Expel user
                            </button>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </ComponentLayout>
</template>
