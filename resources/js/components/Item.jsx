import { useState } from "react";
import { HStack, IconButton, Text } from "@chakra-ui/react";
// POINT react-iconsからアイコンをインポート
import { VscCheck } from "react-icons/vsc";

const Item = ({ todo, complete, updateTodo }) => {
    const [editingContent, setEditingContent] = useState(todo.content);

    const changeContent = (e) => setEditingContent(e.target.value);
    const toggleEditMode = () => {
        const newTodo = { ...todo, editing: !todo.editing };
        //editingをfalseにしてupdateTodoするから、編集状態に変わる
        updateTodo(newTodo);
    };

    const confirmContent = (e) => {
        e.preventDefault();
        const newTodo = {
            ...todo,
            editing: !todo.editing,
            content: editingContent,
        };
        //editingをtrueに、contentを変更してupdateTodoするから、値が変わった状態でリストに入る
        updateTodo(newTodo);
    };
    return (
        <HStack key={todo.id} spacing="5">
            <IconButton
                onClick={() => complete(todo.id)}
                icon={<VscCheck />}
                isRound
                bgColor="cyan.100"
                opacity="0.5"
            >
                完了
            </IconButton>
            <form onSubmit={confirmContent}>
                {todo.editing ? (
                    <input
                        type="text"
                        value={editingContent}
                        onChange={changeContent}
                    />
                ) : (
                    <Text onDoubleClick={toggleEditMode}>{todo.content}</Text>
                )}
            </form>
        </HStack>
    );
};
export default Item;
