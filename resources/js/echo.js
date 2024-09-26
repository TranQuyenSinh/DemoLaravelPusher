import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

// window.Echo.channel(`my-channel`).listen(".my-event", (e) => {
//     console.log(e);
// });

window.Echo.connector.pusher.connection.bind("connected", function () {
    console.log("Pusher connected");
});
