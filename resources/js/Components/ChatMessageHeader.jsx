export default function ChatMessageHeader(props) {

    const name = props.name;
    const firstNameCharacter = name.charAt(0);

    return (
        <>
            <span className="bg-red-400 text-red-50 rounded-full px-1.5 py-1 text-xs mr-1 font-bold">
                {firstNameCharacter}
            </span>
            <small>{name} さん</small>
        </>

    );

};