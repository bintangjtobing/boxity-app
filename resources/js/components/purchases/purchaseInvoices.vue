<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Purchase Invoice<br></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap"
                        v-if="permissions.includes('CreatePurchaseInvoice')">
                        <div class="action-btn">
                            <router-link to="/purchase/invoices/add" class="btn btn-sm btn-primary-boxity btn-add">
                                <em class="las la-plus fs-16"></em>New Purchase Invoice</router-link>
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
                                    :headers="headers" multi-sort :items="purchaseInvoiceItem" :items-per-page="10"
                                    class="elevation-1" group-by="warehouse.warehouse_name" group-expanded>
                                    <template v-slot:item.status="{item}">
                                        <span class="transparency-primary-boxity" v-if="!item.hasPo">
                                            <em class="fad fa-check"></em> Passed without purchase order
                                        </span>
                                        <span class="transparency-primary-boxity" v-else-if="item.status==0">
                                            Phase 1 passed
                                        </span>
                                        <span class="transparency-primary-boxity" v-else-if="item.status==1">
                                            Phase 2 passed
                                        </span>
                                        <span class="transparency-primary-boxity" v-else-if="item.status==2">
                                            <em class="fad fa-check"></em> All passed
                                        </span>
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <a :href="`/report/purchase/invoices/${item.pi_number}`" target="_blank"
                                            class="view">
                                            <em class="fad fa-print"></em></a>
                                        <router-link :to="`/detail/purchase/invoices/${item.pi_number}`" class="edit">
                                            <em class="fad fa-eye"></em></router-link>
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12 col-lg-12 col-md-12 mb-25">
                <div class="feature-cards5 d-flex justify-content-between border-0 radius-xl bg-white p-25">
                    <div class="application-task d-flex align-items-center">
                        <div class="application-task-content">
                            <span><strong>Need help?</strong> Check out our <a href="https://help.boxity.id"
                                    target="_blank">documentation</a> or our <a href="#">getting
                                    started video series</a> to quickly learn the basics or <router-link
                                    to="/new-issue">reach out to our
                                    team</router-link>, we'd happy to help.</span>
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
            return 'Purchase Invoice';
        },
        data() {
            return {
                // datatable
                search: '',
                key: 1,
                purchaseInvoiceItem: [],
                headers: [{
                    text: 'PI #',
                    value: 'pi_number'
                }, {
                    text: 'Deliver to',
                    value: 'warehouse.warehouse_name'
                }, {
                    text: 'Delivery Date',
                    value: 'invoice_date'
                }, {
                    text: 'Status',
                    value: 'status',
                    align: 'center'
                }, {
                    text: 'Actions',
                    value: 'actions',
                    align: 'right',
                    filterable: false,
                    sortable: false
                }],
                // end datatable
                countItems: '0',
                permissions: []
            }
        },
        beforeMount() {
            this.permissions = this.$store.getters.getPermissions;
        },
        created() {
            this.loadItem();
        },
        methods: {
            async loadItem() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/purchase/invoices');
                this.purchaseInvoiceItem = resp.data;
                const count = await axios.get('/api/count-purchase-invoice');
                this.countItems = count.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deletePurchaseInvoiceItem(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: 'Delete data item?',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete('/api/purchases-invoices/' + id);
                    this.loadItem();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current Purchase Invoice item.'
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
