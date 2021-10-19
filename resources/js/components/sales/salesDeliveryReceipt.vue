<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Delivery Receipt<br></h2>
                    <div class="breadcrumb-action justify-content-center flex-wrap" v-if="permissions.includes('CreateDeliveryReceipt')">
                        <div class="action-btn">
                            <router-link to="/delivery/receipt/add" class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>New Delivery Receipt</router-link>
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
                                    class="elevation-1" group-by="customers.customerName" group-expanded>
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
                                    </template>
                                    <template v-slot:item.actions="{item}">
                                        <a :href="`/report/delivery-receipt/${item.sdr_number}`" target="_blank"
                                            class="view">
                                            <i class="fad fa-print"></i></a>
                                        <router-link :to="`/detail/delivery/receipt/${item.sdr_number}`" class="edit">
                                            <i class="fad fa-eye"></i></router-link>
                                        <a v-on:click="deletePurchaseInvoiceItem(item.id)" class="remove" v-if="permissions.includes('DeleteDeliveryReceipt')">
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
            return 'Delivery Receipt';
        },
        data() {
            return {
                // datatable
                search: '',
                key: 1,
                purchaseInvoiceItem: [],
                headers: [{
                    text: 'SDR #',
                    value: 'sdr_number'
                }, {
                    text: 'Deliver to',
                    value: 'customers.customerName'
                }, {
                    text: 'Delivery Date',
                    value: 'sdr_date'
                }, {
                    text: 'Status',
                    value: 'status'
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
                const resp = await axios.get('/api/delivery/receipt');
                this.purchaseInvoiceItem = resp.data;
                const count = await axios.get('/api/count-delivery-receipt');
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
                    await axios.delete('/api/delivery-receipt/' + id);
                    this.loadItem();
                    document.getElementById('ding').play();
                    await Swal.fire({
                        icon: 'success',
                        title: 'Successfully Deleted',
                        text: 'Success deleted current Delivery Receipt item.'
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
