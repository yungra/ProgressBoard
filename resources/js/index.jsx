import "./bootstrap";
import ReactDOM from "react-dom/client";
import { ChakraProvider } from "@chakra-ui/react";
import Index from "./Pages/RealtimeChat/Chat";
import { BrowserRouter as Router } from "react-router-dom";

function index() {
    return (
        <Router>
            <ChakraProvider>
                <Index />
            </ChakraProvider>
        </Router>
    );
}

const root = ReactDOM.createRoot(document.getElementById("index"));
root.render(<Index />);
