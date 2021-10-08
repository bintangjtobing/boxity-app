<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Subscriptions</h2>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="table-responsive">
                        <v-data-table loading loading-text="Loading... Please wait" :headers="headers" :items="subsData"
                            :items-per-page="10" class="elevation-1">
                            <template v-slot:[`item.status`]="{ item }">
                                <div v-if="item.status==1">
                                    <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize"><i
                                            class="fal fa-check-circle"></i>
                                        &nbsp;Verificated</span>
                                </div>
                                <div v-if="item.status==0">
                                    <span class="rounded-pill userDatatable-content-status color-warning
                                                bg-opacity-warning active text-capitalize"><i
                                            class="fal fa-exclamation-circle"></i>
                                        &nbsp;Not Verificated</span>
                                </div>
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
            return 'Subscriptions';
        },
        data() {
            return {
                // datatable
                subsData: [],
                key: 1,
                headers: [{
                    text: 'Email',
                    value: 'email'
                }, {
                    text: 'Verification Status',
                    value: 'status'
                }],
                // end datatable
            }
        },
        created() {
            this.loadSubs();
        },
        methods: {
            async loadSubs() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/subscriptions');
                this.subsData = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
        },
    }

</script>
