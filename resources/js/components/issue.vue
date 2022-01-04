<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Issue Center <router-link to="/issues/i/closed"
                            class="ml-4 issueClosed"> <i class="fal fa-check"></i>
                            {{countClosedIssue}} Issues Closed</router-link>
                    </h2>
                </div>
            </div>
        </div>
        <div class="banner-feature--14 card my-25">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row align-items-center">
                        <div class="col-md-6 p-5">
                            <div class="card-body d-inline-block">
                                <h1 class="d-flex">Hello, We are here to help</h1>
                                <p>Anything we can help? Take it easy, we will help you as much as possible.
                                </p>
                                <div class="d-flex justify-content-start">
                                    <router-link :to="`/new-issue`"
                                        class="btn btn-primary-boxity btn-default btn-squared btn-shadow-primary"
                                        type="button">Create
                                        Issue
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="banner-feature__shape mt-50 d-flex justify-content-end">
                                <img :src="'/dashboard/img/svg/banne-group21.svg'" alt="issue center" class="svg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="headerIssueList mb-4">
                    <div class="breadcrumb-main">
                        <h2 class="text-capitalize fw-700 breadcrumb-title">Issue lists</h2>
                    </div>
                    <span>The information displayed here is only the information assigned <u>to you</u>.</span>
                </div>
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
                                <div v-if="item.status==='0'">
                                    <span class="rounded-pill userDatatable-content-status color-warning
                                                bg-opacity-warning active text-capitalize"><i
                                            class="fal fa-exclamation-circle"></i>
                                        &nbsp;Draft</span>
                                </div>
                                <div v-if="item.status==='1'">
                                    <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize"><i
                                            class="fal fa-check-circle"></i>
                                        &nbsp;Approved</span>
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
                            <template v-slot:[`item.actions`]="{item}">
                                <a v-on:click="approveIssue(item.id)" class="create"
                                    v-if="item.status=='0' && user.role=='admin' || user.role=='head'">
                                    <i class="far fa-thumbs-up"></i> Approve</a>
                                <router-link :to="`/issues/${item.id}`" class="edit">
                                    <i class="fad fa-eye"></i></router-link>
                            </template>
                        </v-data-table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-12" style="background-color: #272b411a; border-radius: .45rem;">
                <div class="headerIssueList mb-4">
                    <div class="breadcrumb-main">
                        <h2 class="text-capitalize fw-700 breadcrumb-title">From you.</h2>
                    </div>
                    <span>The information displayed here is only the information assigned <u>from you</u>.</span>
                </div>
                <div class="userDatatable global-shadow border p-15 bg-white radius-xl w-100 my-30">
                    <div class="table-responsive">
                        <v-card-title>
                            <v-text-field v-model="searchFromYou" append-icon="mdi-magnify" label="Search here..."
                                single-line hide-details>
                            </v-text-field>
                        </v-card-title>
                        <v-data-table :expanded.sync="expandedFromCreated" show-expand :search="searchFromYou"
                            :loading="loadings" loading-text="Loading... Please wait..." :headers="headers" multi-sort
                            :items="fromYou" :items-per-page="10" class="elevation-1">
                            <template v-slot:expanded-item="{ headers, item }">
                                <td :colspan="headers.length">
                                    More info: <span v-html="item.issue"></span>
                                </td>
                            </template>
                            <template v-slot:[`item.title`]="{item}">
                                <router-link :to="`/issues/${item.id}`">#{{item.id}} - {{item.title}}</router-link>
                            </template>
                            <template v-slot:[`item.status`]="{item}">
                                <div v-if="item.status==='0'">
                                    <span class="rounded-pill userDatatable-content-status color-warning
                                                bg-opacity-warning active text-capitalize"><i
                                            class="fal fa-exclamation-circle"></i>
                                        &nbsp;Draft</span>
                                </div>
                                <div v-if="item.status==='1'">
                                    <span class="rounded-pill userDatatable-content-status color-success
                                                bg-opacity-success active text-capitalize"><i
                                            class="fal fa-check-circle"></i>
                                        &nbsp;Approved</span>
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
    import * as timeago from 'timeago.js';
    import Swal from 'sweetalert2';
    export default {
        title() {
            return 'Issue report';
        },
        data() {
            return {
                fromCreated: [],
                countComment: '0',
                countClosedIssue: 0,

                // datatable
                expanded: [],
                expandedFromCreated: [],
                search: '',
                loading: true,
                loadings: true,
                searchFromYou: '',
                key: 1,
                issues: [],
                fromYou: [],
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
                    }, {
                        text: 'Actions',
                        value: 'actions',
                        align: 'right',
                        filterable: false,
                        sortable: false
                    }
                ],
                // end datatable
                user: {},
            }
        },
        mounted() {
            this.loadIssues();
            this.getUser();
            this.countCloseIssues();
        },
        methods: {
            async loadIssues() {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/issue');
                this.issues = resp.data;
                if (resp.data.length) {
                    this.loading = false
                }

                // Get issue from user logged in
                const respy = await axios.get('/api/issue/created');
                this.fromYou = respy.data;
                if (respy.data.length) {
                    this.loadings = false
                }
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
            async countCloseIssues() {
                const getIssueClosed = await axios.get('/api/issue/c/closed');
                this.countClosedIssue = getIssueClosed.data;
            },
            async approveIssue(id) {
                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: 'Are you sure want to approve this issue?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, approve this!',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.patch('/api/issue/approved/' + id);
                        document.getElementById('ding').play();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success approve!',
                            text: 'You have been successfully approve this issue.',
                        });
                        this.loadIssues();
                    }
                });
            }
        }
    }

</script>
