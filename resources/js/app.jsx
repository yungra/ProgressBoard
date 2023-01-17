
import "./bootstrap";
import ReactDOM from "react-dom/client";
import { ChakraProvider } from "@chakra-ui/react";
import Todo from "./components/Todo";
import {BrowserRouter as Router} from 'react-router-dom';


function App() {

    return (
      <>
      <Router>
        <ChakraProvider>
          <Todo />
        </ChakraProvider>
      </Router>
    </>
    );
}

const root = ReactDOM.createRoot(document.getElementById("app"));
root.render(<App />);