<template>
    <div class="composer flex row">
        <!-- <textarea
            autofocus
            v-model="message"
            @keydown.enter="send"
            placeholder="Type your message..."
        ></textarea>-->
        <textarea autofocus v-model="message" placeholder="Type your message..."></textarea>
        <button class="send-button" @click.prevent="send">
            <i class="fa fa-paper-plane"></i>
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: ""
        };
    },
    methods: {
        send(e) {
            e.preventDefault();
            if (this.message == "") {
                return;
            }
            this.$emit("send", this.message);
            this.message = "";
        }
    }
};
</script>

<style lang="scss" scoped>
.composer {
    display: flex;
    justify-content: center;
    textarea {
        width: 86%;
        margin: 10px;
        resize: none;
        border-radius: 10px;
        border: 1px solid lightgray;
        padding: 6px;
    }
    .send-button {
        border: 0;
        background: none;
        i {
            color: blue;
            font-size: 28px;
        }
    }
}
</style>

