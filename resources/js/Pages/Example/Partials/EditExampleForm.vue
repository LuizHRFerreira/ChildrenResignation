<script setup>
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import TextAreaInput from '@/Components/TextAreaInput.vue';
    import { useForm } from '@inertiajs/vue3';
    import { router, usePage } from '@inertiajs/vue3';

    const page = usePage();
    const example = page.props.example;

    const form = useForm({
        name: example.name,
        descriptions: example.descriptions,
        value: example.value,
        start_date: example.start_date,
        end_date: example.end_date,
    });

    
    const updateExample = () => {
        form.post(route('example.update', { example_id: example.id }), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
            onError: () => {
            
            },
        });
    }
</script>

<template>
    <div>
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Editar exemplo</div>
            </div>

            <form @submit.prevent="updateExample" class="mt-6 space-y-6">
                <div class="card-body row">

                    <div class="col-6">
                        <InputLabel for="name" value="Nome:" />
                        <TextInput id="name" ref="nameInput" v-model="form.name" type="text" autocomplete="name" />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="col-6">
                        <InputLabel for="value" value="Valor:" />
                        <TextInput id="value" ref="value" v-model="form.value" type="text" autocomplete="value" />
                        <InputError :message="form.errors.value" class="mt-2" />
                    </div>

                    <div class="col-6">
                        <InputLabel for="start_date" value="Data inicial:" />
                        <TextInput id="start_date" ref="start_date" v-model="form.start_date" type="date" autocomplete="start_date" />
                        <InputError :message="form.errors.start_date" class="mt-2" />
                    </div>

                    <div class="col-6">
                        <InputLabel for="end_date" value="Data final:" />
                        <TextInput id="end_date" ref="end_date" v-model="form.end_date" type="date" autocomplete="end_date" />
                        <InputError :message="form.errors.end_date" class="mt-2" />
                    </div>
                    
                    <div class="col-12">
                        <InputLabel for="descriptions" value="Descrição:" />
                        <TextAreaInput id="descriptions" ref="descriptions" v-model="form.descriptions" type="text" autocomplete="descriptions" />
                        <InputError :message="form.errors.descriptions" class="mt-2" />
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
    </div>
</template>