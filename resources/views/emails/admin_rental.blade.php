<!DOCTYPE html>
<html>
<head>
    <title>New Car Rental Notification</title>
</head>
<body>
    <h1>New Car Rental Notification</h1>
    <p>A new rental has been made:</p>
    <p>Customer: {{ $rental->user->name }} ({{ $rental->user->email }})</p>
    <p>Car: {{ $rental->car->brand }} {{ $rental->car->model }} ({{ $rental->car->year }})</p>
    <p>Rental Period: {{ $rental->start_date }} - {{ $rental->end_date }}</p>
    <p>Total Cost: {{ $rental->total_cost }}</p>
</body>
</html>