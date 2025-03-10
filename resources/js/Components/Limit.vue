<template>
  <div></div>
</template>

<script setup>
import Swal from 'sweetalert2';

const showAlert = async () => {
    const swalResult = await Swal.fire({
        title: 'Aviso',
        text: 'O limite de cadastro de códigos foi atingido. Para aumentar seu limite, entre em contato com o suporte.',
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok, entendi',
    });
};

    showAlert();

</script>
