<script setup>
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { useForm, usePage } from '@inertiajs/vue3';

    const page = usePage();
    const holding = page.props.holding;
    const user = page.props.auth.user; // Pega o usuário autenticado

    const form = useForm({
        limit: holding.limit,
    });

    const submit = () => {
        form.patch(route('profile.updateHolding'), {
            preserveScroll: true,
        });
    };
</script>

<template>
    <section>
        <h5>Sistema</h5>
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Limite de QRCodes gerados</div>
            </div>

            <form @submit.prevent="submit">
                <div class="card-body">

                    <div>
                        <TextInput id="limit" type="number" v-model="form.limit"/>
                        <InputError class="mt-2" :message="form.errors.limit" />
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