import ReactDOM from "react-dom/client";
import { useState, useEffect } from "react";
import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import Echo from "laravel-echo";
import Pusher from "pusher-js"; //追加

export default function Index() {
    // Data
    const element = document.getElementById("index");
    const props = JSON.parse(element.dataset.props); // data-propsの内容を取得
    const [chatMessages, setChatMessages] = useState([]);
    const [chatMessage, setChatMessage] = useState("");

    console.log(chatMessages);

    // Methods
    const handleMessageChange = (e) => {
        // メッセージ入力したとき

        const message = e.target.value;
        setChatMessage(message);
    };
    const handlerSubmit = () => {
        // 送信したとき

        const url = route("chat.store");
        const data = { message: chatMessage };

        Inertia.post(url, data, {
            onSuccess() {
                setChatMessage(""); // 成功したらメッセージをリセット
            },
        });
    };
    const getChatMessages = () => {
        // チャットメッセージを取得する
        // axios.get(route("student.chat.show", props.data)).then((response) => {
        //     const chatMessages = response.data;
        //     setChatMessages(chatMessages);
        // });
    };

    // Effects
    useEffect(() => {
        // ページを読み込んだ時

        getChatMessages();

        window.Echo = new Echo({
            broadcaster: "pusher",
            key: "7704a90aa1acf69d96d8",
            cluster: "ap3",
            forceTLS: true,
        });

        var channel = window.Echo.channel("chat-added-channel"); //チャンネル名変更
        channel.listen("ChatAdded", function (data) {
            //イベント名変更
            // console.log(data.chat.content);
            setChatMessages([...chatMessages, data.chat.content]);
            console.log("テスト:" + chatMessages);
        });
    }, []);

    return (
        <div className="p-5">
            <h1 className="mb-2 font-bold">
                Laravel + React + Pusher でチャット機能
            </h1>

            {/* メッセージ部分 */}
            <div className="p-4 bg-gray-100">
                {chatMessages.length > 0 &&
                    Object.values(chatMessages).map((chatMessage, index) => (
                        <div
                            key={index}
                            className="bg-white border mb-2 p-3 rounded"
                        >
                            <div className="whitespace-pre mt-2">
                                {chatMessage.message}
                            </div>
                            チャットメッセージ={chatMessage}
                        </div>
                    ))}
                {chatMessages.length === 0 && (
                    <div className="text-center">
                        <div className="text-gray-500">
                            まだメッセージはありません
                        </div>
                    </div>
                )}
            </div>

            {/* フォーム部分 */}
            {/* <div className="py-3">
                <small>&#x1F4AC; チャットへ投稿</small>
                <textarea
                    rows="4"
                    className="block p-2.5 w-full text-sm text-gray-900 border border-gray-400 rounded mb-3"
                    value={chatMessage}
                    onChange={(e) => handleMessageChange(e)}
                    autoFocus
                />
                <button
                    type="button"
                    className="px-4 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg"
                    onClick={handlerSubmit}
                >
                    送信する
                </button>
            </div> */}
        </div>
    );
}

const root = ReactDOM.createRoot(document.getElementById("index"));
root.render(<Index />);
