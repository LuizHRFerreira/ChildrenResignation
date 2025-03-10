<template>
    <div class="card card-primary card-outline mb-4">
            
        <div class="card-header">
            <div class="card-title">Mensagem Cadastrada</div>
        </div>
        <div class="message">
            <div v-if="message">
                {{ message }}
            </div>
        </div>

    </div>
    
</template>

<style>

.message{
    padding: 30px;
    font-size: 25px;
}

</style>

<script setup>

    import { defineProps } from 'vue';

    defineProps({
        message: {
            type: Object,
            required: true
        }
    });

</script>