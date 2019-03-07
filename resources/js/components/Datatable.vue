<template>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th
                scope="col"
                v-for="(column, index) in columns"
                :key="index"
                @emit="$emit('sort', column.name)"
                >
                    {{column.label}}
                </th>
            </tr>
            </thead>
            <slot></slot>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
            </tbody>
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
