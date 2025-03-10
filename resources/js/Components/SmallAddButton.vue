<script setup>
import { Plus } from 'lucide-vue-next';
</script>

<template>
    <button class="btn m-1 btn-primary">
        <Plus :size="20" />
        <slot />
    </button>
</template>