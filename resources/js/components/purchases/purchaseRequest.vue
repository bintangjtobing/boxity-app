<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Purchase Request<br></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <router-link to="/purchase/request/add" class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>New Purchase Request</router-link>
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
                                    :headers="headers" multi-sort :items="purchaseRequestItem" :items-per-page="10"
                                    class="elevation-1" group-by="warehouse.warehouse_name" group-expanded>
                                    <template v-slot:[`item.priority`]="{item}">
                                        <div v-if="item.priority===0">
                                            <span class="priority-lowest"><i class="fal fa-arrow-up"></i>
                                                Lowest</span>
                                        </div>
                                        <div v-if="item.priority===1">
                                            <span class="priority-low"><i class="fal fa-arrow-up"></i> Low</span>
                                        </div>
                                        <div v-if="item.priority===2">
                                            <span class="priority-medium"><i class="fal fa-arrow-up"></i>
                                                Medium</span>
                                        </div>
                                        <div v-if="item.priority===3">
                                            <span class="priority-high"><i class="fal fa-arrow-up"></i>
                                                High</span>
                                        </div>
                                        <div v-if="item.priority===4">
                                            <span class="priority-highest"><i class="fal fa-arrow-up"></i>
                                                Highest</span>
                                        </div>
                                    </template>
                                    <template v-slot:[`item.status`]="{item}">
                                        <div v-if="item.status===0">
                                            <span class="rounded-pill userDatatable-content-status color-warning
                                                bg-opacity-warning active text-capitalize"><i
                                                    class="fal fa-exclamation-circle"></i>
                                                &nbsp;Draft</span>
                                        </div>
                                        <div v-if="item.status===1">
                                            <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize"><i
                                                    class="fal fa-check-circle"></i>
                                                &nbsp;Approved</span>
                                        </div>
                                        <div v-if="item.status===2">
                                            <span class="rounded-pill userDatatable-content-status color-danger
                                                bg-opacity-danger active text-capitalize"><i
                                                    class="fal fa-times-circle"></i>
                                                &nbsp;Canceled</span>
                                        </div>
                                        <div v-if="item.status===3">
                                            <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize"><i class="fal fa-link"></i>
                                                &nbsp;PO Already Created</span>
                                        </div>
                                    </template>
                                    <template v-slot:[`item.actions`]="{item}">
                                        <a v-on:click="makePurchaseOrder(item.pre_number)" class="create"
                                            v-if="item.status=='1'">
                                            <i class="fal fa-plus-circle"></i> Create Purchase Order</a>
                                        <a v-on:click="seePurchaseOrder(item.pre_number)" class="create"
                                            v-if="item.status=='3'">
                                            <i class="fal fa-link"></i> See Purchase Order</a>
                                        <a v-on:click="approvePRE(item.pre_number)" class="create"
                                            v-if="item.status=='0' && user.role=='admin' || user.role=='head'">
                                            <i class="far fa-thumbs-up"></i> Approve</a>
                                        <a :href="`/report/purchase/request/${item.pre_number}`" target="_blank"
                                            class="view">
                                            <i class="fad fa-print"></i></a>
                                        <router-link :to="`/detail/purchase/request/${item.pre_number}`" class="edit">
                                            <i class="fad fa-eye"></i></router-link>
                                        <a v-on:click="deletePurchaseRequestItem(item.id)" class="remove">
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
            return 'Purchase Request';
        },
        data() {
            return {
                // datatable
                search: '',
                key: 1,
                purchaseRequestItem: [],
                headers: [{
                        text: 'PRE #',
                        value: 'pre_number'
                    }, {
                        text: 'Deliver to',
                        value: 'warehouse.warehouse_name'
                    }, {
                        text: 'Requested Date',
                        value: 'pr_date'
                    }, {
                        text: 'Priority',
                        value: 'priority'
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
            }
        },
        created() {
            this.loadItem();
            this.getUser();
        },
        methods: {
            async loadItem() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/purchase/request');
                this.purchaseRequestItem = resp.data;
                const count = await axios.get('/api/count-purchase-request');
                this.countItems = count.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async getUser() {
                // Load user logged in
                const res = await axios.get('/getUserLoggedIn');
                this.user = res.data;
            },
            async deletePurchaseRequestItem(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete data item?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('/api/purchases/request/' + id);
                    this.loadItem();
                    document.getElementById('ding').play();

                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current Purchase Request item.'
                    });
                }
                // console.log(id);
            },
            async makePurchaseOrder(pre_number) {
                const resp = await axios.get('/api/copy/purchase/request/' + pre_number);
                document.getElementById('ding').play();

                await Swal.fire({
                    icon: 'success',
                    title: 'Successfully Created PO',
                    text: 'Do you want to check your created PO?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, check my created PO!',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$router.push(`/detail/purchase/order/` + resp.data.po_number);
                    }
                });
                this.loadItem();
            },
            async seePurchaseOrder(pre_number) {
                const getNumPRE = pre_number.substring(4, 17);
                this.$router.push(`/detail/purchase/order/PO.` + getNumPRE);
            },
            async approvePRE(pre_number) {
                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: 'Are you sure want to approve this purchase request?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, approve this!',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get('/api/approve/purchase/request/' + pre_number);
                        document.getElementById('ding').play();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success approve!',
                            text: 'You have been successfully approve this Purchase Request.',
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
