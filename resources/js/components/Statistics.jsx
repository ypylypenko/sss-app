import React, { useEffect, useState } from "react";
import axios from "axios";

const Statistic = () => {
    const [stats, setStats] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    const fetchStats = async () => {
        try {
            const response = await axios.get("/api/stats");
            setStats(response.data);
            setError(null);
        } catch (err) {
            setError("Failed to fetch stats");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchStats();
        const interval = setInterval(fetchStats, 60000);
        return () => clearInterval(interval);
    }, []);

    if (loading) {
        return <div className="text-center">Loading...</div>;
    }

    if (error) {
        return <div className="alert alert-danger text-center">{error}</div>;
    }

    return (
        <div className="container mt-4">
            <h2 className="mb-4">Ticket Statistics</h2>
            <table className="table table-bordered table-hover">
                <thead className="table-dark">
                <tr>
                    <th>Total Tickets</th>
                    <th>Unprocessed Tickets</th>
                    <th>Top User</th>
                    <th>Email</th>
                    <th>Tickets Count</th>
                    <th>Last Processed</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{stats.total_tickets}</td>
                    <td>{stats.unprocessed_tickets}</td>
                    <td>{stats.top_user.name}</td>
                    <td>{stats.top_user.email}</td>
                    <td>{stats.top_user.tickets_count}</td>
                    <td>{new Date(stats.last_processed).toLocaleString()}</td>
                </tr>
                </tbody>
            </table>
        </div>
    );
};

export default Statistic;
