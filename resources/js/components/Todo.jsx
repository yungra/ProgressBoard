import { useState } from "react";
// POINT Chakra UIのホームページから使用したいコンポーネントを見つけてインポート
import { VStack, Heading, HStack, Button } from "@chakra-ui/react";
import { useNavigate } from "react-router-dom";

import List from "./List";
import Form from "./Form";

const Todo = () => {
    const navigate = useNavigate();

    const todosList = [
        {
            id: 1,
            content: "英語の参考書、2〜5Pを音読",
            editing: false,
        },
        {
            id: 2,
            content: "数学プリント",
            editing: false,
        },
        {
            id: 3,
            content: "物理の参考書、3Pまで",
            editing: false,
        },
    ];

    const [todos, setTodos] = useState(todosList);

    const deleteTodo = (id) => {
        const newTodos = todos.filter((todo) => {
            return todo.id !== id;
        });

        setTodos(newTodos);
    };

    const createTodo = (todo) => {
        setTodos([...todos, todo]);
    };

    const updateTodo = (todo) => {
        const newTodos = todos.map((_todo) => {
            return _todo.id === todo.id ? { ..._todo, ...todo } : { ..._todo };
        });
        setTodos(newTodos);
    };

    return (
        <>
            <VStack p="10" spacing="10">
                <Heading color="blue.200" fontSize="5xl">
                    Reminder
                </Heading>
                <List
                    todos={todos}
                    deleteTodo={deleteTodo}
                    updateTodo={updateTodo}
                />
                <Form createTodo={createTodo} />
            </VStack>
            <HStack>
                <Button
                    colorScheme="blue"
                    size="md"
                    bgColor="white"
                    variant="outline"
                    px={7}
                    ml={10}
                    onClick={() => navigate(-1)}
                >
                    戻る
                </Button>
            </HStack>
        </>
    );
};
export default Todo;
