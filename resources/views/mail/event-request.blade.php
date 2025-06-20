<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Request Notification</title>
    <!-- Include Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white max-w-lg w-full rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">New Event Request</h1>
            <p class="text-gray-600 mb-6">
                Dear Admin, you have a new event request from
                <span class="font-medium text-gray-800">{{ $data['name'] }}</span>. <br>
                <span class="block mt-2">
                    <span class="font-medium">Email:</span> {{ $data['email'] }} <br>
                    <span class="font-medium">Contact Number:</span> {{ $data['phone'] }}
                </span>
            </p>
            <a href="{{ env('APP_URL') }}/admin"
               class="inline-block bg-blue-600 text-white font-medium py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                View Request
            </a>
        </div>
    </div>
</body>
</html>
