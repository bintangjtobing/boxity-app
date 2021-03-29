<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Issue Center</h4>
                    <p>If data was not shown, you can <a @click="refreshPage">refresh</a> this page for a several times.
                        If still happens,
                        you can contact the developer to fix this bugs.</p>
                </div>
            </div>
        </div>
        <div class="banner-feature--14 card mb-25">
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
                                        class="btn btn-primary btn-default btn-squared btn-shadow-primary"
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
            <div class="col-12 col-sm-12 col-lg-7">
                <div class="headerIssueList mb-4">
                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">Issue lists</h4>
                    </div>
                    <span>The information displayed here is only the information assigned <u>to you</u>.</span>
                </div>
                <div class="userDatatable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <span class="userDatatable-title"><i class="fas fa-code-branch"></i>
                                            issue</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">priority</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">status</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!issues.length">
                                    <td colspan="3">
                                        <div class="atbd-empty text-center">
                                            <div class="atbd-empty__image">
                                                <img src="/dashboard/img/folders/1.svg" alt="Admin Empty">
                                            </div>
                                            <div class="atbd-empty__text">
                                                <p class="">No issue assigned to you.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-for="issue in issues" :key="issue.id">
                                    <td>
                                        <div class="d-flex">
                                            <div class="userDatatable-inline-title">
                                                <a href="#" class="text-dark fw-500">
                                                    <router-link :to="`/issues/${issue.id}`">
                                                        <h6 v-if="issue.title.length<35">{{issue.title}}</h6>
                                                        <h6 v-if="issue.title.length>=35">
                                                            {{issue.title.substring(0,34)+"..."}}</h6>
                                                        <p>{{issue.comments_count}}
                                                            <i class="far fa-comment-dots"></i> · Created
                                                            {{issue.created_at}} by
                                                            {{issue.user.name}}
                                                        </p>
                                                    </router-link>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content">
                                            <div v-if="issue.priority===0">
                                                <span class="priority-lowest"><i class="fas fa-arrow-up"></i>
                                                    Lowest</span>
                                            </div>
                                            <div v-if="issue.priority===1">
                                                <span class="priority-low"><i class="fas fa-arrow-up"></i> Low</span>
                                            </div>
                                            <div v-if="issue.priority===2">
                                                <span class="priority-medium"><i class="fas fa-arrow-up"></i>
                                                    Medium</span>
                                            </div>
                                            <div v-if="issue.priority===3">
                                                <span class="priority-high"><i class="fas fa-arrow-up"></i>
                                                    High</span>
                                            </div>
                                            <div v-if="issue.priority===4">
                                                <span class="priority-highest"><i class="fas fa-arrow-up"></i>
                                                    Highest</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content d-inline-block">
                                            <div v-if="issue.status=='0'">
                                                <span
                                                    class="bg-opacity-danger color-danger rounded-pill userDatatable-content-status active">Unapproved</span>
                                            </div>
                                            <div v-if="issue.status=='1'">
                                                <span
                                                    class="bg-opacity-primary color-primary rounded-pill userDatatable-content-status active">Approved</span>
                                            </div>
                                            <div v-if="issue.status=='2'">
                                                <span class="bg-opacity-success color-success rounded-pill
                                                    userDatatable-content-status active"><span><i
                                                            class="far fa-history"></i> </span>&nbsp;Done</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-5" style="background-color: #272b411a; border-radius: .45rem;">
                <div class="headerIssueList mb-4">
                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">From you.</h4>
                    </div>
                    <span>The information displayed here is only the information assigned <u>from you</u>.</span>
                </div>
                <div class="userDatatable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                    <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <span class="userDatatable-title"><i class="fas fa-code-branch"></i>
                                            issue</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">status</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!fromYou.length">
                                    <td colspan="3">
                                        <div class="atbd-empty text-center">
                                            <div class="atbd-empty__image">
                                                <img src="/dashboard/img/folders/1.svg" alt="Admin Empty">
                                            </div>
                                            <div class="atbd-empty__text">
                                                <p class="">No issue from you.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-for="fromYous in fromYou" :key="fromYous.id">
                                    <td>
                                        <div class="d-flex">
                                            <div class="userDatatable-inline-title">
                                                <a href="#" class="text-dark fw-500">
                                                    <router-link :to="`/issues/${fromYous.id}`">
                                                        <h6 v-if="fromYous.title.length<35">{{fromYous.title}}</h6>
                                                        <h6 v-if="fromYous.title.length>=35">
                                                            {{fromYous.title.substring(0,34)+"..."}}</h6>
                                                        <p>{{fromYous.comments_count}}
                                                            <i class="far fa-comment-dots"></i> · Created by
                                                            {{fromYous.user.name}}
                                                        </p>
                                                    </router-link>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content d-inline-block">
                                            <div v-if="fromYous.status=='0'">
                                                <span
                                                    class="bg-opacity-danger color-danger rounded-pill userDatatable-content-status active">Unapproved</span>
                                            </div>
                                            <div v-if="fromYous.status=='1'">
                                                <span
                                                    class="bg-opacity-primary color-primary rounded-pill userDatatable-content-status active">Approved</span>
                                            </div>
                                            <div v-if="fromYous.status=='2'">
                                                <span class="bg-opacity-success color-success rounded-pill
                                                    userDatatable-content-status active"><span><i
                                                            class="fas fa-clock"></i> </span>&nbsp;Done</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
            return 'Issue report';
        },
        data() {
            return {
                issues: {},
                fromYou: {},
                fromCreated: [],
                countComment: '0',
            }
        },
        mounted() {
            this.loadIssues();
        },
        methods: {
            async loadIssues() {
                const resp = await axios.get('/api/issue');
                this.issues = resp.data;
                const respy = await axios.get('/api/issue/created');
                this.fromYou = respy.data;
            },
            dateFromCreated() {
                return timeago.format(created_at);
            },
            refreshPage() {
                location.reload();
            }
        }
    }

</script>
