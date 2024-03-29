import _ from "lodash";
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

// Ably

//import→あるモジュールでエクスポートされた、関数やオブジェクト、プリミティブ値を別モジュール内にインポートするために使う文法
//import {モジュール名} from "インポート元"

// import Echo from "laravel-echo";
// import Pusher from "pusher-js";

// //window→画面上に表示されているすべてのオブジェクトの親となるオブジェクトで、JavaScriptのオブジェクト階層の最上位に位置する
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: import.meta.env.VITE_ABLY_PUBLIC_KEY,
//     wsHost: "realtime-pusher.ably.io",
//     wsPort: 443,
//     disableStats: true,
//     encrypted: true,
// });

// window.Echo.channel("chat-added-channel").listen("ChatAdded", function (data) {
//     console.log("received a message");
//     console.log(data);
// });

import Echo from "laravel-echo";
import Pusher from "pusher-js"; //追加

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "7704a90aa1acf69d96d8",
    cluster: "ap3",
    forceTLS: true,
});

var channel = window.Echo.channel("chat-added-channel"); //チャンネル名変更
channel.listen("ChatAdded", function (data) {
    //イベント名変更
    console.log("received");
    console.log(data);
});
