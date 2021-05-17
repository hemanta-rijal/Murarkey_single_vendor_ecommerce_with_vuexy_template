window.Vue = require('vue');
window.io = require('socket.io-client');
var socket = io($('meta[name="socket-io-host"]').attr('content'));
var infiniteScroll = require('vue-infinite-scroll');
Vue.use(infiniteScroll);

$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
window.app = new Vue({
    el: '#app',
    data: function () {
        return {
            conversation: conversation,
            user_id: user_id,
            message: '',
            loadMoreBusy: false,
            noMoreMessages: false,
            profile_pic_url: profile_pic_url,
            scrollToButton: true
        };
    }, computed: {
        loadMoreDisabled: function () {
            return this.loadMoreBusy || this.noMoreMessages;
        },
        orderedMessages: function () {
            return this.conversation.messages.sort(function (a, b) {
                return (a['id'] < b['id']) ? -1 : 1;
            });
        }
    },
    mounted() {
        this.scrollToEnd();
        console.log('Component Conversation mounted.');
    },
    methods: {
        deleteMessage: function (message) {
            var request = $.post('/user/conversation/delete-message', {
                'conversation_id': this.conversation.id,
                'message_id': message.id
            })
                .done(function (conversation) {
                    console.log('Done');
                })
                .fail(function () {
                    alert('You can\'t delete message after 2 hr!');
                });
        },
        sendMessage: function () {
            console.log('Message Sending');
            var localThis = this;
            var request = $.post('/user/store-message', {
                'conversation_id': this.conversation.id,
                'body': this.message,
                'type': 'text'
            })
                .done(function (conversation) {
                    console.log('Done');
                    localThis.message = '';

                    localThis.scrollToButton = true;
                    var sleep = new Promise(resolve => setTimeout(resolve, 200));
                    sleep.then(function () {
                        localThis.scrollToEnd();
                    });
                })
                .fail(function () {
                    alert('Something went wrong!');
                });
        },
        closeCard: function () {
            this.$emit('close-card', this.conversation);
        },
        uploadAttachment: function () {
            console.log('Wait and watch');
        },
        openSelectFileDialog: function () {
            $('#file-' + this.conversation.id).trigger('click');
            initUploadAttachment(this.conversation.id);
        },
        isCurrentUser: function (message) {
            return message.user_id == this.user_id;
        },

        scrollToEnd: function () {
            var container = this.$el.querySelector('.conversation_box');
            container.scrollTop = container.scrollHeight;
            var sleep = new Promise(resolve => setTimeout(resolve, 200));

            var localThis = this;
            sleep.then(function () {
                localThis.scrollToButton = false;
            });
        },
        loadMore: function () {
            var localThis = this;

            if (!this.scrollToButton) {
                this.loadMoreBusy = true;
                var request = $.post('/user/conversation/load-more', {
                    'conversation_id': this.conversation.id,
                    'skip': this.conversation.messages.length
                })
                    .done(function (messages) {

                        for (var index in messages)
                            localThis.conversation.messages.push(messages[index]);

                        if (messages.length == 0)
                            localThis.noMoreMessages = true;

                        localThis.loadMoreBusy = false;
                    })
                    .fail(function () {
                        alert('Something went wrong!');
                    });
            }


        }
    },
    created() {
        setUserOnline(this.user_id);
        socketEventListener();
    }
});


function setUserOnline(user_id) {
    socket.emit('user', {user_id: user_id});
}


function socketEventListener() {

    console.log(conversation);
    socket.on('conversation.' + conversation.id, function (data) {
        console.log(conversation);
        var old_message = contains(conversation.messages, data.message);

        if (old_message)
            old_message.body = data.message.body;
        else {
            if (app.user_id !== data.message.user_id)
                document.getElementById('message-notification').play();

            conversation.messages.push(data.message);
        }


        conversation.isRead = false;
    });

    socket.on('user.' + conversation.users[0].id + '.online', function (status) {
        console.log('someone is online');
        conversation.users[0].is_online = status;
    });

    socket.emit('get-online-status', {users: conversation.users});
}


function contains(a, obj) {
    var i = a.length;
    while (i--) {
        if (a[i].id === obj.id) {


            return a[i];
        }
    }
    return false;
}

