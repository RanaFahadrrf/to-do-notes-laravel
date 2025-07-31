<!DOCTYPE html>
<html>
<head>
    <title>Reminder Email</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    {{-- <p>This is a reminder that your subscription ends on {{ $user->subscription_end->format('F j, Y') }}.</p> --}}
        <p>This is a reminder that your subscription will end soon.</p>
</body>
</html>
