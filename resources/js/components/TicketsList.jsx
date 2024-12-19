import React, {useState, useEffect} from 'react';
import axios from 'axios';
import Pagination from './common/Pagination.jsx';

const TicketsList = () => {
    const [tickets, setTickets] = useState([]);
    const [page, setPage] = useState(1);
    const [perPage] = useState(3);
    const [status, setStatus] = useState('open');
    const [pagination, setPagination] = useState({});

    const fetchTickets = async () => {
        try {
            const url = `/api/tickets/${status}?limit=${perPage}&page=${page}`;
            const response = await axios.get(url);
            setTickets(response.data.data);
            setPagination(response.data.meta);
        } catch (error) {
            console.error('Error fetching tickets:', error);
        }
    };

    useEffect(() => {
        fetchTickets();
        const interval = setInterval(() => {
            fetchTickets();
        }, 5000);

        return () => clearInterval(interval);
    }, [status, page]);

    const handleStatusChange = (newStatus) => {
        setStatus(newStatus);
        setPage(1);
    };

    const handlePagination = (newPage) => {
        if (newPage >= 1 && newPage <= pagination.last_page) {
            setPage(newPage);
        }
    };

    return (
        <div>
            <h1 className="h2 font-weight-bold mb-4">
                {status === 'open' ? 'Open' : 'Closed'} Tickets
            </h1>

            <div className="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input
                    type="radio"
                    className="btn-check"
                    name="status"
                    id="openTickets"
                    autoComplete="off"
                    checked={status === 'open'}
                    onChange={() => handleStatusChange('open')}
                />
                <label className="btn btn-outline-primary" htmlFor="openTickets">Open Tickets</label>

                <input
                    type="radio"
                    className="btn-check"
                    name="status"
                    id="closedTickets"
                    autoComplete="off"
                    checked={status === 'closed'}
                    onChange={() => handleStatusChange('closed')}
                />
                <label className="btn btn-outline-primary" htmlFor="closedTickets">Closed Tickets</label>
            </div>
            <div className="mb-3"></div>
            <table className="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>Content</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {tickets.map(ticket => (
                    <tr key={ticket.id}>
                        <td>{ticket.id}</td>
                        <td>{ticket.subject}</td>
                        <td>{ticket.content}</td>
                        <td>{ticket.user.name} ({ticket.user.email})</td>
                        <td>
                            <span
                                className={`badge ${ticket.status ? 'bg-success' : 'bg-warning'} text-light`}>
                                {ticket.status ? 'Processed' : 'Unprocessed'}
                            </span>
                        </td>
                        <td>
                            <a href={`/users/${ticket.user.email}/tickets`}>
                                View User Tickets
                            </a>
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>

            <Pagination
                page={page}
                lastPage={pagination.last_page}
                onPageChange={handlePagination}
            />
        </div>
    );
};

export default TicketsList;
