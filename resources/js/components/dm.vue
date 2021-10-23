<template>
    <div>
        <div class="row mt-2">
            <div class="col-md-12 col-lg-12">
                <div class="breadcrumb-main">
                    <h2 class="text-capitalize fw-700 breadcrumb-title">Direct Message</h2>
                </div>
                <div class="chat-area d-flex mb-40">
                    <ContactList :contacts="contacts" @selected="startConversationWith"></ContactList>
                    <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"></Conversation>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Conversation from './dm-conversation.vue';
    import ContactList from './dm-contactList.vue';
    import Push from 'push.js';

    export default {
        components: {
            Conversation,
            ContactList,
        },
        title() {
            return 'Direct Message';
        },
        data() {
            return {
                contacts: [],
                messages: [],
                selectedContact: null,
                selected: 0,
                user: {},
            }
        },
        mounted() {
            this.loadEcho();
            this.loadContacts();
            this.loadUserLoggedIn();
        },
        methods: {
            async loadEcho() {
                const res = await axios.get('/getUserLoggedIn');
                const idGet = res.data.id;
                Echo.private('messages.' + idGet).notification((notification) => {
                        // console.log('test' + notification.type); //This never logs
                    })
                    .listen('newMessage', (e) => {
                        this.handleIncoming(e.message);
                        if (Notification.permission === "granted") {
                            // console.log('This browser does support desktop notification' + status);
                            Push.create("New message here!", {
                                body: 'Click to see the new message.',
                                link: '/direct-message',
                                icon: 'https://bintangtobing.com/icon.png',
                                timeout: 5000,
                                onClick: function () {
                                    window.focus();
                                    this.close();
                                }
                            });
                        }
                        // Otherwise, we need to ask the user for permission
                        else if (Notification.permission !== 'denied' || Notification.permission ===
                            "default") {
                            Notification.requestPermission(function (permission) {
                                // If the user accepts, let's create a notification
                                if (permission === "granted") {
                                    // console.log('This browser does support desktop notification' + status);
                                    Push.create("New message here!", {
                                        body: 'Click to see the new message.',
                                        link: '/direct-message',
                                        icon: 'https://bintangtobing.com/icon.png',
                                        timeout: 5000,
                                        onClick: function () {
                                            window.focus();
                                            this.close();
                                        }
                                    });
                                }
                            });
                        }
                    });
            },
            async loadUserLoggedIn() {
                const res = await axios.get('/getUserLoggedIn');
                this.user = res.data;
            },
            async loadContacts() {
                const resp = await axios.get('/api/list-contact');
                this.contacts = resp.data;
            },
            async startConversationWith(contact) {
                this.updateUnreadCount(contact, true);
                const resp = await axios.get('/api/chat/' + contact.id);
                this.messages = resp.data;
                this.selectedContact = contact;
            },
            saveNewMessage(message) {
                this.messages.push(message);
            },
            handleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }
                this.updateUnreadCount(message.from_contact, false);
            },
            updateUnreadCount(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.id !== contact.id) {
                        return single;
                    }
                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;
                    return single;
                })
            }
        },
    }

</script>
