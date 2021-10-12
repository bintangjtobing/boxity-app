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
                                                class="badge badge-primary badge-transparent">5</span></a></li>
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


                                <div class="mailbox-top d-flex justify-content-between align-items-center">
                                    <div class="mailbox-top__left">
                                        <ul class="mailbox-top__actions d-flex align-items-center">

                                            <li class="mail-selection checkbox-theme-default custom-checkbox">
                                                <input class="checkbox" type="checkbox" id="mail-select">
                                                <label for="mail-select">
                                                    <span data-feather="chevron-down">Checkbox</span>
                                                </label>
                                                <ul class="mail-selection__dropdown">
                                                    <li>
                                                        <a href="#">All</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Read</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Starred</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Unstarred</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!-- <li>
                                                <a class="icon-action active" href="" data-toggle="tooltip"
                                                    data-placement="bottom" title="Refresh">
                                                    <i class="las la-redo-alt"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="icon-action" href="" data-toggle="tooltip"
                                                    data-placement="bottom" title="Archive">
                                                    <span data-feather="archive"></span></a>
                                            </li>


                                            <li>
                                                <a class="icon-action" href="" data-toggle="tooltip"
                                                    data-placement="bottom" title="Info">
                                                    <span data-feather="alert-octagon"></span></a>
                                            </li>
                                            <li>
                                                <a class="icon-action" href="" data-toggle="tooltip"
                                                    data-placement="bottom" title="Delete">
                                                    <span data-feather="trash-2"></span></a>
                                            </li>
                                            <li>
                                                <a class="icon-action" href="" data-toggle="tooltip"
                                                    data-placement="bottom" title="Read">
                                                    <span data-feather="book-open"></span></a>
                                            </li>
                                            <li>
                                                <a class="icon-action" href="" data-toggle="tooltip"
                                                    data-placement="bottom" title="Folder">
                                                    <span data-feather="folder"></span></a>
                                            </li> -->
                                        </ul>
                                        <!-- ends: .mailbox-top__actions -->
                                    </div>
                                    <!-- ends: .mailbox-top__left -->
                                    <div class="mailbox-top__right d-flex align-items-center">

                                        <div class="mailbox-top__search">
                                            <div class="input-container icon-left position-relative">
                                                <span class="input-icon icon-left">
                                                    <span data-feather="search"></span>
                                                </span>
                                                <input type="text" class="form-control form-control-lg"
                                                    placeholder="Search mail">
                                            </div>
                                        </div>
                                        <!-- ends: .mailbox-top__Search -->

                                        <div class="mailbox-top__extra d-flex align-items-center">
                                            <span class="result-perpage">1 - 50 of 235</span>
                                            <div class="mail-sliding-control">
                                                <a class="icon-action" href="#">
                                                    <i class="la la-angle-left"></i>
                                                </a>
                                                <a class="icon-action active" href="#">
                                                    <i class="la la-angle-right"></i>
                                                </a>
                                            </div>
                                            <a class="icon-action" href="#">
                                                <span data-feather="sliders"></span></a>
                                            <div class="dropdown">
                                                <a href="#" class="ellipsis-more" role="button" id="ellipsis-more"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span data-feather="more-vertical"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="ellipsis-more">
                                                    <a class="dropdown-item" href="#">More One</a>
                                                    <a class="dropdown-item" href="#">More Two</a>
                                                    <a class="dropdown-item" href="#">More Three</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ends: .mailbox-top__extra -->
                                    </div>
                                    <!-- ends: .mailbox-top__right -->
                                </div>


                                <div class="mailbox-list__content">


                                    <div class="mailbox-list__single d-flex justify-content-between"
                                        v-for="inbox in inbox" :key="inbox.id">
                                        <div class="mail-authorBox d-flex">
                                            <div class="checkbox-theme-default custom-checkbox">
                                                <input class="checkbox" type="checkbox" id="mail-1">
                                                <label for="mail-1"></label>
                                            </div>
                                            <span class="auhor-info">
                                                <span class="author-name">{{inbox.name}}</span>
                                            </span>
                                        </div>
                                        <div class="mail-content">
                                            <div class="mail-content__top">
                                                <h6 class="mail-title">
                                                    <a href="#">{{inbox.subject}}</a>
                                                    <span class="badge badge-transparent badge-round">Inbox</span>
                                                </h6>
                                                <p>{{inbox.message}}</p>
                                            </div>

                                        </div>
                                        <span class="time-meta">{{inbox.created_at}}</span>
                                    </div>


                                </div>


                                <div class="atbd-mailCompose atbd-mailCompose--position">
                                    <form action="#">
                                        <div
                                            class="atbd-mailCompose__header d-flex justify-content-between align-items-center">
                                            <h6 class="mailCompose-title">New Message</h6>
                                            <div class="atbd-mailCompose__action">
                                                <a href="#">
                                                    <span data-feather="maximize-2"></span></a>
                                                <a class="compose-close" href="#" data-trigger="compose">
                                                    <span data-feather="x"></span></a>
                                            </div>
                                        </div>
                                        <!-- ends: .atbd-mailCompose__header -->
                                        <div class="atbd-mailCompose__body">
                                            <div class="mailCompose-form-content">
                                                <div class="form-group positon-relative">
                                                    <select name="mail-to" id="mail-to" class="form-control-lg"
                                                        multiple="multiple">
                                                        <option value="01">demo@example.com</option>
                                                        <option value="02">test@example.com</option>
                                                        <option value="03">xxx@example.com</option>
                                                    </select>
                                                    <span class="input-label">To</span>
                                                </div>
                                                <div class="form-group positon-relative">
                                                    <input type="text" class="form-control-lg" name="mail-to"
                                                        placeholder="Subject">

                                                </div>
                                                <div class="form-group">
                                                    <textarea name="message" id="mail-message" class="form-control-lg"
                                                        placeholder="Type your message..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ends: .atbd-mailCompose__body -->
                                        <div
                                            class="atbd-mailCompose__footer d-flex justify-content-between align-items-center">
                                            <div class="footer-left d-flex align-items-center">
                                                <button class="btn btn-md btn-primary">Send</button>
                                                <a href="#">
                                                    <span data-feather="paperclip"></span></a>
                                                <a href="#">
                                                    <span data-feather="smile"></span></a>
                                            </div>
                                            <div class="footer-right">
                                                <a href="#" class="btn-remove">
                                                    <span data-feather="trash-2"></span></a>
                                            </div>
                                        </div>
                                        <!-- ends: .atbd-mailCompose__footer -->
                                    </form>
                                </div>
                                <!-- ends: .atbd-mailCompose -->


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
                inbox: {},
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
