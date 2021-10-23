<template>
    <div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Inbox</h2>
                </div>
            </div>
            <div class="col-lg-2">
                <aside class="mailbox-sidebar-container">


                    <div class="atbd-mail-sidebar show mb-30">
                        <div class="card">
                            <a href="#" class="mailbar-cross d-md-none">
                                <span data-feather="x"></span>
                            </a>
                            <div class="card-body">
                                <div class="d-flex align-content-center content-center px-15">
                                    <a href="#" class="btn-compose btn btn-md btn-primary btn-shadow-primary"
                                        data-trigger="compose"> <span data-feather="plus"></span> Compose</a>
                                </div>
                                <ul class="mail-list">
                                    <li><a class="active" href="#"><span data-feather="inbox"></span>Inbox <span
                                                class="badge badge-primary badge-transparent">{{inboxCount}}</span></a>
                                    </li>
                                    <!-- <li><a href="#"><span data-feather="star"></span>Started</a></li>
                                    <li><a href="#"><span data-feather="send"></span>Send</a></li>
                                    <li><a href="#"><span data-feather="edit"></span>Draft <span
                                                class="badge badge-primary badge-transparent">12</span></a></li>
                                    <li><a href="#"><span data-feather="alert-octagon"></span>Spam</a></li>
                                    <li><a href="#"><span data-feather="trash-2"></span>Trash</a></li> -->
                                </ul>
                                <!-- <span class="mail-list-title m-top-35">Lable</span>
                                <ul class="mail-list mt-0">
                                    <li><a href="#"><span data-feather="list"></span>Personal</a></li>
                                    <li><a href="#"><span data-feather="list"></span>Social</a></li>
                                    <li><a href="#"><span data-feather="list"></span>Promotion</a></li>
                                </ul>
                                <div class="btn-add-label" data-trigger="label">
                                    <span class="cursor-true"><span data-feather="plus"></span>Add New Label</span>
                                    <div class="add-lebel-from">
                                        <form action="#">
                                            <h6>Add New Label</h6>
                                            <input type="text" class="form-control" name="label"
                                                Placeholder="Enter label name">
                                            <div class="label-action d-flex button-group">
                                                <button class="btn btn-primary btn-sm btn-squared">Add Label</button>
                                                <button class="btn btn-white btn-sm btn-squared label-close"
                                                    data-trigger="label">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div> -->
                            </div>
                        </div><!-- ends: .card -->
                    </div><!-- ends: .atbd-mail-sidebar -->


                </aside>
            </div>
            <!-- ends: .col-lg-2 -->
            <div class="col-lg-10 mb-30">
                <div class="mailbox-container">
                    <div class="mailbar-toggle d-md-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div class="mailbox-list">
                        <div class="card">
                            <div class="card-body">
                                <div class="mailbox-list__content">


                                    <div class="table-responsive">
                                        <v-card-title>
                                            <v-text-field v-model="search" append-icon="mdi-magnify"
                                                label="Search here..." single-line hide-details></v-text-field>
                                        </v-card-title>
                                        <v-data-table :search="search" :headers="headers" multi-sort :items="inbox"
                                            :items-per-page="10" class="elevation-1" hide-default-header show-select>
                                            <template v-slot:[`item.subject`]="{ item }">
                                                <div class="mail-content my-4">
                                                    <div class="mail-content__top">
                                                        <h6 class="mail-title">
                                                            <a href="#">{{item.subject}}</a>
                                                            <span class="badge badge-primary badge-round">Inbox</span>
                                                        </h6>
                                                        <p>{{item.message}}</p>
                                                    </div>

                                                </div>
                                            </template>
                                        </v-data-table>
                                    </div>


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
    import Swal from 'sweetalert2';
    import Editor from '@tinymce/tinymce-vue';

    export default {
        components: {
            'editor': Editor
        },
        title() {
            return 'Inbox';
        },
        data() {
            return {
                inbox: [],
                selected: [],
                headers: [{
                        text: '',
                        value: 'name'
                    }, {
                        text: '',
                        value: 'subject'
                    },
                    {
                        text: '',
                        value: 'created_at'
                    }
                ],
                search: '',
                key: 1,

            }
        },
        computed: {
            inboxCount() {
                return this.inbox.length
            }
        },
        mounted() {
            this.loadInbox();
        },
        methods: {
            async loadInbox() {
                const resp = await axios.get('/api/inbox');
                this.inbox = resp.data;
            }
        },
    }

</script>
