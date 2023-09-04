<template>

        <!-- Message. Default to the left -->
        <div class="direct-chat-msg " >
            <div v-for="(message, index) in messages" :key="index.id" >


            <div class="direct-chat-info clearfix" >
                <span class="direct-chat-name " :class="`${message.to == 0 ? ' pull-right ': ' pull-left' }`" >{{message.to == 0 ?  contact.name:" Admin"}}</span>
            </div>
            <!-- /.direct-chat-info -->
            <div class="direct-chat-text ">
                {{message.text}}
            </div>
            </div>
<!--            <div class="direct-chat-info clearfix" v-else class="withOutLoadingConversation">- -->
<!--                <span class="direct-chat-name">Please select a contact first.</span>-->
<!--            </div>-->

            <!-- /.direct-chat-text -->
        </div>
<!--        <ul class="ul-element" v-if="contact">-->
<!--            <li v-for="(message, index) in messages" :key="index.id" :class="`message${message.to == contact.id ? ' sent ': ' received ' }`" >-->
<!--                <div class="text">-->
<!--                    {{ message.text }}-->
<!--                </div>-->
<!--            </li>-->
<!--        </ul>-->

<!--        <ul v-else class="withOutLoadingConversation">-->
<!--            <p style="font-size:18px">Please select a contact first.</p>-->
<!--        </ul>-->


</template>

<script>
export default {
    props:{
        contact:{
            type:Object,
        },
        messages:{
            // type:Object,
            // required:true
        }
    },
    methods:{
        scrollToBottom(){
            setTimeout(() => {
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            },50)
        }
    },
    watch:{
        contact(contact){
            this.scrollToBottom();
        },
        messages(messages){
            this.scrollToBottom();
        }
    }
}
</script>

<style lang="scss" scoped>
.ul-element{
    margin-top: -124px;
}
.feed {
    background: #f0f0f0;
    padding-top: 120px;
    height: 100%;
    max-height: 370px;
    overflow-y: auto;

    ul {
        list-style-type: none;
        padding: 5px;

        li {
            &.message {
                margin: 10px 0;
                width: 100%;

                .text {
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }

                &.received {
                    text-align: right;
                    .text {
                        background: #b2b2b2;
                    }
                }
                &.sent {
                    // padding-top: -50px;
                    text-align: left;

                    .text {
                        background: #81c4f9;
                    }
                }
            }
        }

    }

}
.withOutLoadingConversation {
    height: 90%;
    margin-top: 190px;
    p {
        margin-top: -160px;
        text-align: center;
    }
}
</style>
