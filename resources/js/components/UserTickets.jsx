import React, {useEffect, useState} from "react";
import {useParams} from "react-router-dom";
import axios from "axios";
import Pagination from "./common/Pagination.jsx";

const UserTickets = () => {
    const {email} = useParams();
    const [tickets, setTickets] = useState(null);
    const [perPage] = useState(3);
    const [page, setPage] = useState(1);
    const [pagination, setPagination] = useState({});

    useEffect(() => {
        const url = `/api/users/${email}/tickets?limit=${perPage}&page=${page}`;
        axios
            .get(url)
            .then((response) => {
                setTickets(response.data.data)
                setPagination(response.data.meta);
            })
            .catch((error) => console.error("Error fetching ticket details:", error));
    }, [email, page]);

    const handlePagination = (newPage) => {
        if (newPage >= 1 && newPage <= pagination.last_page) {
            setPage(newPage);
        }
    };


    if (!tickets) {
        return <p className="text-center text-gray-500">Loading ticket details...</p>;
    }

    return (
        <div className="container my-4">
            <h1 className="h2 font-weight-bold mb-4">Ticket Details</h1>

            {tickets.map(ticket => (
                <div className="bg-white shadow rounded p-4 mb-4" key={ticket.id}>
                    <p className="mb-2">
                        <strong className="text-muted">Subject:</strong> {ticket.subject}
                    </p>
                    <p className="mb-2">
                        <strong className="text-muted">Content:</strong> {ticket.content}
                    </p>
                    <p className="mb-2">
                        <strong className="text-muted">Status:</strong>{" "}
                        <span
                            className={`badge ${ticket.status ? 'bg-success' : 'bg-warning'} text-light`}>
                                {ticket.status ? 'Processed' : 'Unprocessed'}
                            </span>
                    </p>
                </div>
            ))}

            <Pagination
                page={page}
                lastPage={pagination.last_page}
                onPageChange={handlePagination}
            />
        </div>


    );
};

export default UserTickets;
