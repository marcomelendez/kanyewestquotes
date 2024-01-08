<script setup>
import ComponentButton from '@/Components/Button.vue';
import ComponentLayout from "@/Layouts/Authenticated.vue";
import ComponentInput from '@/Components/Input.vue';
import ComponentLabel from '@/Components/Label.vue';
import ComponentErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";


const props = defineProps({
    user: Object
});


const form = useForm({
    name: props.user.name,
    address: props.user.address,
    phone_number: props.user.phone_number,
    terms: false,
});

const submit = () => {
    form.put(route('profile.update',props.user.id), {
        //onFinish: () => form.reset('password', 'password_confirmation'),
    });
};


</script>

<template>
    <Head title="Profile" />
    <ComponentLayout>
        <ComponentErrors class="mb-4" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <!-- {{ user.name }} -->
            </h2>
        </template>

        <div class="max-w-4xl mx-auto sm:px-4 lg:px-8 bg-white my-3 p-3">
            <form @submit.prevent="submit">
                <div>
                    <ComponentLabel for="name" value="Name" />
                    <ComponentInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                </div>
                <div>
                    <ComponentLabel for="address" value="Address (optional)" />
                    <ComponentInput id="address" type="text" class="mt-1 block w-full" v-model="form.address" autofocus autocomplete="address" />
                </div>
                <div>
                    <ComponentLabel for="phone_number" value="Phone (optional)" />
                    <ComponentInput id="phone_number" type="text" class="mt-1 block w-full" v-model="form.phone_number" autofocus autocomplete="phone number" />
                </div>
                <div class="max-w-4xl py-3 mx-auto">
                    <ComponentButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </ComponentButton>
                </div>
            </form>
        </div>
    </ComponentLayout>
</template>
