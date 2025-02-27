<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import NavLink from '@/Components/NavLink.vue';
    import EditExampleForm from './Partials/EditExampleForm.vue';
</script>

<template>
    <Head title="Examples" />
    <AuthenticatedLayout>

        <div class="row mb-3 mt-3">
            <div class="col-sm-6">
            <h3 class="mb-0">Editar</h3>
            </div>
            <div class="col-sm-6">
            <div class="float-sm-end">
                <NavLink :href="route('example.index')" :active="route().current('example.index')">
                    <PrimaryButton>Voltar</PrimaryButton>
                </NavLink>
            </div>
            </div>
        </div>

        <EditExampleForm />

    </AuthenticatedLayout>
</template>