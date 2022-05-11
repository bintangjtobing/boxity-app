<template>
    <div>
        <div class="mb-lg-0 mb-40 chat-sidebar">
            <div class="sidebar-group left-sidebar chat_sidebar">
                <div id="chat" class="left-sidebar-wrap bg-white radius-xl active">
                    <div class="chat-wrapper py-25">
                        <div class="search-header">
                            <form action="/" class="d-flex align-items-center">
                                <span data-feather="search"></span>
                                <input class="form-control mr-sm-2 border-0 box-shadow-none" type="search"
                                    placeholder="Search" aria-label="Search">
                            </form>
                        </div>
                        <div class="search-body">
                            <div class="tab-content" id="ueberTabA">
                                <div class="tab-pane fade show active" id="panel_a_first" role="tabpanel"
                                    aria-labelledby="first-tab">
                                    <ul class="user-list">
                                        <li class="user-list-item" v-for="user in sortedContacts"
                                            :class="{'selected':user==selected}" :key="user.id"
                                            @click="selectContact(user)">
                                            <div class="user-list-item__wrapper">
                                                <div class="avatar avatar-circle ml-0">
                                                    <img :src="user.avatar"
                                                        class="rounded-circle wh-46 d-flex bg-opacity-primary"
                                                        :alt="user.name">
                                                    <div class="badge-direction-bottom">
                                                        <span class="chat-badge-dot avatar-online"></span>
                                                    </div>
                                                </div>
                                                <div class="users-list-body">
                                                    <div class="users-list-body-title">
                                                        <h6>{{user.name}}</h6>
                                                        <div class="text-limit" data-maxlength="10">
                                                            <p class="mb-0"><span>{{user.email}}</span></p>
                                                        </div>
                                                    </div>
                                                    <div class="last-chat-time unread">
                                                        <small>14:45 pm</small>

                                                        <div class="total-message mt-1 d-flex justify-content-end"
                                                            v-if="user.unread">
                                                            <span class="badge badge-success ">{{user.unread}}</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
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
        data() {
            return {
                selected: this.contacts.length ? this.contacts[0] : null
            }
        },
        props: {
            contacts: {
                type: Array,
                default: [],
            }
        },
        methods: {
            async selectContact(user) {
                // this.$Progress.start();
                this.$isLoading(true);
                const resp = await axios.get('/api/list-contact/' + user.id);
                this.selected = user;
                // this.$Progress.finish();
                this.$isLoading(false);
                this.$emit('selected', user);
            },
        },
        computed: {
            sortedContacts() {
                return _.sortBy(this.contacts, [(contact) => {
                    if (contact == this.selected) {
                        return Infinity;
                    }
                    return contact.unread;
                }]).reverse();
            }
        }
    }

</script>
