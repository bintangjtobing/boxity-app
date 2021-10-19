<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Purchase Order<br></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap"
                        v-if="permissions.includes('CreatePurchaseOrder')">
                        <div class="action-btn">
                            <router-link to="/purchase/order/add" class="btn btn-sm btn-primary-boxity btn-add">
                                <em class="las la-plus fs-16"></em>New Purchase Order</router-link>
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
                                    <template v-slot:[`item.status`]="{item}">
                                        <div v-if="item.status===2">
                                            <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize"><em
                                                    class="fal fa-check-circle"></em>
                                                &nbsp;Paid Off</span>
                                        </div>
                                        <div v-else-if="item.status===1 && item.paidOff==false">
                                            <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize"><em
                                                    class="fal fa-times-circle"></em>
                                                &nbsp;Not Yet Paid Off</span>
                                        </div>
                                        <div v-else-if="item.status===1">
                                            <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize"><em
                                                    class="fal fa-check-circle"></em>
                                                &nbsp;Approved</span>
                                        </div>
                                        <div v-else-if="item.status==1 && item.paidOff==true">
                                            <span class="rounded-pill userDatatable-content-status color-warning
                                                bg-opacity-warning active text-capitalize"><em
                                                    class="fal fa-exclamation-circle"></em>
                                                &nbsp;Draft</span>
                                        </div>
                                        <div v-else-if="item.status===3">
                                            <span class="rounded-pill userDatatable-content-status color-danger
                                                bg-opacity-danger active text-capitalize"><em
                                                    class="fal fa-times-circle"></em>
                                                &nbsp;Canceled</span>
                                        </div>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <a v-on:click="approvePO(item.po_number)" class="create" v-if="item.status===0">
                                            <em class="far fa-thumbs-up"></em> Approve</a>
                                        <a :href="`/report/purchase/order/${item.po_number}`" target="_blank"
                                            v-if="item.status!=0" class="view">
                                            <em class="fad fa-print"></em></a>
                                        <router-link :to="`/detail/purchase/order/${item.po_number}`" class="edit">
                                            <em class="fad fa-eye"></em></router-link>
                                        <a v-on:click="deletePurchaseOrderItem(item.id)" class="remove"
                                            v-if="permissions.includes('DeletePurchaseOrder')">
                                            <em class="fad fa-trash"></em></a>
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
                    },
                    {
                        text: 'Status',
                        value: 'status'
                    }, {
                        text: 'Actions',
                        value: 'actions',
                        align: 'right',
                        filterable: false,
                        sortable: false
                    }
                ],
                // end datatable
                countItems: '0',
                user: {},
                permissions: []
            }
        },
        beforeMount() {
            this.permissions = this.$store.getters.getPermissions;
        },
        created() {
            this.loadItem();
            this.getUser();
        },
        methods: {
            async loadItem() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/purchase/order');
                this.purchaseOrderItem = resp.data;
                const count = await axios.get('/api/count-purchase-order');
                this.countItems = count.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async getUser() {
                // Load user logged in
                const res = await axios.get('/getUserLoggedIn');
                this.user = res.data;
            },
            async deletePurchaseOrderItem(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete data item?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('/api/purchases-order/' + id);
                    this.loadItem();
                    document.getElementById('ding').play();

                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current purchase order item.'
                    });
                }
                // console.log(id);
            },
            async approvePO(po_number) {
                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: 'Are you sure want to approve this purchase order?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, approve this!',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get('/api/approve/purchase/order/' + po_number);
                        document.getElementById('ding').play();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success approve!',
                            text: 'You have been successfully approve this Purchase Order.',
                        });
                        this.loadItem();
                    }
                });
            }
        },
    }

</script>
<style lang="css">
    .form-group {
        margin-bottom: 0;
    }

</style>
