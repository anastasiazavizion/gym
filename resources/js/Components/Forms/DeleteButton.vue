<script setup>
import { computed } from 'vue';
import { useSlots } from 'vue';

const slots = useSlots();

const text = computed(() => {
    let tmpText = slots.default?.()[0].children;
    if(tmpText === undefined){
        tmpText = 'Delete';
    }
    return tmpText;
});

</script>
<template>
    <button type="button" class="btn btn-danger"><i class="bi bi-trash me-2"></i>{{text}}</button>
</template>
