<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import SmallEditButton from '@/Components/SmallEditButton.vue';
  import SmallRemoveButton from '@/Components/SmallRemoveButton.vue';
  import NavLink from '@/Components/NavLink.vue';
  import Pagination from '@/Components/Pagination.vue';
  import TextInput from '@/Components/TextInput.vue';
  import { ref, watch } from 'vue';
  import { router, usePage } from '@inertiajs/vue3';
  import Modal from '@/Components/Modal.vue';
  import SecondaryButton from '@/Components/SecondaryButton.vue';
  import DangerButton from '@/Components/DangerButton.vue';
  import { useForm } from '@inertiajs/vue3';
  import Info from '@/Components/Info.vue';
  import { computed } from 'vue';
  import Limit from '@/Components/Limit.vue'; 

  const page = usePage();
  const messages = page.props.messages;
  const alert = !!page.props.alert;
  const search = ref(usePage().props.search || ''); 
  

  // Deletando
    const messageId = ref(null);
    const confirmingDeletion = ref(false);

    function defineMessageId(id){
      messageId.value = id;
      console.log(messageId.value, id);
      confirmingDeletion.value = true;
    }

    function removeRow(id) {
        const element = document.getElementById("messages" + id);
        if (element) {
            element.classList.add("d-none");
            console.log("messages" + id);
        }
    }

    const closeModal = () => {
        confirmingDeletion.value = false;
        setTimeout(() => {
            formDelete.clearErrors();
            formDelete.reset();
        }, 100);

    };

  watch(messageId, (newId) => {
    formDelete.id = newId;
  });

  const formDelete = useForm({
    id: messageId.value,
  });

  const deleteMessage = () => {
      formDelete.delete(route('message.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
            removeRow(messageId.value);
            router.reload({ only: ['Messages'] }); //Corrected
          },
        onFinish: () => formDelete.reset(),
      });
  };

</script>

<template>
    <AuthenticatedLayout>
        <Info/>

        <Limit v-if="alert"/>

        <div class="card card-primary card-outline mb-4">
            <div class="card-body">
              <div class="float-end">
                {{ search }}
                <TextInput v-model="search" id="search" type="text" placeholder="Pesquisar..."/>
              </div>
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Uuid</th>
                    <th scope="col">Mensagem</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(message, ) in messages.data" :key="message.id" :id="`messages${message.id}`">
                    <th>{{ message.id }}</th>
                    <th>{{ message.uuid }}</th>
                    <th>{{ message.message.slice(0, 100) }}...</th>
                    <td class="d-flex">
                      <NavLink :href="route('message.edit', { message_uuid: message.uuid })">
                        <SmallEditButton />
                      </NavLink>
                      <SmallRemoveButton @click="defineMessageId( message.id )"></SmallRemoveButton>
                    </td>
                  </tr>
                </tbody>
              </table>
              <Pagination class="float-end mt-3" :links="page.props.messages.links" />
            </div>
          </div>

          <Modal :show="confirmingDeletion" @close="closeModal">
            <div class="p-6">
                <h4>Você está certo de que quer remover esse registro?</h4>
                <p class="mt-1 text-sm text-gray-600">Esse processo não pode ser revertido!</p>

                <div class="mt-3">
                    <SecondaryButton @click="closeModal">
                        Cancelar
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        @click="deleteMessage"
                    >
                        Apagar registro
                    </DangerButton>
                </div>
            </div>
        </Modal>



    </AuthenticatedLayout>
</template>
