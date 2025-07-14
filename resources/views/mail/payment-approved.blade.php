<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .text {
            font-size: 16px;
            color: #555555;
            line-height: 1.6;
        }
        .bold {
            font-weight: bold;
            color: #333333;
        }
        p {
            font-size: 16px;
            color: #555555;
            line-height: 1.6;
            margin: 10px 0;
        }
        .amount {
            color: #2e7d32;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <h1>Payment Request Approved</h1>
        </div>
        <div>
            <p class="text">
                Dear {{ $data['name'] }}, <br>
                Your payment request has been approved. <br>
                <span class="bold">Original Amount:</span> NRs. {{ number_format($data['amount'], 2) }} <br>
                <span class="bold">Event Charge (10%):</span> NRs. {{ number_format($data['amount'] * 0.10, 2) }} <br>
                <span class="bold">Final Amount:</span> <span class="amount">NRs. {{ number_format($data['amount'] * 0.90, 2) }}</span> <br>
            </p>
            <p>Please check your bank account for the payment.</p>
            <p>Thank you for being a part of our platform!</p>
        </div>
    </div>
</body>
</html>
