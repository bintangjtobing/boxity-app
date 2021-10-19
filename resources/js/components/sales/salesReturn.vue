<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Sales Return<br></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap" v-if="permissions.includes('CreateSalesReturn')">
                        <div class="action-btn">
                            <router-link to="/sales/return/add" class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>New Sales Return</router-link>
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
                                <v-data-table :headers="headers" multi-sort :items="inventoryItem" :items-per-page="10"
                                    class="elevation-1" group-by="item_group.name">
                                    <template v-slot:item.type="{ item }">
                                        <span v-if="item.type=='1'">Stock</span>
                                        <span v-if="item.type=='2'">Non Stock</span>
                                        <span v-if="item.type=='3'">Assembly</span>
                                        <span v-if="item.type=='4'">Bundle</span>
                                        <span v-if="item.type=='5'">Service</span>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <router-link :to="`/detail/sales/return/${item.id}`" class="edit">
                                            <i class="fad fa-edit"></i></router-link>
                                        <a v-on:click="deleteInventoryItem(item.id)" class="remove" v-if="permissions.includes('DeleteSalesReturn')">
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
            return 'Sales Return';
        },
        data() {
            return {
                inventorydata: {
                    type: '',
                    addSalesReturn: '',
                    item_group: '',
                },
                // datatable
                search: '',
                key: 1,
                inventoryItem: [],
                headers: [{
                        text: 'Item Code',
                        value: 'item_code'
                    }, {
                        text: 'Name',
                        value: 'item_name'
                    }, {
                        text: 'Item Group',
                        value: 'item_group.name'
                    },
                    {
                        text: 'Tipe Item',
                        value: 'type'
                    }, {
                        text: 'Actions',
                        value: 'actions',
                        align: 'right',
                        filterable: false,
                        sortable: false
                    }
                ],
                // end datatable
                inventoryOpt: {},
                countItems: '0',
                permissions: []
            }
        },
        beforeMount(){                        
            this.permissions = this.$store.getters.getPermissions;
        },   
        created() {
            this.loadItem();
        },
        methods: {
            async loadItem() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/inventory-item');
                this.inventoryItem = resp.data;
                const count = await axios.get('/api/count-item-group');
                this.countItems = count.data;

                // Load item group
                const respItemGroup = await axios.get('/api/item-group');
                this.inventoryOpt = respItemGroup.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async submitHandle() {
                // this.$Progress.start();
                this.$isLoading(true);
                await axios.post('/api/inventory-item', this.inventorydata).then(response => {
                    this.loadItem();
                    document.getElementById('ding').play();

                    Swal.fire({
                        icon: 'success',
                        title: 'Congratulations',
                        text: 'Success add Sales Return',
                    });
                    this.inventorydata = {
                        item_code: '',
                        item_name: '',
                        type: '',
                        item_group: '',
                        brand: '',
                        width: '',
                        length: '',
                        thickness: '',
                        nt_weight: '',
                        gr_weight: '',
                        volume: '',
                    };
                    // this.$Progress.finish();
                this.$isLoading(false);
                }).catch(error => {
                    this.$Progress.fail();
                   document.getElementById('failding').play();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Something wrong.',
                        confirmButtonText: `Ok`,
                        html: `There is something wrong on my side. Please click ok to refresh this page and see what is it. If
                it still exist, you can contact our developer. <br><br>Error message: ` +
                            error,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                });
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
