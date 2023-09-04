<template>
    <div class="conversation">
        <div class="popup-messages " style="background-color: #0B0F32">




            <div class="direct-chat-messages" >





                <!-- /.direct-chat-msg -->
                <MessagesFeed :contact="user"   :messages="messages" />





                <!--                &lt;!&ndash; Message. Default to the left &ndash;&gt;-->
                <!--                <div class="direct-chat-msg doted-border">-->
                <!--                    <div class="direct-chat-info clearfix">-->
                <!--                        <span class="direct-chat-name pull-left">Osahan</span>-->
                <!--                    </div>-->
                <!--                    &lt;!&ndash; /.direct-chat-info &ndash;&gt;-->
                <!--                    <img alt="iamgurdeeposahan" src="http://bootsnipp.com/img/avatars/bcf1c0d13e5500875fdd5a7e8ad9752ee16e7462.jpg" class="direct-chat-img">&lt;!&ndash; /.direct-chat-img &ndash;&gt;-->
                <!--                    <div class="direct-chat-text">-->
                <!--                        Hey bro, how’s everything going ?-->
                <!--                    </div>-->
                <!--                    <div class="direct-chat-info clearfix">-->
                <!--                        <span class="direct-chat-timestamp pull-right">3.36 PM</span>-->
                <!--                    </div>-->
                <!--                    <div class="direct-chat-info clearfix">-->
                <!--                        <img alt="iamgurdeeposahan" src="http://bootsnipp.com/img/avatars/bcf1c0d13e5500875fdd5a7e8ad9752ee16e7462.jpg" class="direct-chat-img big-round">-->
                <!--                        <span class="direct-chat-reply-name">Singh</span>-->
                <!--                    </div>-->
                <!--                    &lt;!&ndash; /.direct-chat-text &ndash;&gt;-->
                <!--                </div>-->
                <!--                &lt;!&ndash; /.direct-chat-msg &ndash;&gt;-->






            </div>









        </div>
        <!--        <h1> {{selectedContact ? selectedContact.name :'Select a Contact' }} </h1>-->
        <!--        <MessagesFeed :contact="selectedContact" :messages="messages" />-->
        <!--        <MessageComposer v-on:send="sendMessage" />-->
    <MessageComposer v-on:send="sendMessage" />
    </div>

</template>

<script>
import axios from "axios";
import MessagesFeed from './MessagesFeed';
import MessageComposer from './MessageComposer';
export default {

    data:function(){
        return{
        }
    },

    props:{
        selectedContact:{
            type:Object,
            default:null
        },
        user:{
            type:Object,
            required:true
            },
        messages:{
            type:Array,
            required:true
            }
         },

        methods:{
            sendMessage(text){
                // if(!this.selectedContact){
                //     return;
                // }
                console.log(this.user.id);
                axios.post('/api/conversation/send', {
                    sender_id : this.user.id,
                    receiver_id :0,
                    text : text
                }).then( (response) => {
                    // console.log(response.data);
                    this.$emit('send', response.data)
                })
                .catch( error => {
                    console.log( error );
                })

            }
        },

    components:{ MessagesFeed, MessageComposer }
}
</script>

<style lang="scss" scoped>
.conversation{
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    h1 {
        font-size: 20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgray;
    }
}
</style>
