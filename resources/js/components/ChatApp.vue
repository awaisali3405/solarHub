
<template>
    <div class="chat-app">
        <div class="popup-box chat-popup" id="qnimate">
            <div class="popup-head">
                <div class="popup-head-left pull-left">Admin</div>
                <div class="popup-head-right pull-right">


                    <button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"><i class="glyphicon glyphicon-off"></i></button>
                </div>
            </div>
            <conversation :user="user" :messages="messages"  v-on:send="saveNewMessage" />

        </div>
<!--        <div class="col-md-3">-->
<!--            <contact-list :contacts="contacts" v-on:selected="startConversationWith" />-->
<!--        </div>-->

<!--       <div class="col-md-9">-->
<!--            <conversation :user="user" :messages="messages" :selectedContact="selectedContact" v-on:send="saveNewMessage" />-->
<!--       </div>-->

<!--         :contact="selectedContact" -->

    </div>
</template>

<script>
    import Echo from "laravel-echo";
    import axios from "axios";
    import Conversation from './Conversation';
    import ContactList from './ContactList';

    export default {
        components:{
            ContactList,Conversation
        },

         data: function(){
            return{
                messages:[],
                contacts:[],
                selectedContact:null,
            }
         }
        ,
        props:{

            user:{
                type:Object,
                required:true
            }
        },

        mounted(){

            console.log("good");
            window.Echo.channel(`messages.${this.user.id}`)
            .listen('NewMessage', (e) => {
                this.handleIncoming(e.message)
            });

            // axios.get('/api/contact-list/'+ this.user.id)
            // .then( response => {
            //     this.contacts = response.data;
            // })
            // .catch( error => {
            //     console.log( error );
            // })
            this.updateUnreadCount( 0,true);
            axios.get('/api/conversation/' + 0 + '/' + this.user.id )
                .then( response => {
                    console.log(response);
                    this.messages = response.data;
                    // this.selectedContact = contact;
                })
                .catch( error => {

                    console.log( error );
                })
        },
        methods:{
            startConversationWith() {

                console.log('asdda');

            },
            saveNewMessage(msg){
                this.messages.push(msg);
            },
            handleIncoming(message){

                if( this.selectedContact && message.from == this.selectedContact.id ){
                    this.saveNewMessage(message);
                    return;
                }
                this.updateUnreadCount(message.from_contact, false);
            },
            updateUnreadCount(contact, reset){
                this.contacts == this.contacts.map((single) => {
                    if(single.id != contact.id){
                        return single;
                    }
                    if(reset){
                        single.unread = 0;
                    }
                    else{
                        single.unread += 1;
                        }
                    return single;

                })
            }
        }


    }
</script>

<style lang="scss" scoped>
.chat-app{
    display: flex;
}
</style>
