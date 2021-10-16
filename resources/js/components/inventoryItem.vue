<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Inventory Item<br>
                        <span>Jumlah <router-link :to="'/item-group'"><abbr title="Stock Group Link">item group</abbr>
                            </router-link> anda
                            adalah {{countItems}}, <abbr title="Inventory Item">Inventory Item</abbr> akan berfungsi
                            jika
                            anda memiliki item group minimal sebanyak 1. </span></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <router-link to="/inventory-item/add" class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>Add Inventory Item</router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table loading loading-text="Loading... Please wait..." :search="search"
                                    :headers="headers" multi-sort :items="inventoryItem" :items-per-page="10"
                                    class="elevation-1" group-by="warehouse.warehouse_name">
                                    <template v-slot:item.qty="{ item }">
                                        {{item.qty|toDecimal}}
                                    </template>
                                    <template v-slot:item.type="{ item }">
                                        <span v-if="item.type=='1'">Stock</span>
                                        <span v-if="item.type=='2'">Non Stock</span>
                                        <span v-if="item.type=='3'">Assembly</span>
                                        <span v-if="item.type=='4'">Bundle</span>
                                        <span v-if="item.type=='5'">Service</span>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <router-link :to="`/detail/inventory-item/${item.id}`" class="edit">
                                            <i class="fad fa-eye"></i></router-link>
                                        <a v-on:click="deleteInventoryItem(item.id)" class="remove">
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
                inventoryItem: [],
                headers: [{
                    text: 'Customer',
                    value: 'customer.company_name'
                }, {
                    text: 'Item Code',
                    value: 'item_code'
                }, {
                    text: 'Name',
                    value: 'item_name'
                }, {
                    text: 'Item Group',
                    value: 'item_group.name'
                }, {
                    text: 'Ending Balance',
                    filterable: false,
                    align: 'right',
                    value: 'qty'
                }, {
                    text: 'Unit Type',
                    filterable: false,
                    value: 'unit',
                }, {
                    text: 'Tipe Item',
                    value: 'type'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    filterable: false,
                    sortable: false
                }],
                countItems: '0',
                // end datatable
            }
        },
        created() {
            this.loadItem();
        },
        methods: {
            async loadItem() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/inventory-item');
                // for (let i = 0; i < resp.data.length; i++) {
                this.inventoryItem = resp.data;
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
