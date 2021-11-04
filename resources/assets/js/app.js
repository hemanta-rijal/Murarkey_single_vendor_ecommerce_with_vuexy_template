/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require('vue');
window.io = require('socket.io-client');
VueTimeago = require('vue-timeago');
var infiniteScroll = require('vue-infinite-scroll');
Vue.use(infiniteScroll);
window.mobileCheck = function () {
    var check = false;
    (function (a) {
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true;
    })(navigator.userAgent || navigator.vendor || window.opera);
    return check;
};

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

Vue.use(VueTimeago, {
    locale: 'en-US',
    locales: {
        // you will need json-loader in webpack 1
        'en-US': require('vue-timeago/locales/en-US.json')
    }
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

var ChatApp = require('./components/ChatApp.vue');

window.app = new Vue({
    el: '#app',
    components: {ChatApp},
    data: function () {
        return {
            chatAppData: {'conversations': [], 'users': []}
        };
    },
    methods: {
        createConversation: function (userId) {
            this.$children[0].createConversation(userId);
        },
        setUserOnline: function () {
            setUserOnline(this.chatAppData.user.id);
        },
        listenSocketEvent: function () {
            socketEventListener();
        },
        findConversationById: function (id) {
            for (var index in app.chatAppData.conversations) {
                if (app.chatAppData.conversations[index].id == id)
                    return app.chatAppData.conversations[index];
            }

            return null;
        },
        broadcastNewConversationCreated: function (conversation) {
            broadcastNewConversationCreated(conversation);
        }
    }
})
;


var socket = io($('meta[name="socket-io-host"]').attr('content'));

function setUserOnline(user_id) {
    socket.emit('user', {user_id: user_id});
}

function socketEventListener() {

    var conversations = app.chatAppData.conversations;

    for (var index in conversations) {
        socket.on('conversation.' + conversations[index].id, function (data) {
            var conversation = app.findConversationById(data.message.conversation_id);

            console.log(conversation);

            conversation.updated_at = data.message.updated_at;
            var old_message = contains(conversation.messages, data.message);

            if (old_message) {
                old_message.body = data.message.body;
            } else {
                conversation.hide_on_chat_list = false;
                conversation.messages.push(data.message);
                conversation.last_message = data.message.body;
                conversation.updated_at = data.message.updated_at;

                console.log(app);
                app.$emit('scroll-to-button', data.message);
                if (app.chatAppData.user.id !== data.message.user_id) {
                    document.getElementById('message-notification').play();
                    conversation.isRead = false;
                }
            }

            conversations.sort(function (a, b) {
                var date1 = new Date(a.updated_at);
                var date2 = new Date(b.updated_at);

                return (date1 > date2) ? -1 : 1;
            });
        });


        socket.on('user.' + conversations[index].users[0].id + '.online', function (data) {
            console.log('someone is online', data);
            var conversation = findConversationByUserId(data.user_id, conversations);
            if (conversation)
                conversation.users[0].is_online = data.status;

        });
    }

    console.log('user.' + app.chatAppData.user.id + '.newconversation');


    socket.emit('get-online-status', {users: app.chatAppData.users});
}


socket.on('user.new-conversation', function (data) {
    console.log('someone just created a conversation');
    createConversation(data.next_user_id, true);
});

socket.on('test', function (data) {
    console.log(data);
});

socket.on('welcome', function (data) {
    console.log(data.message);
});


function broadcastNewConversationCreated(conversation) {
    console.log(conversation.users[0].id);

    socket.emit('conversation-created',
        {
            conversation_id: conversation.id,
            user_id: conversation.users[0].id,
            next_user_id: app.chatAppData.user.id
        }
    );
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

function findConversationByUserId(user_id, a) {
    var i = a.length;
    while (i--) {
        if (a[i].users[0].id === user_id) {

            return a[i];
        }
    }

    return false;
}



