<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Purchase Order<br></h4>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <router-link to="/purchase-order/add" class="btn btn-sm btn-primary btn-add">
                                <i class="las la-plus fs-16"></i>Add New Purchase Order</router-link>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="userDatatable projectDatatable project-table bg-white border-0">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table :search="search" loading loading-text="Loading... Please wait..."
                                    :headers="headers" multi-sort :items="purchaseOrderItem" :items-per-page="10"
                                    class="elevation-1" group-by="item_group.name">
                                    <template v-slot:item.actions="{item}">
                                        <router-link :to="`/detail/purchase-order/${item.id}`" class="edit">
                                            <i class="fas fa-pen"></i></router-link>
                                        <a v-on:click="deletePurchaseOrderItem(item.id)" class="remove">
                                            <i class="fas fa-trash"></i></a>
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
            return 'Purchase Order';
        },
        data() {
            return {
                // datatable
                search: '',
                key: 1,
                purchaseOrderItem: [],
                headers: [{
                        text: 'PO #',
                        value: 'po_number'
                    }, {
                        text: 'Deliver to',
                        value: 'deliver_to.warehouse_name'
                    }, {
                        text: 'Order Date',
                        value: 'order_date'
                    },
                    {
                        text: 'Supplier',
                        value: 'supplier.customerName'
                    }, {
                        text: 'Actions',
                        value: 'actions',
                        filterable: false,
                        sortable: false
                    }
                ],
                // end datatable
                countItems: '0',
            }
        },
        created() {
            this.loadItem();
        },
        methods: {
            async loadItem() {
                this.$Progress.start();
                const resp = await axios.get('/api/purchase-order');
                this.purchaseOrderItem = resp.data;
                const count = await axios.get('/api/count-purchase-order');
                this.countItems = count.data;
                this.$Progress.finish();
            },
            async deletePurchaseOrderItem(id) {
                const result = await Swal.fire({
                    title: 'Delete data item?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('/api/inventory-item/' + id);
                    this.loadItem();
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
