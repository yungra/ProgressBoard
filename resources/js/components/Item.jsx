import { HStack, IconButton, Text } from "@chakra-ui/react";
// POINT react-iconsからアイコンをインポート
import { VscCheck } from "react-icons/vsc";

const Item = ({ todo, complete }) => {
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
            <Text>{todo.content}</Text>
        </HStack>
    );
};
export default Item;
