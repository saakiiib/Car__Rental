<!DOCTYPE html>
<html>
<head>
    <title>Your Car Rental Details</title>
</head>
<body>
    <h1>Thank you for renting a car!</h1>
    <p>Your rental details:</p>
    <p>Car: {{ $rental->car->brand }} {{ $rental->car->model }} ({{ $rental->car->year }})</p>
    <p>Rental Period: {{ $rental->start_date }} - {{ $rental->end_date }}</p>
    <p>Total Cost: {{ $rental->total_cost }}</p>
</body>
</html>