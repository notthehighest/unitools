<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Announcement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }
        h2 {
            color: #555;
            font-size: 20px;
            margin: 10px 0;
        }
        .date {
            font-weight: bold;
            color: #333;
        }
        .footer {
            margin-top: 20px;
            font-size: 16px;
            color: #777;
        }
        .thank-you {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $title }}</h1>
        <h2>{{ $description }}</h2>
        <h2 class="date"><strong>Date:</strong> {{ $date }}</h2>
        <div class="thank-you">
            <h2>Thank you,<br>Pagkakaisa Farmers' Association</h2>
        </div>
    </div>
</body>
</html>