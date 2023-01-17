
import "./bootstrap";
import ReactDOM from "react-dom/client";
import { ChakraProvider } from "@chakra-ui/react";
import Todo from "./components/Todo";

function App() {
    return (
      <>
      <ChakraProvider>
        <Todo />
      </ChakraProvider>
    </>
    );
}

const root = ReactDOM.createRoot(document.getElementById("app"));
root.render(<App />);