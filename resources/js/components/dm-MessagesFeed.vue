<template>
    <div>
        <div class="chat-box p-xl-30 pl-lg-20 pr-lg-0" v-if="contact">
            <div v-for="message in messages" :key="message.id" class="flex-1 my-3 "
                :class="`${message.to == contact.id ? ' justify-content-end d-flex outgoing-chat' : ' incoming-chat'}`">
                <div class="chat-text-box" ref="feed">
                    <!-- Outgoing Chat -->
                    <div class="media" v-if="message.to == contact.id">
                        <div class="media-body">
                            <div class="chat-text-box__content">
                                <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                    <span
                                        class="chat-text-box__time fs-12 color-light fw-400">{{message.updated_at}}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="chat-text-box__other d-flex">
                                    </div>
                                    <div class="chat-text-box__subtitle p-20 bg-deep">
                                        <p class="color-gray">{{message.text}}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Incoming Chat -->
                    <div class="media" v-if="message.to != contact.id">
                        <div class="chat-text-box__photo ">
                            <img :src="`/dashboard/img/author/profile/`+contact.avatar"
                                class="align-self-start mr-15 wh-46 circleImgProfile" alt="img">
                        </div>
                        <div class="media-body">
                            <div class="chat-text-box__content">
                                <div class="chat-text-box__title d-flex align-items-center">
                                    <h6 class="fs-14">{{contact.name}}</h6>
                                    <span
                                        class="chat-text-box__time fs-12 color-light fw-400 ml-15">{{message.updated_at}}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="chat-text-box__subtitle p-20 bg-primary">
                                        <p class="color-white">{{message.text}}</p>
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
    export default {
        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                require: true
            }
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            }
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            }
        }
    }

</script>
