<template>
    <div class="chat-sidebar p-0">
        <button @click="show = !show" class="msg_trigger_btn" type="button">Message center ({{ unread_count }} Unread)
        </button>
        <a class="color_inherit" href="/user/message-center"><p class="text-center message_center_link m-0"
                                                                style="display: none;">go to
            message center
            page</p></a>

        <div class="message_list" v-show="show">
            <div class="sidebar-name" v-for="conversation in chatAppData.conversations"
                 v-if="!conversation.hide_on_chat_list">
                <!-- Pass username and display name to register popup -->
                <div :class="'media '+ (conversation.isRead ?'white_one' : 'unread_one')">
                    <a @click="openChatCard(conversation)" class="pull-left sender_pic" href="javascript:void(0)">
                        <img :src="conversation.users[0].profile_pic_url" alt="Image" class="media-object img-circle"
                             style="max-width:80px;">
                        <div class="is_online" v-show="conversation.users[0].is_online"></div>
                    </a>
                    <a @click="openChatCard(conversation)" href="javascript:void(0)">
                        <div class="media-body">
                            <h4 class="media-heading m-b-0">{{ conversation.users[0].name }}
                            </h4>
                            <p @click.stop="openChatCard(conversation)" class="black"
                               v-html="lastMessage(conversation.last_message)"></p>
                            <p class="time_one">
                                <timeago :since="conversation.updated_at"></timeago>
                            </p>
                        </div>
                    </a>
                    <a @click="markAsRead(conversation)" class="p_tooltip" data-toggle="tooltip"
                       href="javascript:void(0)"
                       title="Mark as read" v-show="!conversation.isRead"><i
                            class="fa fa-envelope"></i></a>

                    <a @click="hideConversation(conversation)" class="p_tooltip" data-toggle="tooltip"
                       href="javascript:void(0)"
                       title="Hide a conversation"><i
                            class="fa fa-close"></i></a>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        mounted() {
            console.log('Component ChatList mounted.')
        },
        created() {
            //Ajax call to get user
        },
        data: function () {
            return {'show': false}
        },
        computed: {
            unread_count: function () {
                var counter = 0;
                this.chatAppData.conversations.forEach(function (conversation) {
                    if (!conversation.isRead)
                        counter++;
                });

                return counter;
            }
        },
        methods: {
            markAsRead: function (conversation) {
                console.log(conversation);

                this.$emit('mark-as-read', conversation);
            },
            lastMessage: function (last_message) {
                var message = last_message.replace('<a ', '<a style="pointer-events: none; cursor: default" ');
                if (/<[a-z][\s\S]*>/i.test(message))
                    return message;
                else {
                    if (message.length > 50)
                        return message.slice(0, 47) + '...';
                    else
                        return message;
                }

            },
            openChatCard: function (conversation) {
                console.log(conversation);

                this.$emit('open-chat-card', conversation);
            },
            hideConversation: function (conversation) {
                console.log('fuck');
                this.$emit('hide-conversation', conversation);
            }
        },
        props: ['chatAppData']
    }
</script>
