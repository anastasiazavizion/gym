<script setup>
const props = defineProps({
    currentPage:Number,
    lastPage:Number,
    paginationRange:Array,
})

const emit = defineEmits(['setPage'])


const changePage = (page) => {
    if (page >= 1 && page <= props.lastPage) {
        emit('setPage',page)
    }
};

</script>

<template>
    <nav aria-label="Page navigation" class="mt-3">
        <ul class="pagination">
            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)">Previous</a>
            </li>
            <li class="page-item" v-for="page in paginationRange" :key="page" :class="{ active: page === currentPage }">
                <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
            </li>
            <li class="page-item" :class="{ disabled: currentPage === lastPage }">
                <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)">Next</a>
            </li>
        </ul>
    </nav>
</template>

<style scoped>

</style>
