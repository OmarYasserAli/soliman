import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
});

window.Echo.channel('chat')
    .listen('ChatMessageSent', (event) => {
        console.log(event.message);
        // Update your UI with the received message
    });
