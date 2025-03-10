<script setup>
import { ref, watch, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    show: Boolean, // Controla a exibição do modal
    title: String, // Título opcional do modal
});

const emit = defineEmits(['close']); // Evento para fechar o modal
const modalRef = ref(null);

// Observa a propriedade `show` e exibe o modal dinamicamente
watch(() => props.show, (newValue) => {
    if (newValue) {
        const modal = new bootstrap.Modal(modalRef.value);
        modal.show();
    } else {
        const modalInstance = bootstrap.Modal.getInstance(modalRef.value);
        modalInstance?.hide();
    }
});

// Fecha o modal ao pressionar a tecla ESC
const closeOnEscape = (e) => {
    if (e.key === 'Escape') {
        emit('close');
    }
};

onMounted(() => {
    modalRef.value.addEventListener('hidden.bs.modal', () => emit('close'));
    document.addEventListener('keydown', closeOnEscape);
});

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
});
</script>

<template>
    <div ref="modalRef" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="title" class="modal-title">{{ title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <slot />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</template>
