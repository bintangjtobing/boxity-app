<template>
    <div>
        <div class="row mt-2 justify-content-md-center">
            <div class="col-xs-12 col-sm-6 col-lg-8">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Direct Message</h4>
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

    export default {
        components: {
            Conversation,
            ContactList
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
            Echo.private(`messages.${this.user.id}`)
                .listen('newMessage', (e) => {
                    this.handleIncoming(e.message);
                })
            this.loadContacts();
            this.loadUserLoggedIn();
        },
        methods: {
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
