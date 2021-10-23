<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">
                        Sales Order<br />
                    </h2>
                    <!-- <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <router-link to="/sales/order/add" class="btn btn-sm btn-primary-boxity btn-add">
                                <i class="las la-plus fs-16"></i>New Sales Order</router-link>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="
                userDatatable
                projectDatatable
                project-table
                bg-white
                border-0
              ">
                            <div class="table-responsive">
                                <v-card-title>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..."
                                        single-line hide-details></v-text-field>
                                </v-card-title>
                                <v-data-table :search="search" :headers="headers" multi-sort :items="inventoryItem"
                                    :items-per-page="10" class="elevation-1">
                                    <template v-slot:[`item.status`]="{item}">
                                        <div v-if="item.status===0">
                                            <span class="rounded-pill userDatatable-content-status color-warning
                                                bg-opacity-warning active text-capitalize"><i
                                                    class="fal fa-exclamation-circle"></i>
                                                &nbsp;Menunggu Pembayaran</span>
                                        </div>
                                        <div v-if="item.status===1">
                                            <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize"><i
                                                    class="fal fa-check-circle"></i>
                                                &nbsp;Resi Lunas Pembayaran Telah Terbit</span>
                                        </div>
                                        <div v-if="item.status===2">
                                            <span class="rounded-pill userDatatable-content-status color-danger
                                                bg-opacity-danger active text-capitalize"><i
                                                    class="fal fa-times-circle"></i>
                                                &nbsp;Canceled</span>
                                        </div>
                                    </template>
                                    <template v-slot:[`item.actions`]="{ item }">
                                        <a :href="`/report/e/sales/order/${item.so_number}`" target="_blank"
                                            class="view">
                                            <i class="fad fa-print"></i></a>
                                        <router-link :to="`/e-commerce/sales/order/detail/${item.id}`" class="edit">
                                            <i class="fad fa-eye"></i></router-link>
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
    import Swal from "sweetalert2";
    import Editor from "@tinymce/tinymce-vue";

    export default {
        components: {
            editor: Editor,
        },
        title() {
            return "Sales Order";
        },
        data() {
            return {
                inventorydata: {
                    type: "",
                    addSalesOrder: "",
                    item_group: "",
                },
                // datatable
                search: "",
                key: 1,
                inventoryItem: [],
                headers: [{
                        text: "SO #",
                        value: "so_number",
                    },
                    {
                        text: "Status Payment",
                        value: "status",
                    },
                    {
                        text: "Actions",
                        value: "actions",
                        filterable: false,
                        sortable: false,
                    },
                ],
            };
        },
        created() {
            this.loadItem();
        },
        methods: {
            async loadItem() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get("/api/e/sales/order");
                this.inventoryItem = resp.data;

                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteInventoryItem(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: "Delete data item?",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    await axios.delete("/api/inventory-item/" + id);
                    this.loadItem();
                    await Swal.fire({
                        icon: "success",
                        title: "Successfully Deleted",
                        text: "Success deleted current item.",
                    });
                }
            },
        },
    };

</script>
<style lang="css">
    .form-group {
        margin-bottom: 0;
    }

</style>
