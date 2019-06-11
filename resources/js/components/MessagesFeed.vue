<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li
                v-for="message in messages"
                :class="`message ${message.to == contact.id ? 'sent': 'received'}`"
                :key="message.id"
            >
                <div class="text">
                    {{message.message}}
                    <br>
                    <span style="font-size:10px">{{ message.created_at}}</span>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import { setTimeout } from "timers";
export default {
    props: {
        contact: {
            type: Object
        },
        messages: {
            type: Array,
            required: true
        }
    },
    methods: {
        scrollToBottom() {
            setTimeout(() => {
                this.$refs.feed.scrollTop =
                    this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
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
};
</script>

<style lang="scss" scoped>
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

.feed {
    background: lightgray;
    height: 100%;
    max-height: 470px;
    overflow-y: scroll;

    ul {
        list-style-type: none;
        padding: 5px;

        li {
            &.message {
                margin: 10px 0;
                width: 100%;

                .text {
                    max-width: 300px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }

                &.received {
                    text-align: left;

                    .text {
                        background: linear-gradient(
                            to left,
                            #66ffcc 0%,
                            #ff00ff 100%
                        );
                    }
                }
                &.sent {
                    text-align: right;

                    .text {
                        background: linear-gradient(
                            to right,
                            #6666ff 11%,
                            #00ff99 100%
                        );
                    }
                }
            }
        }
    }
}
</style>

