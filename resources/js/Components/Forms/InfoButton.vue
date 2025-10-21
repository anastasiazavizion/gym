<script setup>
const props = defineProps({
    label: {type: String, default: 'Info'}
});
</script>

<template>
    <button class="btn btn-info text-white">
        <slot>{{ label }}</slot>
    </button>
</template>

<style scoped>

</style>
