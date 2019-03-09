<template>
    <div>
        <table class="table table-bordered" style="height: 200px;">
            <thead>
            <tr>
                <th
                v-for="column in columns"
                :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                :style="'width:'+column.width+';'+'cursor:pointer;'"
                @click="$emit('sort', column.name)"
                >
                    {{column.label}}
                </th>
            </tr>
            </thead>
            <slot></slot>
        </table>
    </div>
</template>

<script>
    export default {
        name: "Datatable",
        props: ['columns', 'sortKey', 'sortOrders'],
    }
</script>

<style scoped>

</style>
