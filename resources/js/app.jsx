import './bootstrap';

import ReactDOM from 'react-dom/client';
import {BrowserRouter as Router, Route, Routes} from "react-router-dom";
import TicketsList from "./components/TicketsList.jsx";
import 'bootstrap';
import '../css/app.css';

const root = ReactDOM.createRoot(document.getElementById('app'));

root.render(
    <Router>
        <Routes>
            <Route path="/" element={<TicketsList/>}/>
        </Routes>
    </Router>
);