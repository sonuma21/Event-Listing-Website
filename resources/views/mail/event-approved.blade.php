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
            <h1>Event Request Approved</h1>
        </div>
        <div>
            <p class="text">
                Dear {{ $data['organizer_name'] }}, <br>
                Your event <span class="bold">{{ $data['event_title'] }}</span> has been approved! <br>
                <span>
                    <span class="bold">Date:</span> {{ $data['event_date'] }} <br>
                    <span class="bold">Time:</span> {{ $data['event_time'] }} <br>
                    <span class="bold">Location:</span> {{ $data['event_location'] }} <br>
                    @if ($data['password'])
                        <span class="bold">Password:</span> {{ $data['password'] }} <br>
                    @endif
                </span>
            <p>Please log in and change your password as soon as possible.</p>
            </p>
            <a href="{{ env('APP_URL') }}/organizer">Login Here</a>

            <p>Thank you for being a part of our platform!</p>
        </div>
    </div>
</body>

</html>
