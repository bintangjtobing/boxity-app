<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between ">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">user logs</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="userDatatable adv-table-table global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :headers="headers" multi-sort :search="search" :items="members"
                            :items-per-page="10" loading loading-text="Loading... Please wait" class="elevation-1">
                            <template v-slot:item.ipAddress="{ item }">
                                <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize">
                                    &nbsp;{{item.ipAddress}}</span>
                            </template>
                        </v-data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        title() {
            return 'User Logs';
        },
        data() {
            return {
                members: [],
                search: '',
                key: 1,
                headers: [{
                    text: 'Date',
                    value: 'created_at'
                }, {
                    text: 'User',
                    value: 'user.name'
                }, {
                    text: 'IP Address',
                    value: 'ipAddress'
                }, {
                    text: 'Log',
                    value: 'notes'
                }],
            };
        },
        mounted() {
            this.loadUserLogs();
        },
        methods: {
            async loadUserLogs() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resMember = await axios.get('/api/user-logs');
                this.members = resMember.data;
            },
        },
    }

</script>
