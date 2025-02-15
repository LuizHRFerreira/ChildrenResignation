<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<style>
    .card-body {
        width: 30vh;
    }

    .logo {
        width: 60px;
    }
</style>

<template>
    <div class="position-relative min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center">
            <div class="card auth-card">
                <div class="card-body">
                    <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                        <img src="../../../../public/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow logo" />
                    </a>
                    <p class="text-center">Sign in to start your session</p>
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="email" value="Email" />

                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                                autofocus autocomplete="username" />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password" value="Password" />

                            <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                                required autocomplete="current-password" />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="mt-4 block">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ms-2 text-sm text-gray-600">Remember me</span>
                            </label>
                        </div>

                        <div class="mt-2 mb-2">
                            <Link v-if="canResetPassword" :href="route('password.request')">
                            Forgot your password?
                            </Link>
                        </div>

                        <div class="mt-2 mb-2">
                            <Link :href="route('register')">
                            Don't have an account?
                            </Link>
                        </div>

                        <div>
                            <PrimaryButton :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Log in
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
