<script setup>
import InputError from '@/Components/InputError.vue';
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

<style scoped>

    .login{
        width: 30%;
        padding: 25px
    }

    .card-body {
        width: 30vh;
    }

    .logo {
        width: 100px;
        border-radius: 20%;
    }

    .video-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -2; /* Coloca o vídeo atrás do overlay */
    }
    
    .video-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: -1; 
    }
    
    .content{
      text-align: center;
      z-index: 1;
      min-height: 100vh;
      width: 100%;
      padding-left: 50px;
      padding-top: 10%;
      padding-bottom: 6%;
    }

</style>

<template>
    <div class="position-relative min-vh-100 d-flex align-items-center justify-content-center">
        
        <video autoplay loop muted playsinline playbackRate="0.75" class="video-background">
            <source src="../../../../public/assets/video/background.mp4" type="video/mp4">
            Seu navegador não suporta vídeos em HTML5.
        </video>
        <div class="video-overlay"></div>

        <div class="content">
                <div class="card login">
                    

                        <div class="text-nowrap logo-img text-center d-block py-3 w-100">
                            <img src="../../../../public/assets/img/qrmessage.jpg" alt="AdminLTE Logo" class=" opacity-75 shadow logo" />
                        </div>

                        <form @submit.prevent="submit">
                            <div class="mt-4">
                                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                                    autofocus autocomplete="username" 
                                    placeholder="Email" />
    
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4">
                                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                                    required autocomplete="current-password" 
                                    placeholder="Senha" />
    
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>
                            
                            <div class="mt-4 mb-4">
                                <PrimaryButton :class="{ 'opacity-25': form.processing}"
                                    :disabled="form.processing">
                                    Log in
                                </PrimaryButton>
                            </div>

                            <hr>
    
                            <div class="mt-2 mb-2">
                                Esqueceu a senha? Clique
                                <Link v-if="canResetPassword" :href="route('password.request')">
                                aqui
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</template>
