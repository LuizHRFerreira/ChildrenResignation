<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  links: Array
});
</script>

<template>
  <nav>
    <ul class="pagination">
      <li v-for="(link, index) in links" :key="index" 
          :class="['page-item', { 'active': link.active, 'disabled': !link.url }]">
        <Link v-if="link.url" class="page-link" :href="link.url" v-html="link.label"></Link>
        <span v-else class="page-link" v-html="link.label"></span>
      </li>
    </ul>
  </nav>
</template>
