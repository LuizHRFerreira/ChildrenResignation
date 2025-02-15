<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

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

         

        </div>
      </div>

    </div>

  </AuthenticatedLayout>
</template>
