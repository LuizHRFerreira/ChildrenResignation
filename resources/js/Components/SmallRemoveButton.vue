<script setup>
import { Trash2 } from 'lucide-vue-next';
</script>

<template>
    <button class="btn m-1 btn-danger">
        <Trash2 :size="20" />
        <slot />
    </button>
</template>
