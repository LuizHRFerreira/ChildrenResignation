<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SmallEditButton from '@/Components/SmallEditButton.vue';
import SmallRemoveButton from '@/Components/SmallRemoveButton.vue';
import NavLink from '@/Components/NavLink.vue';
import Pagination from '@/Components/Pagination.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import SmallAddButton from '@/Components/SmallAddButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { useForm } from '@inertiajs/vue3';

const page = usePage();
const examples = page.props.examples;
const search = ref(usePage().props.search || '');

watch(search, (newValue) => {
  router.get(route('example.index'), { search: newValue }, {
    replace: true,
    preserveState: true
  });
});



// Deletando
const exampleId = ref(null); // Reativo
const confirmingDeletion = ref(false);

function defineExampleId(id){
  exampleId.value = id;
  console.log(exampleId.value, id);
  confirmingDeletion.value = true;
}

function removeRow() {
  document.getElementById("example" + exampleId.value).classList.add("d-none");
  console.log("example" + exampleId.value);
}

const closeModal = () => {
    confirmingDeletion.value = false;
    setTimeout(() => {
        formDelete.clearErrors();
        formDelete.reset();
    }, 100);

};

// Monitora mudanças em `exampleId` e atualiza `formDelete.id`
watch(exampleId, (newId) => {
  formDelete.id = newId;
});

const formDelete = useForm({
  id: exampleId.value,
});

const deleteUser = () => {
    formDelete.delete(route('example.destroy'), {
      preserveScroll: true,
      onSuccess: () => {
          closeModal();
          router.reload({ only: ['examples'] });
          removeRow();
        },
      onFinish: () => formDelete.reset(),
    });
};
</script>

<template>
    <Head title="Examples" />
    <AuthenticatedLayout>

      <div class="row mb-3 mt-3">
          <div class="col-sm-6">
            <h3 class="mb-0">Título da página</h3>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-end">
              
              <NavLink :href="route('example.create')" :active="route().current('example.create')">
                  <SmallAddButton>Novo</SmallAddButton>
              </NavLink>
            </div>
          </div>
        </div>

        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
              <div class="card-title">Mostrando informações dos usuários<i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
            </div>
            <div class="card-body">
              <div class="float-end">
                {{ search }}
                <TextInput v-model="search" id="search" type="text" placeholder="Pesquisar..."/>
              </div>
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(example, ) in examples.data" :key="example.id" :id="`example${example.id}`">
                    <th>{{ example.name }}</th>
                    <td>{{ example.value }}</td>
                    <td>{{ example.descriptions }}</td>
                    <td class="d-flex">
                      <NavLink :href="route('example.edit', { example_id: example.id })">
                        <SmallEditButton />
                      </NavLink>
                      <SmallRemoveButton @click="defineExampleId( example.id )"></SmallRemoveButton>
                    </td>
                  </tr>
                </tbody>
              </table>
              <Pagination class="float-end mt-3" :links="page.props.examples.links" />
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
                        @click="deleteUser"
                    >
                        Apagar registro
                    </DangerButton>
                </div>
            </div>
        </Modal>

    </AuthenticatedLayout>
</template>