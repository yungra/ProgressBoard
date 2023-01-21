import { VStack, StackDivider } from "@chakra-ui/react";
import { DragDropContext, Droppable } from "react-beautiful-dnd";

import Item from "./Item";

const reorder = (todos, startIndex, endIndex) => {
    //タスクを並び替える
    const remove = todos.splice(startIndex, 1);
    todos.splice(endIndex, 0, remove[0]);
};

const List = ({ todos, setTodos, deleteTodo, updateTodo }) => {
    const handleDragEnd = (result) => {
        reorder(todos, result.source.index, result.destination.index);
        setTodos(todos);
    };
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
            <DragDropContext onDragEnd={handleDragEnd}>
                <Droppable droppableId="droppable">
                    {(provided) => (
                        <div
                            {...provided.draggableProps}
                            {...provided.dragHandleProps}
                            ref={provided.innerRef}
                        >
                            {todos.map((todo, index) => (
                                <div key={todo.id}>
                                    <Item
                                        index={index}
                                        todo={todo}
                                        complete={complete}
                                        key={todo.id}
                                        updateTodo={updateTodo}
                                    />
                                </div>
                            ))}
                            {provided.placeholder}
                        </div>
                    )}
                </Droppable>
            </DragDropContext>
        </VStack>
    );
};

export default List;
