var app = require('http').createServer(handler),
    io = require('socket.io')(app),
    redis = require('redis'),
    fs = require('fs'),
    low = require('lowdb'),
    redisClient = redis.createClient();

app.listen(6001);

const db = low('users.json');

db.unset('users')
    .write();

db.defaults({users: []})
    .write();


console.log('Realtime Chat Server running at http://127.0.0.1:6001/');

function handler(req, res) {
    fs.readFile(__dirname + '/index.html', function (err, data) {
        if (err) {
            res.writeHead(500);
            return res.end('Error loading index.html');
        }
        res.writeHead(200);
        res.end(data);
    });
}

/***
 Redis Channels Subscribes
 ***/

redisClient.psubscribe("conversation.*");

/***
 Redis Events
 ***/
redisClient.on('pmessage', function (channel_pattern, channel, message) {
    message = JSON.parse(message);
    console.log(channel, message);

    io.emit(channel, message.data);
});

/***
 Socket.io Connection Event
 ***/

io.on('connection', function (socket) {

    console.log('Someone is online over here');
    socket.emit('welcome', {message: 'Welcome! Realtime Chat Server running at http://127.0.0.1:3000/'});

    /***
     Socket.io Events
     ***/

    socket.on('user', function (data) {
        var user = db.get('users')
            .find({'id': data.user_id})
            .value();

        if (typeof user !== 'undefined')
            db.get('users')
                .find({'id': data.user_id})
                .assign({socket_id: socket.id})
                .write();
        else
            db.get('users')
                .push({'id': data.user_id, 'socket_id': socket.id, 'is_online': true})
                .write();

        io.emit('user.' + data.user_id + '.online', {status: true, user_id: data.user_id});

    });

    socket.on('disconnect', function () {
        var user = db.get('users')
            .remove({socket_id: socket.id})
            .write();

        console.log('Someone have gone offline', user);

        if (typeof user[0] !== 'undefined') {
            io.emit('user.' + user.id + '.online', {status: false, user_id: user[0].id});
        }

    });

    socket.on('get-online-status', function (data) {
        data.users.forEach(function (user) {
            if (db.get('users').find({user_id: user.id}).size().value() > 0)
                io.emit('user.' + user.id + '.online', {status: true, user_id: user.id});
        });
    });

    socket.on('conversation-created', function (data) {
        console.log('conversation-created');

        var user = db.get('users')
            .find({id: data.user_id})
            .value();

        if (typeof user !== 'undefined')
            socket.to(user.socket_id).emit('user.new-conversation', data);

        // io.emit('user.' + data.user_id + '.new-conversation', data);

    });

    db.get('users').value().forEach(function (user) {
        io.emit('user.' + user.id + '.online', {status: true, user_id: user.id});
    })

});
