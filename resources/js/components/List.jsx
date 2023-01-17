import { VStack, StackDivider } from "@chakra-ui/react";
import Item from "./Item";

const List = ({ todos, deleteTodo, updateTodo }) => {
    const complete = (id) => {
        deleteTodo(id);
    };
    return (
        <VStack
            divider={<StackDivider />}
            width="80%"
            bgColor="white"
            // color={{ sm: 'red.600', md: 'blue.600', lg: 'green.500', xl: 'red.600' }}
            borderColor="blackAlpha.100"
            borderWidth="1px"
            borderRadius="3px"
            p={5}
            alignItems="start"
        >
            {todos.map((todo) => (
                <Item
                    todo={todo}
                    complete={complete}
                    key={todo.id}
                    updateTodo={updateTodo}
                />
            ))}
        </VStack>
    );
};

export default List;
