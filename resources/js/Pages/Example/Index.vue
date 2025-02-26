<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import NavLink from '@/Components/NavLink.vue';
import { computed } from 'vue';
import Pagination from '@/Components/Pagination.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const page = usePage();
const examples = page.props.examples;
const search = ref(usePage().props.search || '');

watch(search, (newValue) => {
  router.get(route('example.index'), { search: newValue }, {
    replace: true,
    preserveState: true
  });
});
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
                  <PrimaryButton>Novo</PrimaryButton>
              </NavLink>
            </div>
          </div>
        </div>

        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
              <div class="card-title">Mostrando informações dos usuários</div>
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
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(example, ) in examples.data" :key="example.id">
                    <th>{{ example.name }}</th>
                    <td>{{ example.value }}</td>
                    <td>{{ example.descriptions }}</td>
                  </tr>
                </tbody>
              </table>
              <Pagination class="float-end mt-3" :links="page.props.examples.links" />
            </div>
          </div>

    </AuthenticatedLayout>
</template>