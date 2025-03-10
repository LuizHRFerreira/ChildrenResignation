<script setup>
  import CreateMessageForm from './Partials/CreateMessageForm.vue';
  import ShowMessage from './Partials/ShowMessage.vue';
  import { computed } from 'vue';
  import { usePage } from '@inertiajs/vue3';
  import QRGenerator from '@/Components/QRGenerator.vue'; 

  const page = usePage();
  const messages = page.props.messages;

  const currentPath = computed(() => {
    const parts = page.url.split('/'); 
    return parts.pop(); 
  });


  const ValueQRCode = computed(() => { const baseURL = window.location.origin; return baseURL + '/code/' + currentPath.value;} );

  const isCreatePage = messages.some(item => item.uuid === currentPath.value);

  const message = computed(() => {
    const foundMessage = messages.find(msg => msg.uuid === currentPath.value);
    return foundMessage ? foundMessage.message : null;
  });

</script>

<template>
  <div class="container">
    <div class="content-wrapper">
        <ShowMessage :message="message" v-if="isCreatePage" />

        <CreateMessageForm v-else />

        <div class="qr-code-container">
          <QRGenerator :value="ValueQRCode" />
          <p class="qr-code-text">Escaneie o QR Code para pegar o link da página</p>
        </div>
        
    </div>
  </div>
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