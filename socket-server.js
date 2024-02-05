// socket.js

const app = require('express')();
const http = require('http').Server(app);
const io = require('socket.io')(http);
const redis = require('redis');
const redisClient = redis.createClient();

// Subscribe to the 'my-channel' channel
redisClient.subscribe('notification-');

redisClient.on('message', (channel, message) => {
    if (channel === 'notification-') {
        // Broadcast the message to connected Socket.io clients
        io.emit('notification-', JSON.parse(message));
    }
});

io.on('connection', socket => {
    console.log('A user connected');
});

http.listen(3000, () => {
    console.log('Socket.io server listening on *:3000');
});
