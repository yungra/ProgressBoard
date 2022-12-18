export default function ChatMessageHeader(props) {

    const chatMessage = props.chatMessage;
    const dt = new Date(chatMessage.created_at);
    const date = dt.toLocaleString('ja-JP');

    return (
        <>
            <small className="text-gray-400">{date}</small>
        </>

    );

};