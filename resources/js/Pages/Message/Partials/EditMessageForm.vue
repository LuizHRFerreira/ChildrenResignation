<script setup>
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextAreaInput from '@/Components/TextAreaInput.vue';
    import { useForm } from '@inertiajs/vue3';
    import { usePage } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';
    

    const page = usePage();
    const message = page.props.message;

    const form = useForm({
        id: message.id,
        uuid: message.uuid,
        message: message.message,
    });

    const updatemessage = () => {
        Swal.fire({
            title: 'Você tem certeza?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, salvar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
        form.post(route('message.update', { message_uuid: message.uuid }), {
            preserveScroll: true,
            
        })
    }
})
    }

</script>

<template>

    <div class="row card card-primary card-outline mb-4">

        <div class="card-header">
        <div class="row mb-3 mt-3">
                <div class="col-sm-6">
                    <h3 class="mb-0">Editar</h3>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-end">
                        <NavLink :href="route('message.index')" :active="route().current('message.index')">
                            <PrimaryButton>Voltar</PrimaryButton>
                        </NavLink>
                    </div>
                </div>
            </div>
        </div>

        

            <div class="col-12">
                <InputLabel for="message" value="mensagem:" />
                <TextAreaInput id="message" ref="message" v-model="form.message" type="text" autocomplete="message" maxlength="500" />
                <InputError :message="form.errors.message" class="mt-2" />

            </div>

            <div class="card-footer">
                <div class="flex items-center gap-4">

                    <PrimaryButton :disabled="form.processing" @click="updatemessage">
                        Salvar
                    </PrimaryButton>

                </div>
            </div>
    </div>

</template>

<style>

    #message{
        padding: 30px;
        font-size: 25px;
        height: 450px
    }

</style>