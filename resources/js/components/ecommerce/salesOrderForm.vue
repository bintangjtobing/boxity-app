<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between">
                    <div class="
              d-flex
              flex-wrap
              justify-content-center
              breadcrumb-main__wrapper
            ">
                        <div class="
                d-flex
                align-items-center
                user-member__title
                justify-content-center
                mr-sm-25
              ">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">
                                Sales Order <span>#{{ salesOrderData.so_number }}</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Table -->
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
                                        single-line hide-details>
                                    </v-text-field>
                                </v-card-title>
                                <v-data-table :search="search" :headers="headers" :items="itemSalesData"
                                    :items-per-page="10" class="elevation-1">
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Sales Order -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <span>SO number:</span>
                                    <input type="text" v-model="salesOrderData.so_number" readonly
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span>Customer:</span>
                                    <input type="text" v-model="salesOrderData.ecom_recipient_name" readonly
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Order date:</span>
                                    <input type="date" v-model="salesOrderData.created_at" class="form-control"
                                        placeholder="Brand" :disabled="!isEdit" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <span>Address:</span>
                                    <textarea class="form-control" v-model="salesOrderData.ecom_address" cols="30"
                                        rows="4" :disabled="!isEdit"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <div class="row">
                                <div class="col-12">
                                    <a :href="`/report/e/sales-order/${salesOrderData.so_number}`" class="
                      btn btn-secondary
                      float-right
                      btn-warning btn-squared
                      px-30
                      mx-2
                    " target="_blank">
                                        <i class="fad fa-print"></i>&nbsp;Print
                                    </a>
                                </div>
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
    import SelectSearch from "../item/selectSearch.vue";
    export default {
        components: {
            editor: Editor,
            selectSearch: SelectSearch,
        },
        title() {
            return `New Sales Order`;
        },
        data() {
            return {
                // Page Info
                titleItemDescription: "Add some items on Sales Orders.",
                isVisibleAddForm: true,
                isVisibleModifyForm: true,
                itemModify: {
                    warehouseid: "",
                    itemid: "",
                    qtyOrdered: "0",
                    unit: "",
                    currentPrice: "0",
                    price: "0",
                    purpose: "",
                    requested_by: "",
                    used_by: "",
                    remarks: "",
                },
                itemAdd: {
                    warehouseid: "",
                    itemid: "",
                    qtyOrdered: "0",
                    unit: "",
                    currentPrice: "0",
                    price: "0",
                    purpose: "",
                    requested_by: "",
                    used_by: "",
                    remarks: "",
                    so_status: "2",
                    so_number: "",
                },
                qtyItem: "",
                salesOrderData: {
                    so_number: "",
                    customer: "",
                    order_date: "",
                    remarks: "",
                },

                // data relation
                customer: {},
                items: {},
                users: {},
                warehouse: {},
                dataSalesOrder: {},

                // Datatable
                itemSalesData: [],
                search: "",
                key: 1,
                headers: [{
                        text: "Item Code",
                        value: "item.item_code",
                    },
                    {
                        text: "Item Name",
                        value: "item.item_name",
                    },
                    {
                        text: "Qty Ordered",
                        value: "qtyOrdered",
                    },
                    {
                        text: "Price per item",
                        value: "item.price",
                    },
                    {
                        text: "Total Price",
                        value: "price",
                    },
                ],
                countItems: "0",
                isShow: {
                    qty: false,
                    qtyItem: false,
                    colapse: true,
                },
                selected: {
                    item: "",
                    usedBy: "",
                    so: "",
                },
                isDisable: {
                    select: true,
                    input: true,
                },
                isEdit: false,
            };
        },
        async created() {
            await this.loadData();
        },
        computed: {
            btndisable: function () {
                return (
                    !this.itemAdd.warehouseid ||
                    !this.itemAdd.itemid ||
                    this.itemAdd.qtyOrdered === "" ||
                    this.itemAdd.qtyOrdered > this.qtyItem ||
                    !this.itemAdd.currentPrice ||
                    !this.itemAdd.purpose ||
                    !this.itemAdd.used_by
                );
            },
            btndisableModify: function () {
                return (
                    !this.itemModify.warehouseid ||
                    !this.itemModify.itemid ||
                    this.itemModify.qtyOrdered === "" ||
                    this.itemModify.qtyOrdered > this.qtyItem ||
                    !this.itemModify.currentPrice ||
                    !this.itemModify.purpose ||
                    !this.itemModify.used_by
                );
            },
            btndisableSO: function () {
                return (
                    this.salesOrderData.customer === "" ||
                    this.salesOrderData.order_date === ""
                );
            },
        },
        methods: {
            activeAddForm: function () {
                this.isVisibleAddForm = false;
                this.isVisibleModifyForm = true;
                this.selected.usedBy = "";
            },
            classRotate: function (param) {
                return param ? "rotate" : "";
            },
            isShowing: function () {
                this.isShow.colapse = this.isEdit ? !this.isShow.colapse : false;
            },
            async loadData() {
                // this.$Progress.start();
                this.$isLoading(true);
                // Load data relation
                const dataSalesOrder = await axios.get(
                    `/api/e/sales/order/${this.$route.params.so_id}`
                );
                this.salesOrderData = dataSalesOrder.data;
                console.log(this.salesOrderData)
                const resp = await axios.get("/api/customers");
                this.customer = resp.data;
                const itemSalesData = await axios.get(
                    `/api/item-sales/so-number/${dataSalesOrder.data.so_number}`
                );
                this.itemSalesData = itemSalesData.data;
                const itemsData = await axios.get("/api/inventory-item");
                this.items = itemsData.data;
                const warehouseData = await axios.get("/api/warehouse");
                this.warehouse = warehouseData.data;
                const contactUsers = await axios.get("/api/contact-list");
                this.users = contactUsers.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            async deleteItemPurchasing(id) {
                document.getElementById('failding').play();
                const result = await Swal.fire({
                    title: "Delete item sales order?",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonText: `Delete`,
                });
                if (result.isConfirmed) {
                    // this.$Progress.start();
                    this.$isLoading(true);
                    await axios.delete("/api/item-sales/" + id);
                    this.loadData();
                    await Swal.fire({
                        icon: "success",
                        title: "Successfully Deleted",
                        text: "Success deleted current item.",
                    });
                    // this.$Progress.finish();
                    this.$isLoading(false);
                }
            },
        },
    };

</script>

<style scoped>
    #qtyItem {
        color: #ebdc31;
    }

    #qty {
        color: #f44444;
    }

    .rotate {
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }

</style>
