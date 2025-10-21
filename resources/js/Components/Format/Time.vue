<script setup>
import { computed, useSlots } from 'vue';
const slots = useSlots();
const formattedDate = computed(() => {
    const rawTime = slots.default?.()[0]?.children?.trim();
    if(rawTime !== ''){
        const [hours, minutes] = rawTime.split(':');
        return `${hours}:${minutes}`;
    }
    return '';
});
</script>

<template>
    <span>{{ formattedDate }}</span>
</template>
