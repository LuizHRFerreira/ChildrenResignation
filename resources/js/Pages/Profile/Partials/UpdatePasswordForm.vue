<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <h5>Senha</h5>
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Atualizar senha</div>
            </div>

            <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
                <div class="card-body">
                    <div>
                        <InputLabel for="current_password" value="Senha atual" />

                        <TextInput id="current_password" ref="currentPasswordInput" v-model="form.current_password"
                            type="password" class="mt-1 block w-full" autocomplete="current-password" />

                        <InputError :message="form.errors.current_password" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="password" value="Nova senha" />

                        <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                            class="mt-1 block w-full" autocomplete="new-password" />

                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="password_confirmation" value="Confirmar nova senha" />

                        <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                            class="mt-1 block w-full" autocomplete="new-password" />

                        <InputError :message="form.errors.password_confirmation" class="mt-2" />
                    </div>

                </div>
                <div class="card-footer">
                    <div class="flex items-center gap-4">
                        <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>

                        <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                            <p v-if="form.recentlySuccessful" class="text-success">
                                Salvo!
                            </p>
                        </Transition>
                    </div>
                </div>
            </form>
        </div>

    </section>
</template>
