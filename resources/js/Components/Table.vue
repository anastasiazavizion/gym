<script setup>

</script>

<template>
    <div class="table-responsive">
    <table class="table table-sm">
        <thead class="align-middle">
        <tr class="table-dark">
            <slot name="header"/>
        </tr>
        </thead>
        <tbody>
       <slot></slot>
        </tbody>
    </table>
    </div>
</template>

<style scoped>

</style>
