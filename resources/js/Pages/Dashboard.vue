<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3'
import Select from 'datatables.net-select';

DataTable.use(Select);

const data = [
  ["Ana", 24, "ana@gmail.com", "ksd"],
  ["Paulo Santos", 44, "paulo@gmail.com", "ass"],
  ["Ricardo Soares", 67, "ricardo@gmail.com", 9823],
];

</script>

<style>
@import 'datatables.net-dt';
</style>
<template>

  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="row">
      <div class="col-12">
        <div class="container">

          <div class="row mb-3 mt-3">
            <div class="col-sm-6">
              <h3 class="mb-0">Título da página</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Unfixed Layout</li>
              </ol>
            </div>
          </div>

          <div class="card card-primary card-outline mb-4">
            <div class="card-header">
              <div class="card-title">Mostrando informações dos usuários</div>
            </div>
            <div class="card-body">
              <DataTable :data="data" class="display">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Email</th>
                    <th>Código</th>
                  </tr>
                </thead>
              </DataTable>
            </div>
          </div>

        </div>
      </div>

    </div>

  </AuthenticatedLayout>
</template>
