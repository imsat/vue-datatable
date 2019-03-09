<template>
    <nav class="row justify-content-center">
        <ul class="pagination">
            <li class="page-item " :class="{disabled: !pagination.prevPageUrl}">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true" @click.prevent="$emit('prev')">Previous</a>
            </li>
            <li class="page-item active" aria-current="page">
                <button type="button" class="page-link">{{pagination.from}} - {{pagination.to}} of {{pagination.total}}</button>
            </li>
            <li class="page-item" :class="{disabled: !pagination.nextPageUrl}">
                <button type="button" class="page-link" href="#" @click="$emit('next')">Next</button>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['pagination', 'client', 'filtered']
    }
</script>
<style>

</style>
