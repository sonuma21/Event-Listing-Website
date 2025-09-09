<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Suspension Notification</title>
</head>

<body>
    <div class="container">
        <div>
            <h1>Event Request Suspended</h1>
        </div>
        <div>
            <p class="text">
                Dear {{ $data['organizer_name'] }}, <br>
                We regret to inform you that your event <span class="bold">{{ $data['event_title'] }}</span> has been suspended. <br>
                <span>
                    <span class="bold">Date:</span> {{ $data['event_date'] }} <br>
                    <span class="bold">Time:</span> {{ $data['event_time'] }} <br>
                    <span class="bold">Location:</span> {{ $data['event_location'] }} <br>
                </span>
            </p>
            <p>Please contact our support team for more information or to address any concerns regarding this suspension.</p>


            <p>Thank you for being a part of our platform!</p>
        </div>
    </div>
</body>

</html>
