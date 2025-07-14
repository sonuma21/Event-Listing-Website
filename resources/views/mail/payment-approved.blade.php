<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div>
            <h1>Payment Request Approved</h1>
        </div>
        <div>
            <p class="text">
                Dear {{ $data['name'] }}, <br>
                Your payment request is approved  <br>
                <span class="bold">Amount:</span> NRs. {{ number_format($data['amount'], 2) }} <br>
            </p>
            <p>Please check your bank account for the payment.</p>
            <p>Thank you for being a part of our platform!</p>
        </div>
    </div>
</body>

</html>
