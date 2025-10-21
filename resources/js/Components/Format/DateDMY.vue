<script setup>
import { computed } from 'vue';
import { useSlots } from 'vue';

const slots = useSlots();

function pad(value) {
    return String(value).padStart(2, '0');
}

function parseDateAsLocal(dateString) {
    const datePart = dateString.split(' ')[0];
    const [year, month, day] = datePart.split('-');
    return new Date(Number(year), Number(month) - 1, Number(day));
}

const formattedDate = computed(() => {
    const rawDate = slots.default?.()[0].children;
    const d = parseDateAsLocal(rawDate);
    if (isNaN(d)) return 'Invalid date';
    return `${pad(d.getDate())}.${pad(d.getMonth() + 1)}.${d.getFullYear()}`;
});
</script>

<template>
    <span>{{ formattedDate }}</span>
</template>
