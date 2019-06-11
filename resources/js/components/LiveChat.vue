<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
        <ContactsList :contacts="contacts" @selected="startConversationWith"/>
    </div>
</template>

<script>
import Conversation from "./Conversation";
import ContactsList from "./ContactsList";
export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            selectedContact: null,
            messages: [],
            contacts: []
        };
    },
    mounted() {
        Echo.private(`messages.${this.user.id}`).listen("NewMessage", e => {
            this.handleIncoming(e.message);
        });
        axios.get("/contacts").then(response => {
            console.log(response.data);
            this.contacts = response.data;
        });
    },

    methods: {
        startConversationWith(contact) {
            this.updateUnreadCount(contact, true);
            axios.get(`/conversation/${contact.id}`).then(response => {
                this.messages = response.data;
                this.selectedContact = contact;
            });
        },
        saveNewMessage(message) {
            this.messages.push(message);
        },
        handleIncoming(message) {
            if (
                this.selectedContact &&
                message.from == this.selectedContact.id
            ) {
                this.saveNewMessage(message);
                return;
                // this.messages.push(message) //does same same thing of above
            }
            // alert(message.text);
            // console.log(message);
            this.updateUnreadCount(message.from_contact, false);
        },
        updateUnreadCount(contact, reset) {
            this.contacts = this.contacts.map(single => {
                if (single.id != contact.id) {
                    return single;
                }
                if (reset) single.unread = 0;
                else single.unread += 1;
                return single;
            });
        }
    },
    components: { Conversation, ContactsList }
};
</script>

<style lang="scss" scoped>
.chat-app {
    display: flex;
}

//for scroll

/* width */
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 5px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: blue;
    border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #b30000;
}
</style>

