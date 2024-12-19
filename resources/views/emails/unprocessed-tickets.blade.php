<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Unprocessed Tickets</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
<h1>Unprocessed Tickets</h1>
<p>Hello, here is the summary of your unprocessed tickets:</p>

@if($tickets->isEmpty())
    <p>You have no unprocessed tickets.</p>
@else
    <table>
        <thead>
        <tr>
            <th>Subject</th>
            <th>Content</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td><strong>{{ $ticket->subject }}</strong></td>
                <td>{{ $ticket->content }}</td>
                <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
</body>
</html>
