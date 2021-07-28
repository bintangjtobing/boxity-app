<template>
  <section v-bind:style="{ width: width }">
    <input
      type="text"
      v-model="item"
      @click="isShow()"
      v-bind:style="{ backgroundColor: '#fff' }"
      class="form-control form-control-default"
      readonly
    />
    <div v-show="!isHide" class="dropDown form-control form-control-default">
      <input
        type="text"
        v-model="searchTerm"
        @input="filterItem(searchTerm)"
        placeholder="Search..."
        class="form-control form-control-default"
      />
      <div>
        <section v-for="data in datas" :key="data.id">
          <button value="data.id" @click="selectItem(data)">
            {{ data.item_code + " - " + data.item_name }}
          </button>
        </section>
        <span v-show="isEmpty">Data tidak ditemukan</span>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ['datas', 'width'],
  data: function () {
    return {
      dataCopy: data,
      item: "",
      searchTerm: "",
      isHide: true,
      isEmpty: false,
    };
  },
  // mounted: function  () {
  //   this.isEmpty = this.data.length == 0 ? true : false;
  // },
  methods: {
    isShow: function () {
      this.isHide = !this.isHide;
      this.dataCopy = this.datas;
      this.isEmpty = this.datas.length == 0 ? true : false;
    },
    filterItem: function (filter) {
      this.datas = this.dataCopy.filter((dataArg) => {
        return (
          dataArg.item_name.toLowerCase().indexOf(filter.toLowerCase()) > -1
        );
      });
      this.isEmpty = this.datas.length == 0 ? true : false;
    },
    selectItem: function (param) {
      this.item = `${param.item_code} - ${param.item_name}`;
      this.$emit("dataSelected", param);
      this.isHide = true;
    },
  },
};
</script>

<style scoped>
.dropDown {
  height: auto;
  padding: 10px;
}
.dropDown div {
  padding: 10px 0 0;
}
.dropDown div button {
  padding: 0.8rem 1.2rem;
  width: 100%;
  height: auto;
  text-align: left;
}
.dropDown div button:hover {
  color: #5f63f2;
  background-color: #5f64f20f;
}
</style>
