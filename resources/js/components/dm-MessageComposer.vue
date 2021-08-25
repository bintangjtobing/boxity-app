<template>
    <div>
        <div class="chat-footer px-xl-30 px-lg-20 pb-lg-30 pt-1">
            <div class="chat-type-text">
                <div class="pt-0 outline-0 pb-0 pr-0 pl-0 rounded-0 position-relative d-flex align-items-center"
                    tabindex="-1">
                    <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
                        <div class=" flex-1 d-flex align-items-center chat-type-text__write ml-0">
                            <a href="#">
                                <span data-feather="smile"></span></a>
                            <input autofocus class="form-control border-0 bg-transparent box-shadow-none"
                                placeholder="Type your message..." v-model="message" @keydown.enter="send">

                        </div>
                        <div class="chat-type-text__btn">
                            <button type="button" :click="send" class="border-0 btn-primary-boxity wh-50 p-10 rounded-circle">
                                <i class="far fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                message: '',
            }
        },
        methods: {
            send(e) {
                e.preventDefault();
                if (this.message == '') {
                    return;
                }
                this.$emit('send', this.message);
                this.message = '';
            }
        },
    }

</script>
