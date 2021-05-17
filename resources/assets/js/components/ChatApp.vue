<script>
    var ChatCard = require('./ChatCard.vue');
    var ChatList = require('./ChatList.vue');

    export default {
        components: {ChatList, ChatCard},

        created () {
            $.post('/user/chat-data')
                    .done(function (data) {
                        app.chatAppData = data;
                        app.setUserOnline();
                        app.listenSocketEvent();
                    })
                    .fail(function () {
                        // alert('Something went wrong!');
                    });
        },

        props: {
            chat_data: {
                required: true
            }
        },

        methods: {
            openChatCardListener: function (conversation) {

                if (!conversation.show) {
                    var count = 0;
                    var position = '';

                    for (var index in this.chat_data.conversations) {
                        if (this.chat_data.conversations[index].show) {
                            count++;
                            if (count > 1) {
                                position = this.chat_data.conversations[index].position;
                                this.chat_data.conversations[index].show = false;
                            }
                        }
                    }


                    if (count == 0)
                        conversation.position = 'center-chat-card';
                    else if (count == 1)
                        conversation.position = 'left-chat-card';
                    else
                        conversation.position = position;

                    conversation.show = true;

                    this.markAsReadListener(conversation);
                }

            },
            markAsReadListener: function (conversation) {
                var app = this;
                var request = $.post('/user/conversation/mark-as-read', {'conversation_id': conversation.id})
                        .done(function (data) {
                            conversation.isRead = true;
                        })
                        .fail(function () {
                            alert('Something went wrong!');
                        });
            },
            closeCardListener: function (conversation) {
                conversation.show = false;
                if (conversation.position == 'center-chat-card')
                    for (var index in this.chat_data.conversations)
                        if (this.chat_data.conversations[index].show && this.chat_data.conversations[index].position == 'left-chat-card')
                            this.chat_data.conversations[index].position = 'center-chat-card';
            },
            createConversation: function (userId, dontOpenCard) {
                dontOpenCard = typeof dontOpenCard !== 'undefined' ? dontOpenCard : false;
                var localTHis = this;
                var request = $.post('/user/create-conversation', {'user_id': userId})
                        .done(function (conversation) {
                            if (app.findConversationById(conversation.id))
                                conversation = app.findConversationById(conversation.id);
                            else {
                                app.chatAppData.conversations.unshift(conversation);
                                app.chatAppData.users.push(conversation.users[0]);

                                if (conversation.recently_created) {
                                    app.broadcastNewConversationCreated(conversation);
                                }

                                app.listenSocketEvent();
                            }

                            if (!dontOpenCard)
                                localTHis.openChatCardListener(conversation);

                            if (window.mobileCheck())
                                window.location = '/user/message-center/conversation/' + conversation.id;
                        })
                        .fail(function () {
                            alert('Something went wrong!');
                        });
            },
            hideConversationListener: function (conversation) {
                $.post('/user/conversation/hide', {conversation_id: conversation.id})
                        .done(function (data) {
                            conversation.hide_on_chat_list = true;
                        })
                        .fail(function (err) {
                            alert('Something went wrong!');
                        });
            }
        }
    }
</script>

<template>
    <div class="chat-app">
        <chat-card v-for="conversation in chat_data.conversations" v-if="conversation.show"
                   :conversation="conversation" :user="chat_data.user"
                   @close-card="closeCardListener"></chat-card>
        <chat-list :chatAppData="chat_data" @open-chat-card="openChatCardListener"
                   @mark-as-read="markAsReadListener" @hide-conversation="hideConversationListener"></chat-list>
    </div>
</template>