<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Send Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: dimgray;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .content {
            padding: 20px;
        }

        .content h1 {
            color: #333333;
            text-align: center;
            margin-bottom: 20px;
        }

        .content p {
            color: #555555;
            margin-bottom: 10px;
        }

        .footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            color: #777777;
            font-size: 12px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Chào mừng!</h1>
        </div>
        <div class="content">
            @foreach ($employee as $item)
                <h1>Xin chào {{ $item->employee_name }}! Đây là tài khoản của bạn</h1>
                <p><strong>Tài khoản:</strong> {{ $item->employee_id }}</p>
                <p><strong>Mật khẩu:</strong>123</p>
            @endforeach

        </div>
        <div class="footer">
            <p>&copy; 2024 Inventory.</p>
        </div>
    </div>
</body>

</html>
