<script>
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';

import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

export default {
    components:{
        BreezeButton, BreezeInput, BreezeLabel, Link, Head
    },
    props:{
        canResetPassword: Boolean,
        status: String,
    },
    setup() {

        const form = useForm({
            email: '',
            password: '',
            remember: false
        });

        const submit = () => {
            form.post(route('admin.login'), {
                onFinish: () => form.reset('password'),
            });
        };

        return {
            form,
            submit,
        };
    },
}
</script>
<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="bg-white border py-4 px-5 mx-auto">
            <h2 class="text-lg font-bold">User Admin</h2>
        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
            </div>

            <!-- <div class="block mt-4">
                <label class="flex items-center">
                    <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div> -->

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Forgot your password?
                </Link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </BreezeButton>
            </div>
        </form>
        </div>
    </div>
</template>
