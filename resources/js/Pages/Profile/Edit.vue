<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateHoldingForm from './Partials/UpdateHoldingForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { ref } from 'vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const activeTab = ref('holding');

</script>

<template>
    <AuthenticatedLayout>
        <div class="container mt-4">
            <!-- Nav Tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <button class="nav-link" :class="{ active: activeTab === 'holding' }" @click="activeTab = 'holding'">
                        Configurações
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" :class="{ active: activeTab === 'profile' }" @click="activeTab = 'profile'">
                        Atualização de Conta
                    </button>
                </li>
            </ul>

            <!-- Conteúdo das Tabs -->
            <div class="mt-3">
                <div v-if="activeTab === 'holding'">
                    <UpdateHoldingForm />
                </div>

                <div v-if="activeTab === 'profile'">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                    <UpdatePasswordForm />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

