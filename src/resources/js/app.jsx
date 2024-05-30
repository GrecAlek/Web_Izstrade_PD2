import React from "react";
import ReactDOM from "react-dom/client";
import PageDesign from "./pageDesign";


function App() {
    return (
        <PageDesign />
    );
}

const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(
<React.StrictMode>
<App />
</React.StrictMode>
);
