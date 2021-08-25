<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Issue Closed
                    </h2>
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search here..." single-line
                                hide-details>
                            </v-text-field>
                        </v-card-title>
                        <v-data-table :expanded.sync="expanded" show-expand :search="search" :loading="loading"
                            loading-text="Loading... Please wait..." :headers="headers" multi-sort :items="issues"
                            :items-per-page="10" class="elevation-1">
                            <template v-slot:expanded-item="{ headers, item }">
                                <td :colspan="headers.length">
                                    More info: <span v-html="item.issue"></span>
                                </td>
                            </template>
                            <template v-slot:[`item.title`]="{item}">
                                <router-link :to="`/issues/${item.id}`">#{{item.id}} - {{item.title}}</router-link>
                            </template>
                            <template v-slot:[`item.status`]="{item}">
                                <div v-if="item.status==='2'">
                                    <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize"><i class="fal fa-check"></i>
                                        &nbsp;Done</span>
                                </div>
                            </template>
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
                        </v-data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import * as timeago from 'timeago.js';
    export default {
        title() {
            return 'Issue Closed';
        },
        data() {
            return {
                countComment: '0',

                // datatable
                expanded: [],
                loading: false,
                search: '',
                key: 1,
                issues: [],
                headers: [{
                        text: 'Issue',
                        value: 'title'
                    }, {
                        text: 'Reporter',
                        value: 'user.name'
                    }, {
                        text: 'Issue Date',
                        value: 'created_at'
                    },
                    {
                        text: 'Status',
                        value: 'status'
                    },
                    {
                        text: 'Priority',
                        align: 'right',
                        value: 'priority'
                    }
                ],
                // end datatable
                user: {},
            }
        },
        mounted() {
            this.loadIssues();
            this.getUser();
        },
        methods: {
            async loadIssues() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/issue/closed');
                if (resp) {
                    this.loading = true;
                }
                this.issues = resp.data;
                // this.$Progress.finish();
                this.$isLoading(false);
            },
            dateFromCreated() {
                return timeago.format(created_at);
            },
            async getUser() {
                // Load user logged in
                const res = await axios.get('/getUserLoggedIn');
                this.user = res.data;
            },
        }
    }

</script>
