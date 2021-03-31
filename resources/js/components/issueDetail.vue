<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main mb-2">
                    <h4 class="text-capitalize breadcrumb-title">{{issues.title}} <span>#{{issues.id}}</span></h4>
                </div>
                <div v-if="issues.status=='0'">
                    <div class="mb-4 descIssue">
                        <span class="badge badge-round badge-outline-warning badge-lg" style="margin-right:0px;">
                            <i class="fas fa-info-circle"></i>&nbsp;Unapproved
                        </span>
                        <span class="desc"><b>{{issues.name}}</b> opened this issue {{created}} · {{countComment}}
                            <i class="far fa-comment-dots"></i></span>
                    </div>
                </div>
                <div v-if="issues.status=='1'">
                    <div class="mb-4 descIssue">
                        <span class="badge badge-round badge-outline-success badge-lg" style="margin-right:0px;">
                            <i class="fas fa-info-circle"></i>&nbsp;Open
                        </span>
                        <span class="desc"><b>{{issues.name}}</b> opened this issue {{created}} · {{countComment}}
                            <i class="far fa-comment-dots"></i></span>
                    </div>
                </div>
                <div v-if="issues.status=='2'">
                    <div class="mb-4 descIssue">
                        <span class="badge badge-round badge-outline-closed badge-lg" style="margin-right:0px;">
                            <i class="fas fa-history"></i>&nbsp;Closed
                        </span>
                        <span class="desc"><b>{{issues.name}}</b> opened this issue {{created}} · {{countComment}}
                            <i class="far fa-comment-dots"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-lg-9">
                <div class="card card-Vertical card-default card-md mb-4">
                    <div class="card-body pb-md-30">
                        <div class="comment-list">
                            <ul class="comment-list__content">
                                <li class="mb-20">
                                    <div class="atbd-comment-box media">
                                        <div class="atbd-comment-box__author">
                                            <figure>
                                                <img :src="`/dashboard/img/author/profile/`+issues.avatar"
                                                    class="bg-opacity-primary d-flex" alt="Reporter avatar">
                                            </figure>
                                        </div>
                                        <div class="atbd-comment-box__content media-body">
                                            <div class="comment-content-inner cci">
                                                <span class="cci__author-info">{{issues.name}}</span>
                                                <span class="cci__comment-text" v-html="issues.issue"></span>
                                                <div class="cci__comment-actions">
                                                    <a v-on:click="Hidden=true" v-if="issues.status!=0"
                                                        class="btn-reply">
                                                        <span>Reply</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-20 text-center listComment" v-if="!comments.length && issues.status!=0">
                                    No comments, <span v-on:click="Hidden=true">add some comments?</span>
                                </li>
                                <hr>
                                <li class="mb-20" v-for="comment in comments" :key="comment.id">
                                    <div class="atbd-comment-box media">
                                        <div class="atbd-comment-box__author">
                                            <figure>
                                                <img :src="`/dashboard/img/author/profile/`+issues.avatar"
                                                    class="bg-opacity-primary d-flex" alt="Reporter avatar">
                                            </figure>
                                        </div>
                                        <div class="atbd-comment-box__content media-body">
                                            <div class="comment-content-inner cci">
                                                <span class="cci__author-info">{{comment.name}}</span>
                                                <span class="cci__comment-text" v-html="
                                                comment.comment"></span>
                                                <div class="cci__comment-actions">
                                                    <a class="btn-reply">
                                                        <span>Commented on {{commentAt}}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="form-group" v-if="Hidden">
                    <div class="card card-default card-md mb-4">
                        <div class="card-body pb-10">
                            <div class="reply-editor media">
                                <div class="reply-editor__author">
                                    <img :src="`/dashboard/img/author/profile/`+imageUser"
                                        class="bg-opacity-primary d-flex" alt="Response">
                                </div>
                                <div class="reply-editor__form media-body">
                                    <form @submit.prevent="handleComment">
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <textarea v-model="comment.desc" class="form-control mb-4"
                                                    placeholder="Leave a comment. Press `CTRL + ENTER` to send the comment."
                                                    @keydown.enter="handleComment"></textarea>
                                                <button type="submit"
                                                    class="btn btn-primary btn-lg btn-squared btn-shadow-primary fw-400 mr-1">
                                                    Comment</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" v-if="issues.status!=2">
                    <div class="justify-content-end">
                        <button v-on:click="closeIssue" type="submit"
                            class="btn btn-danger btn-default btn-squared px-30"><i class="fas fa-times"></i>&nbsp;Close
                            issue</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-Vertical card-default card-md">
                    <div class="card-body pb-md-30">
                        <div class="Vertical-form">
                            <div class="form-group">
                                <div class="sidebarInfo">
                                    <label>Assignee to:</label><br>
                                    <span>{{assignee.name}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="sidebarInfo">
                                    <label>Approved by:</label><br>
                                    <span>{{approver.name}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="sidebarInfo">
                                    <label>Priority</label><br>
                                    <div v-if="issues.priority==0">
                                        <span class="priority-lowest"><i class="fas fa-arrow-up"></i> Lowest</span>
                                    </div>
                                    <div v-if="issues.priority==1">
                                        <span class="priority-low"><i class="fas fa-arrow-up"></i> Low</span>
                                    </div>
                                    <div v-if="issues.priority==2">
                                        <span class="priority-medium"><i class="fas fa-arrow-up"></i> Medium</span>
                                    </div>
                                    <div v-if="issues.priority==3">
                                        <span class="priority-high"><i class="fas fa-arrow-up"></i> High</span>
                                    </div>
                                    <div v-if="issues.priority==4">
                                        <span class="priority-highest"><i class="fas fa-arrow-up"></i> Highest</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="vertical-form my-3" v-if="user.role=='head' && issues.status==0">
                    <div class="form-group">
                        <button v-on:click="approveIssue" type="submit" class="btn btn-primary btn-default btn-squared">
                            Approve issue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    import * as timeago from 'timeago.js';

    export default {
        title() {
            return 'Issue detail #' + this.$route.params.id;
        },
        data() {
            return {
                imageUser: '',
                username: '',
                issues: {},
                assignee: {},
                approver: {},
                Hidden: false,
                comment: {},
                comments: {},
                countComment: '0',
                user: {},
            }
        },
        computed: {
            created: function () {
                return timeago.format(this.issues.created_at);
            },
            commentAt: function () {
                return timeago.format(this.comments[0].created_at);
            },
        },
        created() {
            this.loadDataIssue();
            this.loadUserLoggedIn();
            this.loadAssignee();
            this.loadComments();
            this.loadApprover();
        },
        methods: {
            async loadUserLoggedIn() {
                const res = await axios.get('/getUserLoggedIn');
                this.user = res.data;
                this.imageUser = res.data.avatar;
                this.username = res.data.name;
            },
            async loadDataIssue() {
                const response = await axios.get('/api/issue/' + this.$route.params.id);
                const countComment = await axios.get('/api/count-comment/' + this.$route.params.id);
                this.issues = response.data[0];
                this.countComment = countComment.data;
            },
            async loadAssignee() {
                const response = await axios.get('/api/issue/assignee/' + this.$route.params.id);
                this.assignee = response.data[0];
            },
            async loadApprover() {
                const response = await axios.get('/api/issue/approver/' + this.$route.params.id);
                if (!response) {
                    this.approver.name = '';
                } else {
                    this.approver.name = response.data[0].name;
                }
            },
            async handleComment(event) {
                event.preventDefault();

                await axios.post('/api/issue/add-comment', {
                    comment: this.comment.desc,
                    issueid: this.issues.id
                }).then(response => {
                    this.loadComments();
                    this.loadDataIssue();
                    this.comment = {};
                    this.Hidden = false;
                }).catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something wrong.',
                        confirmButtonText: `Ok`,
                        html: `There is something wrong on my side. Please click ok to refresh this page and see what is it. If
                it still exist, you can contact our developer. <br><br>Error message: ` +
                            error,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                });
            },
            async loadComments() {
                const resp = await axios.get('/api/issue/comment/' + this.$route.params.id);
                this.comments = resp.data;
            },
            async approveIssue() {
                await axios.patch('/api/issue/approved/' + this.$route.params.id);
                this.loadApprover();
                this.loadDataIssue();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success approve and open this issue.',
                });
                this.$router.push('/issues');
            },
            async closeIssue() {
                await axios.patch('/api/issue/closed/' + this.$route.params.id);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Issue done and closed!',
                });
                this.$router.push('/issues');
            }
        },
    }

</script>
