import ReactDOM from "react-dom/client";
import { useState, useEffect } from "react";
import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import Echo from "laravel-echo";
import Pusher from "pusher-js"; //追加
import { VStack, Heading, HStack, Button } from "@chakra-ui/react";
import { useNavigate } from "react-router-dom";

// export default function Index() {
const Chat = () => {
    // Data
    const element = document.getElementById("index");
    const props = JSON.parse(element.dataset.props); // data-propsの内容を取得
    const [chatMessages, setChatMessages] = useState([]);
    const [chatMessage, setChatMessage] = useState("");
    const [studentName, setStudentName] = useState("");
    const [teacherName, setTeacherName] = useState("");
    // const navigate = useNavigate();

    // Methods
    const handleMessageChange = (e) => {
        // メッセージ入力したとき

        const message = e.target.value;
        setChatMessage(message);
    };
    const handlerSubmit = () => {
        // 送信したとき

        const url = route("student.realtime_chat.store");
        const data = {
            content: chatMessage,
            chat_room_id: props.chat_room.id,
            is_student: props.is_student,
        };

        Inertia.post(url, data, {
            onSuccess() {
                setChatMessage(""); // 成功したらメッセージをリセット
            },
        });
    };
    const getChatMessages = () => {
        // チャットメッセージを取得する
        // axios.get(route("student.chat.list")).then((response) => {
        //     console.log("データ" + response);
        //     const chatMessages = response.data;
        //     setChatMessages(chatMessages);
        // });
        const getMessage = async () => {
            const response = await axios.get(
                //現在のchat_roomのidを元に、メッセージデータを取得
                route("student.realtime_chat.list", props.chat_room.id)
            );
            // console.log("axiosデータ" + typeof response.data);
            const chatMessages = response.data[0];
            const studentName = response.data[1];
            const teacherName = response.data[2];
            setChatMessages(chatMessages);
            setStudentName(studentName);
            setTeacherName(teacherName);
            // console.log("axios:" + JSON.stringify(chatMessages));
        };
        getMessage();
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
            // setChatMessages([...chatMessages, data.chat.content]);
            // console.log("テスト:" + data.chat.content);

            getChatMessages(); // ブロードキャスト通知が来たら再読込みする
        });
    }, []);

    return (
        <div className="p-5">
            {console.log(props.is_student)}
            {props.is_student ? (
                <h1 className="mb-2 font-bold">
                    {teacherName}先生へのメッセージ
                </h1>
            ) : (
                <h1 className="mb-2 font-bold">{studentName}へのメッセージ</h1>
            )}

            {/* メッセージ部分 */}
            <div className="p-4 bg-gray-100">
                {console.log(chatMessages.length + ":" + chatMessages.content)}
                {chatMessages.length > 0 &&
                    chatMessages.map((chatMessage, index) => (
                        <div
                            key={index}
                            className="bg-white border mb-2 p-3 rounded"
                        >
                            {chatMessage.is_student ? (
                                <div className="whitespace-pre mt-2">
                                    送信者={studentName}
                                    <br />
                                    チャットメッセージ={chatMessage.content}
                                </div>
                            ) : (
                                <div className="whitespace-pre mt-2">
                                    送信者={teacherName}
                                    <br />
                                    チャットメッセージ={chatMessage.content}
                                </div>
                            )}
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
            <div className="py-3">
                <small>&#x1F4AC; チャットへ投稿</small>
                <textarea
                    rows="4"
                    className="block p-2.5 w-full text-sm text-gray-900 border border-gray-400 rounded mb-3"
                    value={chatMessage}
                    onChange={(e) => handleMessageChange(e)}
                    autoFocus
                />
                {/* <button
                    type="button"
                    className="bg-blue text-red-300 px-4 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg"
                    onClick={handlerSubmit}
                >
                    送信する
                </button> */}
                <HStack>
                    <Button
                        colorScheme="blue"
                        size="md"
                        bgColor="white"
                        variant="outline"
                        px={7}
                        type="submit"
                        onClick={handlerSubmit}
                    >
                        送信する
                    </Button>
                </HStack>
                <HStack>
                    <Button
                        colorScheme="blue"
                        size="md"
                        bgColor="white"
                        variant="outline"
                        px={7}
                        ml="12%"
                        onClick={() => navigate(-1)}
                    >
                        戻る
                    </Button>
                </HStack>
            </div>
        </div>
    );
};
export default Chat;
