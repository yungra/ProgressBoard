import { useState } from "react";
import { HStack, IconButton, Text, useToast } from "@chakra-ui/react";
// POINT react-iconsからアイコンをインポート
import { VscCheck } from "react-icons/vsc";
import { Draggable } from "react-beautiful-dnd";

const Item = ({ index, todo, complete, updateTodo }) => {
    const toast = useToast();
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
        <Draggable index={index} draggableId={todo.id.toString()}>
            {/* {console.log(todo.id)} */}
            {(provided) => (
                <div
                    className="taskBox"
                    key={todo.id}
                    ref={provided.innerRef}
                    {...provided.draggableProps}
                    {...provided.dragHandleProps}
                >
                    <HStack key={todo.id} spacing="5">
                        <IconButton
                            onClick={() => {
                                complete(todo.id);
                                toast({
                                    title: "タスクを削除しました！",
                                    description: todo.content,
                                    status: "success",
                                    duration: 3000,
                                    isClosable: true,
                                });
                            }}
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
                                <Text onDoubleClick={toggleEditMode}>
                                    {todo.content}
                                </Text>
                            )}
                        </form>
                    </HStack>
                </div>
            )}
        </Draggable>
    );
};
export default Item;
