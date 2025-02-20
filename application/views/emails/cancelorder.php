<html>
<head>
    <title>Order Cancellation Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            border-bottom: 2px solid #4CAF50;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .email-header h1 {
            font-size: 24px;
            color: #4CAF50;
        }
        .email-content {
            line-height: 1.6;
        }
        .email-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #999999;
        }
        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Order Cancellation</h1>
        </div>
        <div class="email-content">
            <p>Dear <?= $address['name']?>,</p>
            <p>We regret to inform you that your order <strong>#<?= $address['order_id']?></strong>has been canceled </p>
            <p>If you have already made a payment, the refund process will be initiated and you will receive the credited amount within 5-7 business days.</p>
            <p>We apologize for any inconvenience this may have caused. If you wish to place a new order or have any questions, feel free to reach out to us.</p>
            <p>Thank you for choosing MNNCHAHA.</p>
            <p>Best regards,</p>
            <p><strong>MNNCHAHA Support Team</strong></p>
            <a href="https://www.mnnchaha.com/welcome/contact_us" class="btn">Contact Support</a>
        </div>
        <div class="email-footer">
            <p>Need help? Reach us at <a href="mailto:info@mnnchaha.com">info@mnnchaha.com</a> or call us at +1-800-123-4567.</p>
        </div>
    </div>
</body>
</html>
