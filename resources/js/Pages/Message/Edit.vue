<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import NavLink from '@/Components/NavLink.vue';
    import EditMessageForm from './Partials/EditMessageForm.vue';
    import QRGenerator from '@/Components/QRGenerator.vue'; 
    import { computed } from 'vue';
    import { usePage } from '@inertiajs/vue3';

    const page = usePage();
    const currentPath = computed(() => {
        const parts = page.url.split('/'); 
        return parts.pop(); 
    });


     const ValueQRCode = computed(() => { const baseURL = window.location.origin; return baseURL + '/code/' + currentPath.value;} );

</script>

<template>
    <AuthenticatedLayout>

    <div class="container">
        <div class="content-wrapper">
            

            <EditMessageForm />
        
            <div class="qr-code-container">
                <QRGenerator :value="ValueQRCode" />
                <p class="qr-code-text">Escaneie o QR Code para pegar o link da página</p>
            </div>
        </div>
    </div>
        
</AuthenticatedLayout>
            

</template>

<style scoped>
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #212529; /* Cinza-Escuro */
    padding: 20px;
}

.content-wrapper {
    background-color: #343A40; /* Cinza-Médio */
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Darker shadow for contrast */
    padding: 20px;
    width: 100%;
    max-width: 800px;
    border-top: 4px solid #007BFF; /* Azul, top border */
}

.qr-code-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 30px;
    border-top: 1px solid #495057; /* Cinza-Claro */
    padding-top: 30px;
}

.qr-code-text {
    margin-top: 10px;
    font-size: 16px;
    color: #f8f9fa; /* Very light color for text - almost white for contrast on dark backgrounds */
    text-align: center;
}

@media (max-width: 600px) {
  .content-wrapper {
    padding: 10px;
  }
}
</style>
