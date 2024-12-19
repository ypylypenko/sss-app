import './bootstrap';

import ReactDOM from 'react-dom/client';
import {BrowserRouter as Router, Route, Routes} from "react-router-dom";
import UserTickets from "./components/UserTickets.jsx";
import TicketsList from "./components/TicketsList.jsx";
import 'bootstrap';
import '../css/app.css';
import Statistics from "./components/Statistics.jsx";

const root = ReactDOM.createRoot(document.getElementById('app'));

root.render(
    <Router>
        <Routes>
            <Route path="/" element={
                <div>
                    <Statistics/>
                    <TicketsList/>
                </div>
            }/>
            <Route path="/users/:email/tickets" element={<UserTickets/>}/>
        </Routes>
    </Router>
);
