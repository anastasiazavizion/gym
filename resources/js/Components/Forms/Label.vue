<script setup>
defineProps({
    name:String,
    checkbox: {
        type:Boolean,
        default:false
    }
})
</script>

<template>
    <label :for="name" :class="{'form-label':!checkbox, 'form-check-label': checkbox}"><slot/></label>
</template>

<style scoped>

</style>
