import {useState, useEffect} from "react";
import {Inertia} from "@inertiajs/inertia";
import ChatMessageHeader from "@/Components/ChatMessageHeader";
import ChatMessageFooter from "@/Components/ChatMessageFooter";

export default function Index(props) {

    // Data
    const userName = props.auth.user.name;
    const [chatMessages, setChatMessages] = useState([]);
    const [chatMessage, setChatMessage] = useState('');

    // Methods
    const handleMessageChange = e => { // メッセージ入力したとき

        const message = e.target.value;
        setChatMessage(message);

    };
    const handlerSubmit = () => { // 送信したとき

        const url = route('chat.store');
        const data = { message: chatMessage };

        Inertia.post(url, data, {
            onSuccess() {

                setChatMessage(''); // 成功したらメッセージをリセット

            }
        });

    };
    const getChatMessages = () => { // チャットメッセージを取得する

        axios.get(route('chat.list'))
            .then(response => {

                const chatMessages = response.data;
                setChatMessages(chatMessages);

            });

    };

    // Effects
    useEffect(() => { // ページを読み込んだ時

        getChatMessages();

        // ブロードキャスト受信
        Echo.private('chat-message')
            .listen('ChatMessageCreated', e => {

                console.log(e);
                getChatMessages(); // ブロードキャスト通知が来たら再読込みする

            });

    }, []);

    return (
        <div className="p-5">
            <h1 className="mb-2 font-bold">
                Laravel + React + Ably でチャット機能
            </h1>

            <div className="p-1">
                <small>
                    <strong>{userName}</strong> さんでログイン中
                </small>
            </div>

            {/* メッセージ部分 */}
            <div className="p-4 bg-gray-100">
                {chatMessages.length > 0 && chatMessages.map(chatMessage => (
                    <div key={chatMessage.id} className="bg-white border mb-2 p-3 rounded">
                        <ChatMessageHeader name={chatMessage.user.name} />
                        <div className="whitespace-pre mt-2">{chatMessage.message}</div>
                        <ChatMessageFooter chatMessage={chatMessage}></ChatMessageFooter>
                    </div>
                ))}
                {chatMessages.length === 0 && (
                    <div className="text-center">
                        <div className="text-gray-500">まだメッセージはありません</div>
                    </div>
                )}
            </div>

            {/* フォーム部分 */}
            <div className="py-3">
                <small>&#x1F4AC; チャットへ投稿</small>
                <textarea
                    rows="4"
                    className="block p-2.5 w-full text-sm text-gray-900 border border-gray-400 rounded mb-3"
                    value={chatMessage}
                    onChange={e => handleMessageChange(e)} autoFocus />
                <button
                    type="button"
                    className="px-4 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg"
                    onClick={handlerSubmit}>送信する</button>
            </div>
        </div>
    );
}