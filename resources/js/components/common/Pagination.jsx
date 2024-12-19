import React from 'react';

const Pagination = ({ page, lastPage, onPageChange }) => {
    return (
        <div className="d-flex justify-content-between align-items-center">
            <button
                className="btn btn-secondary"
                disabled={page === 1}
                onClick={() => onPageChange(page - 1)}
            >
                Previous
            </button>
            <span>Page {page} of {lastPage}</span>
            <button
                className="btn btn-secondary"
                disabled={page === lastPage}
                onClick={() => onPageChange(page + 1)}
            >
                Next
            </button>
        </div>
    );
};

export default Pagination;
