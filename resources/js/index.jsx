import "./bootstrap";
import ReactDOM from "react-dom/client";
import { ChakraProvider } from "@chakra-ui/react";
import Chat from "./Pages/RealtimeChat/Chat";
import { BrowserRouter as Router } from "react-router-dom";

function Index() {
    return (
        <Router>
            <ChakraProvider>
                <Chat />
            </ChakraProvider>
        </Router>
    );
}

const root = ReactDOM.createRoot(document.getElementById("index"));
root.render(<Index />);
