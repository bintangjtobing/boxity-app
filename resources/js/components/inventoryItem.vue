<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Inventory Item</h2>
                    <div v-if="permissions.includes('CreateInventoryItem')"
                        class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <router-link to="/inventory-item/add" class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>Add Inventory Item</router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-default card-md mb-3">
                    <div class="card-header">
                        <h6>Inventory Item Calculation Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="itemSearch" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table :loading="loadings" loading-text="Loading... Please wait..."
                                    :search="itemSearch" :headers="itemHeaders" multi-sort :items="calItems"
                                    :items-per-page="5" class="elevation-1">
                                    <template v-slot:[`item.item_name`]="{ item }">
                                        [{{item.item_code}}] {{item.item_name}}
                                    </template>
                                    <template v-slot:[`item.qty`]="{ item }">
                                        {{item.qty|toDecimal}}/{{item.unit}}
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h6>Inventory Item Group by Warehouse</h6>
                    </div>
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table :loading="loading" loading-text="Loading... Please wait..."
                                    :search="search" :headers="headers" multi-sort :items="inventoryItem"
                                    :items-per-page="10" class="elevation-1" group-by="warehouse.warehouse_name">
                                    <template v-slot:[`item.item_name`]="{ item }">
                                        [{{item.item_code}}] {{item.item_name}}
                                    </template>
                                    <template v-slot:[`item.qty`]="{ item }">
                                        {{item.qty|toDecimal}}/{{item.unit}}
                                    </template>
                                    <template v-slot:[`item.type`]="{ item }">
                                        <span v-if="item.type=='1'">Stock</span>
                                        <span v-if="item.type=='2'">Non Stock</span>
                                        <span v-if="item.type=='3'">Assembly</span>
                                        <span v-if="item.type=='4'">Bundle</span>
                                        <span v-if="item.type=='5'">Service</span>
                                    </template>
                                    <template v-slot:[`item.actions`]="{item}">
                                        <router-link :to="`/detail/inventory-item/${item.id}`" class="edit">
                                            <i class="fad fa-eye"></i></router-link>
                                        <a v-on:click="deleteInventoryItem(item.id)"
                                            v-if="permissions.includes('DeleteInventoryItem')" class="remove">
                                            <i class="fad fa-trash"></i></a>
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    import Editor from '@tinymce/tinymce-vue';

    export default {
        components: {
            'editor': Editor
        },
        title() {
            return 'Inventory Item';
        },
        data() {
            return {
                // datatable
                search: '',
                key: 1,
                loading: true,
                inventoryItem: [],
                headers: [{
                    text: 'Customer',
                    value: 'customer.company_name'
                }, {
                    text: 'Name',
                    value: 'item_name'
                }, {
                    text: 'Ending Balance/UOT',
                    filterable: false,
                    align: 'right',
                    value: 'qty'
                }, {
                    text: 'Tipe Item',
                    value: 'type'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                itemSearch: '',
                loadings: true,
                calItems: [],
                itemHeaders: [{
                    text: 'Item Name',
                    value: 'item_name'
                }, {
                    text: 'Ending Balance Quantity',
                    value: 'qty'
                }, {
                    text: 'Warehouse',
                    value: 'warehouse'
                }],
                countItems: '0',
                permissions: [],
            }
        },
        created() {
            this.loadItem();
        },
        beforeMount() {
            this.permissions = this.$store.getters.getPermissions;
        },
        methods: {
            async loadItem() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/inventory-item');
                const respItem = await axios.get('/api/item');
                // for (let i = 0; i < resp.data.length; i++) {
                this.inventoryItem = resp.data;
                this.calItems = respItem.data;
                console.log(this.calItems)
                if (resp.data.length) {
                    this.loading = false
                }
                // console.log(resp.data[i])
                // }

                const count = await axios.get('/api/count-item-group');
                this.countItems = count.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteInventoryItem(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete data item?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('/api/inventory-item/' + id);
                    this.loadItem();
                    document.getElementById('ding').play();

                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current item.'
                    });
                }
            },

        },
    }

</script>
<style lang="css">
    .form-group {
        margin-bottom: 0;
    }

</style>
