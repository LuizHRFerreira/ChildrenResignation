<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    descriptions: '',
    value: '',
    start_date: '',
    end_date: '',
});

const createExample = () => {
    console.log(1);
}
</script>

<template>
    <div>
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Novo exemplo</div>
            </div>

            <form @submit.prevent="createExample" class="mt-6 space-y-6">
                <div class="card-body">

                    <div>
                        <InputLabel for="name" value="Nome:" />
                        <TextInput id="name" ref="name" v-model="form.name" type="text" class="mt-1 block w-full" autocomplete="name" />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="value" value="Valor:" />
                        <TextInput id="value" ref="value" v-model="form.value" type="text" class="mt-1 block w-full" autocomplete="value" />
                        <InputError :message="form.errors.value" class="mt-2" />
                    </div>
                    
                    <div>
                        <InputLabel for="value" value="Valor:" />
                        <TextInput id="value" ref="value" v-model="form.value" type="text" class="mt-1 block w-full" autocomplete="value" />
                        <InputError :message="form.errors.value" class="mt-2" />
                    </div>
                </div>
            </form>

        </div>
    </div>
</template>