<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main mb-2">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">{{issues.title}} <span>#{{issues.id}}</span>
                    </h2>
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
                                                        <span><i class="fas fa-reply"></i> Reply</span>
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
                                                <img :src="`/dashboard/img/author/profile/`+comment.user.avatar"
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
                                                        <span>Commented on {{commentAt}} &#183; <a
                                                                v-on:click="Hidden=true"
                                                                v-if="issues.status!=0 && comment.fromId != user.id"
                                                                class="btn-reply">
                                                                <span><i class="fas fa-reply"></i> Reply</span>
                                                            </a> <a v-on:click="deleteData(comment.id)"
                                                                class="btn-reply" v-if="comment.fromId == user.id">
                                                                <i class="fas fa-trash"></i></a></span>
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
                            <div class="form-group my-3">
                                <div class="sidebarInfo">
                                    <label>Assignee to:</label><br>
                                    <span>{{assignee.name}}</span>
                                </div>
                            </div>
                            <div class="form-group my-3">
                                <div class="sidebarInfo">
                                    <label>Approved by:</label><br>
                                    <span>{{approver.name}}</span>
                                </div>
                            </div>
                            <div class="form-group my-3">
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
                <div class="vertical-form my-3" v-if="user.role=='head' || user.role=='hrdga' && issues.status==0">
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
        },
        methods: {
            async loadDataIssue() {
                this.$Progress.start();
                const response = await axios.get('/api/issue/' + this.$route.params.id);
                const countComment = await axios.get('/api/count-comment/' + this.$route.params.id);
                this.issues = response.data[0];
                this.countComment = countComment.data;

                // Load comments
                const resp = await axios.get('/api/issue/comment/' + this.$route.params.id);
                this.comments = resp.data;

                // Load user logged in
                const res = await axios.get('/getUserLoggedIn');
                this.user = res.data;
                this.imageUser = res.data.avatar;
                this.username = res.data.name;
                console.log(this.user.role);

                // Load data assignee
                const assigneeProc = await axios.get('/api/issue/assignee/' + this.$route.params.id);
                this.assignee = assigneeProc.data[0];

                // Load data approver
                const approverProc = await axios.get('/api/issue/approver/' + this.$route.params.id);
                if (!approverProc) {
                    this.approver.name = '';
                } else {
                    this.approver.name = approverProc.data[0].name;
                }
                this.$Progress.finish();
            },
            async deleteData(id) {
                this.$Progress.start();
                await axios.delete('/api/issue/delete-comment/' + id);
                this.loadDataIssue();
                await Swal.fire({
                    icon: 'success',
                    title: 'Successfully Deleted',
                    text: 'Success deleted comment'
                });
                this.$Progress.finish();
            },
            async handleComment(event) {
                event.preventDefault();
                this.$Progress.start();
                await axios.post('/api/issue/add-comment', {
                    comment: this.comment.desc,
                    issueid: this.issues.id
                }).then(response => {
                    this.loadDataIssue();
                    this.comment = {};
                    this.Hidden = false;
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.fail();
                    Swal.fire({
                        icon: 'warning',
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
            async approveIssue() {
                this.$Progress.start();
                await axios.patch('/api/issue/approved/' + this.$route.params.id);
                this.loadDataIssue();
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success approve and open this issue.',
                });
                this.$Progress.finish();
                this.$router.push('/issues');
            },
            async closeIssue() {
                this.$Progress.start();
                await axios.patch('/api/issue/closed/' + this.$route.params.id);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Issue done and closed!',
                });
                this.$Progress.finish();
                this.$router.push('/issues');
            }
        },
    }

</script>
