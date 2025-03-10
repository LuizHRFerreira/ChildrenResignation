<script setup>
import { FilePenLine } from 'lucide-vue-next';
</script>

<template>
    <button class="btn m-1 btn-success">
        <FilePenLine :size="20" />
        <slot />
    </button>
</template>
