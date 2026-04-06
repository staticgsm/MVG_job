<!DOCTYPE html>
<html>
<head>
    <title>New Contact Inquiry</title>
</head>
<body>
    <h2>New Contact Inquiry Received</h2>
    <p><strong>Name:</strong> {{ $contactData['name'] }}</p>
    <p><strong>Email:</strong> {{ $contactData['email'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $contactData['comment'] }}</p>
    <br>
    <p>Sent from: MVG Company Website</p>
</body>
</html>
