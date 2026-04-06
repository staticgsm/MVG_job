<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
</head>
<body>
    <h2>Thank you for contacting us, {{ $contactData['name'] }}!</h2>
    <p>We have received your message and will get back to you shortly.</p>
    <p><strong>Your Message:</strong></p>
    <p>{{ $contactData['comment'] }}</p>
    <br>
    <p>Best regards,<br>MVG Company Team</p>
</body>
</html>
