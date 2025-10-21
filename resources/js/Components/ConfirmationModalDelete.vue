<!-- src/Components/ConfirmationModal.vue -->
<script setup>
import PrimaryButton from '@/Components/Forms/PrimaryButton.vue';
import CancelButton from '@/Components/Forms/CancelButton.vue';

const props = defineProps({
    show: Boolean,
    title: { type: String, default: 'Confirm Action' },
    message: { type: String, default: 'Are you sure?' },
});

const emit = defineEmits(['confirm', 'cancelAction']);

const onConfirm = () => {
    emit('confirm');
};

const onCancel = () => {
    emit('cancelAction');
};
</script>

<template>
    <div v-if="show" class="modal fade show d-block" tabindex="-1" style="background: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" class="btn-close" @click="onCancel"></button>
                </div>
                <div class="modal-body">
                    <p>{{ message }}</p>
                </div>
                <div class="modal-footer">
                    <CancelButton @click="onCancel">Cancel</CancelButton>
                    <PrimaryButton @click="onConfirm" class="btn-danger">Delete</PrimaryButton>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.modal {
    z-index: 1050;
}
</style>
