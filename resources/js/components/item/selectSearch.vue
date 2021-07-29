<template>
    <section v-bind:style="{ width: width }">
        <input type="text" :value="value" @click="isShow()" :class="classWhite(isDisable)" class="form-control"
            :disabled="isDisable" readonly required />
        <div v-show="!isHide" class="dropDown form-control form-control-default">
            <input type="text" v-model="searchTerm" @input="filterItem(searchTerm)" placeholder="Search..."
                class="form-control form-control-default" />
            <div>
                <section v-show="group" v-for="data in dataItem" :key="'Group-' + data[name] + data.id">
                    <button value="data.id" @click="selectItem(data)">
                        {{ data[group] + " - " + data[name] }}
                    </button>
                </section>
                <section v-show="!group" v-for="data in dataItem" :key="'Name-' + data[name] + data.id">
                    <button value="data.id" @click="selectItem(data)">
                        {{ data[name] }}
                    </button>
                </section>
                <span v-show="isEmpty">Data tidak ditemukan</span>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ["datas", "width", "isDisable", "name", "group", "value", "isDisable"],
        data: function () {
            return {
                dataItem: [],
                dataCopy: [],
                item: "",
                searchTerm: "",
                isHide: true,
                isEmpty: false,
            };
        },
        // watch: {
        //   printOut () {
        //     if (this.group) {
        //       return this.group + " - " + this.name
        //     }
        //     return this.name
        //   }
        // },
        // created: function () {
        //   this.item = this.submitted ? "" : this.item;
        // },
        // created: function () {
        //   this.log();
        // },
        methods: {
            classWhite: function (param) {
                return param ? "" : "white";
            },
            // log: function () {
            //   setInterval(() => {
            //     console.log(this.datas);
            //   }, 1000); // 1000
            // },
            isShow: function () {
                this.isHide = !this.isHide;
                this.dataItem = this.datas;
                this.dataCopy = this.datas;
                this.isEmpty = this.dataItem.length == 0 ? true : false;
            },
            filterItem: function (filter) {
                this.dataItem = this.dataCopy.filter((dataArg) => {
                    return (
                        dataArg[this.name].toLowerCase().indexOf(filter.toLowerCase()) > -1
                    );
                });
                this.isEmpty = this.dataItem.length == 0 ? true : false;
            },
            selectItem: function (param) {
                this.item = this.group ?
                    `${param[this.group]} - ${param[this.name]}` :
                    `${param[this.name]}`;
                this.$emit("dataSelected", param);
                this.isHide = true;
            },
        },
    };

</script>

<style scoped>
    .dropDown {
        height: auto;
        max-height: 18rem;
        padding: 10px;
        overflow: auto;
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

    .white {
        background-color: #fff;
    }

</style>
