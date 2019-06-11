<template>
    <div class="conversation">
        <h1>{{contact? contact.name : 'Un-Known Person'}}</h1>
        <MessagesFeed :contact="contact" :messages="messages"/>
        <MessageComposer @send="sendMessage"/>
    </div>
</template>


<script>
import MessagesFeed from "./MessagesFeed";
import MessageComposer from "./MessageComposer";
export default {
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
            // console.log(text);
            if (!this.contact) {
                return;
            }
            axios
                .post("/conversation/send", {
                    contact_id: this.contact.id,
                    text: text
                })
                .then(response => {
                    this.$emit("new", response.data);
                });
        }
    },
    components: { MessagesFeed, MessageComposer }
};
</script>

<style lang="scss" scoped>
.conversation {
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    h1 {
        color: blue;
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
        margin: 0;
        border-bottom: 2px dashed lightgray;
    }
}
</style>

