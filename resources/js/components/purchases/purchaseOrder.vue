<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Purchase Order<br></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <router-link to="/purchase/order/add" class="btn btn-sm btn-primary btn-add">
                                <i class="las la-plus fs-16"></i>New Purchase Order</router-link>
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
                                    class="elevation-1" group-by="suppliers.customerName" group-expanded>
                                    <template v-slot:item.actions="{item}">
                                        <a :href="`/report/purchase/order/${item.id}`" target="_blank" class="view">
                                            <i class="fas fa-print"></i></a>
                                        <router-link :to="`/detail/purchase/order/${item.po_number}`" class="edit">
                                            <i class="fas fa-eye"></i></router-link>
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
                        value: 'warehouse.warehouse_name'
                    }, {
                        text: 'Order Date',
                        value: 'order_date'
                    },
                    {
                        text: 'Supplier',
                        value: 'suppliers.customerName'
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
                const resp = await axios.get('/api/purchase/order');
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
                    await axios.delete('/api/purchases-order/' + id);
                    this.loadItem();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current purchase order item.'
                    });
                }
                // console.log(id);
            },
        },
    }

</script>
<style lang="css">
    .form-group {
        margin-bottom: 0;
    }

</style>
