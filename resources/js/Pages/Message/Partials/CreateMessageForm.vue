<script setup>
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextAreaInput from '@/Components/TextAreaInput.vue';
    import { useForm } from '@inertiajs/vue3';
    import { computed, ref } from 'vue';
    import { router, usePage } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';

    const page = usePage();
    
    const currentPath = computed(() => {
        const parts = page.url.split('/');
        const relevantParts = parts.slice(2);
        return relevantParts.join('/');
    });

    const form = useForm({ message: '', uuid: currentPath.value});
    const showForm = ref(true);

    const createMessage = () => {
        Swal.fire({
            title: 'Você tem certeza?',
            text: 'Você não poderá reverter isso!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, salvar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
        form.post(route('message.store'),{
            preserveScroll: true,
            onSuccess: () => {
                showForm.value = false;
                Swal.fire({
                    title: 'Salvo!',
                    text: 'Sua mensagem foi salva com sucesso. Atualize a página para ver o resultado',
                    icon: 'success',
                    showConfirmButton: false,
                })}})}

        });
    }   
   

</script>

<template>
    <div>
        <div class="card card-primary card-outline mb-4">
            
            <div class="card-header">
                <div class="card-title">Novo Cadastro</div>
            </div>

            <form v-if="showForm" @submit.prevent="createMessage" class="mt-6 space-y-6">
                <div class="card-body row">
                    <div class="col-12">
                        <InputLabel for="message" value="Digite aqui a mensagem:" />
                        <TextAreaInput id="message" ref="message" v-model="form.message" type="text" autocomplete="message" maxlength="500"/>
                        <InputError :message="form.errors.message" class="mt-2" />
                    </div>
                </div>

                <div class="card-footer">
                    <div class="flex items-center gap-4">

                        <PrimaryButton :disabled="form.processing">
                            Salvar
                        </PrimaryButton>

                        <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                            <p v-if="form.recentlySuccessful" class="text-success">
                            </p>
                        </Transition>
                    </div>
                </div>
            </form>

            <div v-else class="message">
                <p>Atualize a página para ver o resultado ou leia o QRCode</p>
            </div>
            
        </div>
    </div>
</template>

<style>
.message {
    padding: 30px;
    font-size: 25px;
}

</style>
