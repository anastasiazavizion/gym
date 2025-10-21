<script setup>
import { computed, useSlots } from 'vue';

// Access the slot content
const slots = useSlots();
const price = computed(() => {
    // Get the default slot content
    const slotContent = slots.default ? slots.default()[0]?.children : '0';
    // Convert to number and ensure two decimal places
    const numericValue = parseFloat(slotContent) || 0;
    return numericValue.toFixed(2);
});
</script>

<template>
    {{ price }} CHF
</template>
