<template>
    <div>
        <div class="tab-content" id="ueberTabB">
            <div class="tab-pane fade  show active" id="panel_b_first" role="tabpanel" aria-labelledby="first-tab">
                <div class="chat">
                    <div class="chat-body bg-white radius-xl" v-if="contact">
                        <div class="chat-header">
                            <div class="media chat-name align-items-center">
                                <div class="media-body align-self-center ">
                                    <h5 class=" mb-0 fw-500 mb-2">{{contact ? contact.name: 'Select a contact'}}</h5>
                                    <div class="media-body__content d-flex align-items-center">
                                        <span class="badge-dot dot-success mr-1"></span>
                                        <small class="d-flex color-light fs-12 text-capitalize">
                                            active now
                                        </small>
                                    </div>

                                </div>
                            </div>
                            <!-- Chat Options -->
                            <ul class="nav flex-nowrap">
                                <li class="nav-item list-inline-item mr-0">
                                    <div class="dropdown">
                                        <a href="#" role="button" title="Details" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fal fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item align-items-center d-flex" href="#">
                                                <!-- Default :: Inline SVG -->
                                                <span data-feather="trash-2"></span>

                                                <span>Delete conversation</span>
                                            </a>
                                            <a class="dropdown-item align-items-center d-flex" href="#">
                                                <!-- Default :: Inline SVG -->
                                                <span data-feather="x-octagon"></span>

                                                <span>Block & report</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <MessagesFeed :contact="contact" :messages="messages"></MessagesFeed>
                        <MessageComposer @send="sendMessage" />
                    </div>
                </div><!-- ends: .chat-->
            </div>
        </div>
    </div>
</template>
<script>
    import MessagesFeed from './dm-MessagesFeed.vue';
    import MessageComposer from './dm-MessageComposer.vue';

    export default {
        components: {
            MessagesFeed,
            MessageComposer
        },
        props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },
        methods: {
            sendMessage(text) {
                if (!this.contact) {
                    return;
                }
                axios.post('/api/chat/send', {
                    contact_id: this.contact.id,
                    text: text
                }).then((response) => {
                    this.$emit('new', response.data);
                })
                // console.log(text);
            }
        },
    }

</script>
