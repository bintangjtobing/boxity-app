<template>
  <div>
    <div class="row mt-4">
      <div class="col-lg-12">
        <div class="breadcrumb-main user-member justify-content-sm-between">
          <div
            class="
              d-flex
              flex-wrap
              justify-content-center
              breadcrumb-main__wrapper
            "
          >
            <div
              class="
                d-flex
                align-items-center
                user-member__title
                justify-content-center
                mr-sm-25
              "
            >
              <h4 class="text-capitalize fw-500 breadcrumb-title">
                Sales Order <span>#{{ salesOrderData.so_number }}</span>
              </h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Form Add -->
      <div class="col-lg-12" :class="{ unvisible: isVisibleAddForm }">
        <div class="card mb-3">
          <div class="card-body">
            <div
              class="row justify-content-between align-items-center"
              @click="isShowing()"
            >
              <div class="col-lg-6">
                <h5>Items</h5>
                <p class="muted-text">{{ titleItemDescription }}</p>
              </div>
              <div class="col-lg-6 text-right">
                <span
                  class="material-icons-outlined collapseArea"
                  :class="classRotate(isShow.colapse)"
                  style="color: #ddd; font-size: 2rem !important"
                >
                  expand_more
                </span>
              </div>
            </div>
            <div v-show="isShow.colapse">
              <div class="form-row">
                <div class="col-lg-12">
                  <div class="form-row">
                    <div class="form-group col-lg-5">
                      <span>From warehouse:</span>
                      <selectSearch
                        v-model="selected.warehouse"
                        v-bind="{
                          datas: warehouse,
                          width: '100%',
                          name: 'warehouse_name',
                          placeholder: 'Select Item',
                        }"
                        @dataSelected="onWarehouseSelected"
                      ></selectSearch>
                    </div>
                    <div class="form-group col-lg-5">
                      <span>Item name:</span>
                      <selectSearch
                        v-model="selected.item"
                        v-bind="{
                          datas: items,
                          width: '100%',
                          name: 'item_name',
                          group: 'item_code',
                          isDisable: isDisable.select,
                          placeholder: 'Select Item',
                        }"
                        @dataSelected="onItemSelected"
                      ></selectSearch>

                      <span class="float-left"
                        ><abbr title="Add new item"
                          >Don't see the item you're looking for?</abbr
                        >
                        <router-link :to="'/inventory-item'">
                          Add new item here</router-link
                        >
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <span>Quantity:</span>
                    <span v-show="isShow.qtyItem" id="qtyItem">{{
                      "(Quantity Item = " + qtyItem + ")"
                    }}</span>
                    <input
                      type="number"
                      v-model="itemAdd.qtyOrdered"
                      @input="onQtyInc"
                      placeholder=""
                      id=""
                      min="0"
                      max="10000"
                      step="1"
                      class="form-control"
                      required
                      :disabled="isDisable.input"
                    />
                    <span v-show="isShow.qty" id="qty"
                      >Can't be more than quantity items</span
                    >
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <span>Unit:</span>
                    <input
                      type="text"
                      v-model="itemAdd.unit"
                      id=""
                      class="form-control"
                      required
                      readonly
                      :disabled="isDisable.input"
                    />
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <span>Price:</span>
                    <input
                      type="number"
                      v-model="itemAdd.currentPrice"
                      @change="onPriceChange"
                      @input="onPriceChange"
                      class="form-control"
                      min="0"
                      max="9999999"
                      step="250"
                      required
                      :disabled="isDisable.input"
                    />
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <span>Line total:</span>
                    <input
                      type="number"
                      v-model="itemAdd.price"
                      class="form-control"
                      min="0.00"
                      max="10000.00"
                      step="0.01"
                      readonly
                      :disabled="isDisable.input"
                    />
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <span>Purpose:</span>
                    <input
                      type="text"
                      v-model="itemAdd.purpose"
                      id=""
                      class="form-control"
                      :disabled="isDisable.input"
                    />
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <span>Used by:</span>
                    <selectSearch
                      v-model="selected.usedBy"
                      v-bind="{
                        datas: users,
                        width: '100%',
                        name: 'name',
                        isDisable: isDisable.input,
                        placeholder: 'Select Item',
                      }"
                      @dataSelected="onItemSelectedUsed"
                    ></selectSearch>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <span>Remarks:</span>
                    <textarea
                      v-model="itemAdd.remarks"
                      class="form-control"
                      id=""
                      cols="30"
                      rows="2"
                      :disabled="isDisable.input"
                    ></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group my-2">
                <div class="row">
                  <div class="col-12">
                    <button
                      v-on:click="addToList"
                      v-on:keyup.enter="addToList"
                      class="
                        btn btn-success
                        float-right
                        btn-default btn-squared
                        px-30
                      "
                      :disabled="btndisable"
                    >
                      Add to lists
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Form Modify -->
      <div class="col-lg-12" :class="{ unvisible: isVisibleModifyForm }">
        <div class="card mb-3">
          <div class="card-body">
            <div
              class="row justify-content-between align-items-center"
              @click="isShowing()"
            >
              <div class="col-5">
                <h5>Modify Item</h5>
                <p class="muted-text">{{ titleItemDescription }}</p>
              </div>
              <div class="col-1">
                <span>
                  <svg
                    :class="classRotate(isShow.colapse)"
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-caret-down-fill"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"
                    />
                  </svg>
                </span>
              </div>
            </div>
            <div v-show="isShow.colapse">
              <div class="form-row">
                <div class="col-lg-12">
                  <div class="form-row">
                    <div class="form-group col-lg-5">
                      <span>From warehouse:</span>
                      <input
                        type="text"
                        v-model="itemModify.warehouse_name"
                        id=""
                        class="form-control"
                        readonly
                      />
                    </div>
                    <div class="form-group col-lg-5">
                      <span>Item name:</span>
                      <input
                        type="text"
                        v-model="itemModify.item_name"
                        id=""
                        class="form-control"
                        readonly
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <span>Quantity:</span>
                    <span v-show="isShow.qtyItem" id="qtyItem">{{
                      "(Quantity Item = " + qtyItem + ")"
                    }}</span>
                    <input
                      type="number"
                      v-model="itemModify.qtyOrdered"
                      @input="onModifyQtyInc"
                      placeholder="0"
                      id=""
                      min="0"
                      max="10000"
                      step="1"
                      class="form-control"
                    />
                    <span v-show="isShow.qty" id="qty"
                      >Tidak boleh lebih dari quantity item</span
                    >
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <span>Unit:</span>
                    <input
                      type="text"
                      v-model="itemModify.unit"
                      id=""
                      class="form-control"
                      readonly
                    />
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <span>Price:</span>
                    <input
                      type="number"
                      v-model="itemModify.currentPrice"
                      @change="onModifyPriceChange"
                      @input="onModifyPriceChange"
                      class="form-control"
                      min="0"
                      max="9999999"
                      step="250"
                    />
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <span>Line total:</span>
                    <input
                      type="number"
                      v-model="itemModify.price"
                      class="form-control"
                      min="0.00"
                      max="10000.00"
                      step="0.01"
                      readonly
                    />
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <span>Purpose:</span>
                    <input
                      type="text"
                      v-model="itemModify.purpose"
                      id=""
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <span>Used by:</span>
                    <selectSearch
                      v-model="selected.usedBy"
                      v-bind="{
                        datas: users,
                        width: '100%',
                        name: 'name',
                        placeholder: 'Select Item',
                      }"
                      @dataSelected="onItemSelectedUsed"
                    ></selectSearch>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <span>Remarks:</span>
                    <textarea
                      v-model="itemModify.remarks"
                      class="form-control"
                      id=""
                      cols="30"
                      rows="2"
                    ></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group my-2">
                <div class="row">
                  <div class="col-12">
                    <button
                      v-on:click="modifyItemList"
                      v-on:keyup.enter="modifyItemList"
                      class="
                        btn btn-success
                        float-right
                        btn-default btn-squared
                        px-30
                      "
                      :disabled="btndisableModify"
                    >
                      Update item list
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Table -->
      <div class="col-lg-12">
        <div class="card mb-3">
          <div class="card-body">
            <button
              @click="activeAddForm"
              class="btn btn-success float-left btn-default btn-squared"
            >
              <span><i class="fas fa-plus-circle"></i></span>&nbsp; Add item
            </button>
            <div
              class="
                userDatatable
                projectDatatable
                project-table
                bg-white
                border-0
              "
            >
              <div class="table-responsive">
                <v-card-title>
                  <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search here..."
                    single-line
                    hide-details
                  >
                  </v-text-field>
                </v-card-title>
                <v-data-table
                  :search="search"
                  :headers="headers"
                  :items="itemSalesData"
                  :items-per-page="10"
                  class="elevation-1"
                >
                  <template v-slot:item.actions="{ item }">
                    <button
                      v-on:click="modifyItemPurchasing(item.id)"
                      class="edit"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      v-on:click="deleteItemPurchasing(item.id)"
                      class="remove"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </template>
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
                  <input
                    type="text"
                    v-model="salesOrderData.so_number"
                    readonly
                    class="form-control"
                  />
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <span>Customer:</span>
                  <selectSearch
                    v-model="selected.so"
                    v-bind="{
                      datas: customer,
                      width: '100%',
                      name: 'customerName',
                      isDisable: !isEdit,
                      placeholder: 'Select Item',
                    }"
                    @dataSelected="onItemSelectedSO"
                  ></selectSearch>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <span>Order date:</span>
                  <input
                    type="date"
                    v-model="salesOrderData.order_date"
                    class="form-control"
                    placeholder="Brand"
                    :disabled="!isEdit"
                  />
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-12">
                <div class="form-group">
                  <span>Remarks:</span>
                  <textarea
                    class="form-control"
                    v-model="salesOrderData.remarks"
                    cols="30"
                    rows="4"
                    :disabled="!isEdit"
                  ></textarea>
                </div>
              </div>
            </div>
            <div class="form-group my-2">
              <div class="row">
                <div class="col-5 text-left">
                  <div class="checkbox-theme-default custom-checkbox">
                    <input
                      v-model="isEdit"
                      class="checkbox"
                      type="checkbox"
                      id="check-1"
                    />
                    <label for="check-1">
                      <span class="checkbox-text">Edit mode</span>
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <a
                    :href="`/api/report/sales-order/${this.$route.params.so_id}`"
                    class="
                      btn btn-secondary
                      float-right
                      btn-warning btn-squared
                      px-30
                      mx-2
                    "
                    target="_blank"
                  >
                    <i class="fas fa-print"></i>&nbsp;Print
                  </a>
                  <button
                    v-on:click="submitHandle"
                    v-on:keyup.enter="submitHandle"
                    class="
                      btn btn-primary
                      float-right
                      btn-default btn-squared
                      px-30
                    "
                    :disabled="btndisableSO || !isEdit"
                  >
                    Update
                  </button>
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
    return `New Purchase Order`;
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
      headers: [
        {
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
          text: "Qty Shipped",
          value: "qtyShipped",
        },
        {
          text: "Price per item",
          value: "item.price",
        },
        {
          text: "Total Price",
          value: "price",
        },
        {
          text: "Actions",
          value: "actions",
          filterable: false,
          sortable: false,
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
    await this.generateSONumber();
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
      this.selected.usedBy= "";
    },
    classRotate: function (param) {
      return param ? "rotate" : "";
    },
    isShowing: function () {
      this.isShow.colapse = this.isEdit ? !this.isShow.colapse : false;
    },
    onWarehouseSelected(param) {
      this.itemAdd.warehouseid = param.id;
      this.itemModify.warehouseid = param.id;
      this.selected.warehouse = param.warehouse_name;
      this.isDisable.select = false;
    },
    onItemSelectedSO(param) {
      this.salesOrderData.customer = param.id;
      this.selected.so = param.customerName;
    },
    onItemSelectedUsed(param) {
      this.itemAdd.used_by = param.id;
      this.itemModify.used_by = param.id;
      this.selected.usedBy = param.name;
    },
    generateSONumber() {
      this.salesOrderData.so_number = this.dataSalesOrder.so_number;
      this.selected.so = this.dataSalesOrder.customer.customerName;
      this.salesOrderData = {
        so_number: this.dataSalesOrder.so_number,
        customer: this.dataSalesOrder.customer.id,
        order_date: this.dataSalesOrder.order_date,
        remarks: this.dataSalesOrder.remarks || "",
      };
      this.itemAdd.so_number = this.dataSalesOrder.so_number;
    },
    // on CHange Attribute
    async onItemSelected(value) {
      this.isDisable.input = false;
      this.isShow.qty = false;
      const getId = value.id;
      this.$Progress.start();
      const { data: itemData } = await axios.get(
        "/api/inventory-item/" + getId
      );
      this.$Progress.finish();
      this.itemAdd.unit = itemData.unit;
      this.itemAdd.currentPrice = itemData.price;
      this.itemAdd.itemid = itemData.id;
      this.qtyItem = itemData.qty;
      this.selected.item = `${value.item_code} - ${value.item_name}`;
      this.isShow.qtyItem = true;
    },
    onQtyInc() {
      this.isShow.qty = this.itemAdd.qtyOrdered > this.qtyItem ? true : false;

      this.itemAdd.price =
        parseInt(this.itemAdd.qtyOrdered) * parseInt(this.itemAdd.currentPrice);
    },
    onPriceChange() {
      this.itemAdd.price =
        parseInt(this.itemAdd.qtyOrdered) * parseInt(this.itemAdd.currentPrice);
    },
    onModifyQtyInc() {
      this.isShow.qty =
        this.itemModify.qtyOrdered > this.qtyItem ? true : false;

      this.itemModify.price =
        parseInt(this.itemModify.qtyOrdered) *
        parseInt(this.itemModify.currentPrice);
    },
    onModifyPriceChange() {
      this.itemModify.price =
        parseInt(this.itemModify.qtyOrdered) *
        parseInt(this.itemModify.currentPrice);
    },
    async modifyItemList() {
      this.$Progress.start();
      await axios
        .patch("/api/item-sales/" + this.itemModify.id, this.itemModify)
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Congratulations",
            text: "Success modify item on sales order table",
          });
          this.itemModify = {
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
          };
        });
      this.loadData();
      this.isVisibleAddForm = false;
      this.isVisibleModifyForm = true;
      this.selected.usedBy = "";
      this.$Progress.finish();
    },
    async loadData() {
      this.$Progress.start();
      // Load data relation
      const dataSalesOrder = await axios.get(
        `/api/sales/order/${this.$route.params.so_id}`
      );
      this.dataSalesOrder = dataSalesOrder.data;
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
      this.$Progress.finish();
    },
    async modifyItemPurchasing(id) {
      this.$Progress.start();
      const resp = await axios.get("/api/item-sales/" + id);
      this.checkedItem = true;
      this.itemModify = resp.data;
      this.itemModify.currentPrice = resp.data.item.price;
      this.itemModify.item_name = `${resp.data.item.item_code} - ${resp.data.item.item_name}`;
      this.itemModify.warehouseid = resp.data.warehouse.id;
      this.itemModify.warehouse_name = resp.data.warehouse.warehouse_name;
      this.selected.usedBy = `${resp.data.used.name}`;
      this.itemModify.used_by = resp.data.used.id;
      this.itemModify.itemid = resp.data.item.id;
      this.titleItemDescription = "Modify Sales Order Items";
      this.isVisibleAddForm = true;
      this.isVisibleModifyForm = false;
      this.isShow.qtyItem = true;
      this.qtyItem = resp.data.item.qty;
      window.scrollTo(0, 0);
      this.$Progress.finish();
    },
    async addToList() {
      this.$Progress.start();
      await axios.post("/api/item-sales", this.itemAdd).then((response) => {
        Swal.fire({
          icon: "success",
          title: "Congratulations",
          text: "Success add item on Sales order table",
        });
        this.itemAdd = {
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
        };
      });
      this.loadData();
      this.selected.warehouse = "";
      this.selected.item = "";
      this.selected.usedBy = "";
      this.isDisable = {
        select: true,
        input: true,
      };
      this.$Progress.finish();
    },
    async submitHandle() {
      this.$Progress.start();
      await axios
        .patch(
          `/api/sales/order/${this.dataSalesOrder.id}`,
          this.salesOrderData
        )
        .then((response) => {
          this.loadData();
          Swal.fire({
            icon: "success",
            title: "Congratulations",
            text: "Success New sales order",
          });
          this.salesOrderData = {
            so_number: "",
            customer: "",
            order_date: "",
            remarks: "",
          };
          this.$router.push("/sales/order");
          this.$Progress.finish();
        })
        .catch((error) => {
          this.$Progress.fail();
          Swal.fire({
            icon: "warning",
            title: "Something wrong.",
            confirmButtonText: `Ok`,
            html:
              `There is something wrong on my side. Please click ok to refresh this page and see what is it. If
                it still exist, you can contact our developer. <br><br>Error message: ` +
              error,
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
        });
    },
    async deleteItemPurchasing(id) {
      const result = await Swal.fire({
        title: "Delete item sales order?",
        showCancelButton: true,
        cancelButtonColor: "#d33",
        confirmButtonText: `Delete`,
      });
      if (result.isConfirmed) {
        this.$Progress.start();
        await axios.delete("/api/item-sales/" + id);
        this.loadData();
        await Swal.fire({
          icon: "success",
          title: "Successfully Deleted",
          text: "Success deleted current item.",
        });
        this.$Progress.finish();
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
