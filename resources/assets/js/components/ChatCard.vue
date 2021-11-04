<template>
    <div :class=" 'popup-box chat-popup ' + (className)">
        <div class="popup-head">
            <div class="popup-head-left">
                <button @click="show = !show" class="individual_msg_toggler" type="button">{{ conversation.users[0].name
                    }}
                </button>
            </div>
            <div class="popup-head-right">
                <a @click="closeCard" href="javascript:void(0)">✕</a>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="popup-messages">
            <div class="individual_msg" v-show="show">
                <div @scroll="getScrollDirection" class="conv_here">

                    <div class="load-more-message" v-show="loadMoreBusy">
                        <center>loading...</center>
                    </div>

                    <div class="chat-messages">
                        <div :class="'media ' + (isCurrentUser(message) ? 'me_here' : '')"
                             v-for="message in conversation.messages">
                            <a class="pull-left sender_pic" href="#">
                                <img :src="isCurrentUser(message) ? user.profile_pic_url :
                                conversation.users[0].profile_pic_url" alt="Image" class="media-object img-circle"
                                     style="max-width:80px;">
                            </a>
                            <div class="is_online"
                                 v-show="!isCurrentUser(message) && conversation.users[0].is_online"></div>

                            <div class="media-body">
                                <h4 class="media-heading m-b-0">{{ isCurrentUser(message) ? 'Me' :
                                    conversation.users[0].name }}</h4>
                                <p class="black" v-html="message.body"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="typing_msg_here conversation_box p-b-0 p-t-7">
                    <div class="message_type_box">
                        <textarea @change="message.length > 5000? message.slice(0, -1): ''" @keypress.enter="sendMessage()"
                                  class="form-control" placeholder="Type in your message"
                                  rows="5"
                                  style="margin-bottom:10px;"
                                  v-model="message"></textarea>
                        <h6 class="pull-left" id="counter">{{ message.length }} / 5000</h6>
                        <div class="pull-right" id="pum_uploadinput">
                            <div class="form-group m-b-0" style="margin-top: -8px;margin-right: 5px;"><input
                                    :id="'file-'+ conversation.id" @change="uploadAttachment()" class="input-file"
                                    name="attachment" style="display: none;" type="file"><label
                                    @click="openSelectFileDialog()"
                                    class="btn btn-tertiary js-labelFile"
                                    for="file"
                                    style="width: auto;background: #fff;padding: 0;"><i
                                    class="fa fa-paperclip"></i></label>
                                <button @click="sendMessage()" class="btn btn-success sending_msg">Send</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        mounted() {
            this.scrollToEnd();
            console.log('Component CardChat mounted.');
        },
        created() {
            var card = this;
            window.app.$on('scroll-to-button', function (message) {
                if (message.conversation_id == card.conversation.id) {
                    if ((card.getScrollPosition() || card.isCurrentUser(message))) {
                        card.scrollToButton = true;
                        card.scrollToEnd();
                    }
                }
            });
        },
        data: function () {
            return {
                'message': '',
                'show': true,
                'loadMoreBusy': false,
                'noMoreMessages': false,
                'gotobutton': true,
                'scrollToButton': true,
                'previousScroll': 0
            }
        },
        watch: {
            conversation: {
                handler: function (val, oldVal) {
                    this.className = this.conversation.position;
                },
                deep: true
            }
        },
        computed: {
            loadMoreDisabled: function () {
                return this.loadMoreBusy || this.noMoreMessages;
            },
            newDisabled: function () {
                return this.loadMoreDisabled && !this.getScrollDirection();
            },
            className: function () {
                return this.conversation.position;
            }
        },
        methods: {
            sendMessage: function () {
                console.log('Message Sending');
                var localThis = this;
                var request = $.post('/user/store-message', {
                    'conversation_id': this.conversation.id,
                    'body': this.message,
                    'type': 'text'
                })
                    .done(function (conversation) {
                        localThis.message = '';
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
                return message.user_id == this.user.id;
            },
            scrollToEnd: function () {
                var container = this.$el.querySelector('.conv_here');
                var sleep = new Promise(function (resolve) {
                    setTimeout(resolve, 200);
                });
                var yoThis = this;
                sleep.then(function () {
                    container.scrollTop = container.scrollHeight;
                    yoThis.scrollToButton = false;
                });
            },
            getScrollPosition: function () {
                var container = this.$el.querySelector('.conv_here');
                return (container.scrollHeight - container.clientHeight - container.scrollTop) < 120;
            },
            getScrollDirection: function () {
                var container = this.$el.querySelector('.conv_here');
                var currentScroll = container.scrollTop;
                var distance = currentScroll - this.previousScroll;
                console.log('Height ->' + container.scrollHeight, 'Top ->' + container.scrollTop);

                if (currentScroll >= this.previousScroll) {
                    this.previousScroll = currentScroll;
                    return true;
                }

                if (!this.loadMoreBusy && distance < -10)
                    this.loadMore();

                this.previousScroll = currentScroll;
                return false;
            },
            loadMore: function () {
                var localThis = this;
                if (!this.noMoreMessages && !this.loadMoreBusy) {
                    this.loadMoreBusy = true;
                    var request = $.post('/user/conversation/load-more', {
                        'conversation_id': this.conversation.id,
                        'skip': this.conversation.messages.length
                    })
                        .done(function (messages) {
                            var container = localThis.$el.querySelector('.conv_here');
                            var currentScroll = [container.scrollHeight, container.scrollTop];
                            console.log(currentScroll);
                            for (var index in messages)
                                localThis.conversation.messages.push(messages[index]);

                            //sorting
                            localThis.conversation.messages.sort(function (a, b) {
                                return (a['id'] < b['id']) ? -1 : 1;
                            });

                            if (messages.length == 0)
                                localThis.noMoreMessages = true;

                            container = localThis.$el.querySelector('.conv_here');

                            var sleep = new Promise(function (resolve) {
                                setTimeout(resolve, 100);
                            });

                            sleep.then(function () {
                                var diff = container.scrollHeight - currentScroll[0] - currentScroll[1];
                                container.scrollTop = diff;
                                localThis.loadMoreBusy = false;
                            });
                        })
                        .fail(function () {
                            alert('Something went wrong!');
                        });
                }
            }
        },
        props: [
            'conversation',
            'user',
            'index'
        ]
    }
</script>
