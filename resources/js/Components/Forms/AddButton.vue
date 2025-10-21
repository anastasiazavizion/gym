<script setup>
defineProps({
    showAddForm:Boolean,
    text:String,
})
</script>

<template>
    <button class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i> {{ showAddForm ? 'Cancel' : text }}
    </button>
</template>

<style scoped>

</style>
