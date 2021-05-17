<template>
    <div class="chat-sidebar p-0">
        <button type="button" class="msg_trigger_btn" @click="show = !show">Message center ({{ unread_count }} Unread)
        </button>
        <a href="/user/message-center" class="color_inherit"><p class="text-center message_center_link m-0"
                                                                style="display: none;">go to
            message center
            page</p></a>

        <div class="message_list" v-show="show">
            <div class="sidebar-name" v-for="conversation in chatAppData.conversations"
                 v-if="!conversation.hide_on_chat_list">
                <!-- Pass username and display name to register popup -->
                <div :class="'media '+ (conversation.isRead ?'white_one' : 'unread_one')">
                    <a class="pull-left sender_pic" href="javascript:void(0)" @click="openChatCard(conversation)">
                        <img class="media-object img-circle" :src="conversation.users[0].profile_pic_url" alt="Image"
                             style="max-width:80px;">
                        <div class="is_online" v-show="conversation.users[0].is_online"></div>
                    </a>
                    <a href="javascript:void(0)" @click="openChatCard(conversation)">
                        <div class="media-body">
                            <h4 class="media-heading m-b-0">{{ conversation.users[0].name }}
                            </h4>
                            <p class="black" v-html="lastMessage(conversation.last_message)"
                               @click.stop="openChatCard(conversation)"></p>
                            <p class="time_one">
                                <timeago :since="conversation.updated_at"></timeago>
                            </p>
                        </div>
                    </a>
                    <a href="javascript:void(0)" @click="markAsRead(conversation)" class="p_tooltip"
                       data-toggle="tooltip"
                       title="Mark as read" v-show="!conversation.isRead"><i
                            class="fa fa-envelope"></i></a>

                    <a href="javascript:void(0)" @click="hideConversation(conversation)" class="p_tooltip"
                       data-toggle="tooltip"
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
