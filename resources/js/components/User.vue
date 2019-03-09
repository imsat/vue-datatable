<template>
<div>
    <div class="row">
        <div class="float-left col-6">
            <label class="form-inline">Show
                <select v-model="tableData.length" @change="getUsers()" class="custom-select custom-select-sm form-control form-control-sm m-1">
                    <option value="10" selected="selected">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                entries</label>
        </div>
        <div class="col-6">
            <label class="form-inline float-right">Search:
                <input type="search" v-model="tableData.search" @input="getUsers()" class="form-control form-control-sm m-1" placeholder="" aria-controls="example">
            </label>
        </div>

    </div>
    <datatable
        :columns="columns"
        :sortKey="sortKey"
        :sortOrders="sortOrders"
        @sort="sortBy"
    >
        <tbody>
        <tr v-for="user in users" :key="user.id">
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td>{{user.type}}</td>
        </tr>
        </tbody>
    </datatable>
    <pagination
    :pagination="pagination"
    @prev="getUsers(pagination.prevPageUrl)"
    @next="getUsers(pagination.nextPageUrl)"
    >
    </pagination>
</div>
</template>

<script>
    import Datatable from './Datatable'
    import Pagination from './Pagination'

    export default {
        name: "User",
        components: {
            Datatable, Pagination
        },
        created(){
            this.getUsers();
            // axios.get('/user', {params: this.tableData})
            //     .then(res => {
            //         console.log(res.data)
            //     })

        },
        data() {
            let sortOrders = {};
            let columns = [
                {width: '33%', label: 'Name', name: 'name'},
                {width: '33%', label: 'Email', name: 'email'},
                {width: '33%', label: 'Type', name: 'type'}
            ];
            columns.forEach((column) => {
                sortOrders[column.name] = -1
            });
            return {
                users: [],
                columns: columns,
                sortKey: 'name',
                sortOrders: sortOrders,
                tableData: {
                    draw: 0,
                    length: 10,
                    search: '',
                    column: 0,
                    dir: 'desc'
                },
                pagination: {
                    lastPage: '',
                    currentPage: '',
                    total: '',
                    lastPageUrl: '',
                    nextPageUrl: '',
                    prevPageUrl: '',
                    from: '',
                    to: '',
                }
            }
        },
        methods: {
            getUsers(url = '/user') {
                this.tableData.draw++;
                axios.get(url, {params: this.tableData})
                    .then(response => {
                        // console.log(response.data);
                        let data = response.data;
                        if (this.tableData.draw == data.draw) {
                            this.users = data.data.data;
                            this.configPagination(data.data);
                        }
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
            configPagination(data) {
                this.pagination.lastPage = data.last_page;
                this.pagination.currentPage = data.current_page;
                this.pagination.total = data.total;
                this.pagination.lastPageUrl = data.last_page_url;
                this.pagination.nextPageUrl = data.next_page_url;
                this.pagination.prevPageUrl = data.prev_page_url;
                this.pagination.from = data.from;
                this.pagination.to = data.to;
            },
            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
                this.tableData.column = this.getIndex(this.columns, 'name', key);
                this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
                this.getUsers();
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
            },
        }

    }
</script>

<style scoped>

</style>
