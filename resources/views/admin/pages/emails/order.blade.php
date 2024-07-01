<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <p>Total price of the order is: {{ $totalPrice }}</p>
    <p>{{ $messageContent }}</p>
    <table border="3" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookOrderDetails as $detail)
                <tr>
                    <td>{{ $detail['book_id'] }}</td>
                    <td>{{ $detail['title'] }}</td>
                    <td>{{ $detail['quantity'] }}</td>
                    <td>{{ $detail['price'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
