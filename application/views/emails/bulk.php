<html>
<head>
    <title>Bulk Order Inquiry</title>
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
            <h1>Bulk Order Inquiry</h1>
        </div>
        <div class="email-content">
            <p>Hello Team MNNCHAHA,</p>
            <p>We have received a query for a bulk order.</p>
            <p><strong>Customer Name:</strong> <?php echo isset($data['name']) ? $data['name'] : 'N/A'; ?></p>
            <p><strong>Contact Number:</strong> 
                <a href="tel:<?php echo isset($data['contact']) ? $data['contact'] : ''; ?>">
                    <?php echo isset($data['contact']) ? $data['contact'] : 'N/A'; ?>
                </a>
            </p>
            <p><strong>Email:</strong> 
                <a href="mailto:<?php echo isset($data['email']) ? $data['email'] : ''; ?>">
                    <?php echo isset($data['email']) ? $data['email'] : 'N/A'; ?>
                </a>
            </p>
            <p><strong>Business Name:</strong> <?php echo isset($data['business_name']) ? $data['business_name'] : 'N/A'; ?></p>
            <p><strong>Category:</strong> <?php echo isset($data['category']) ? $data['category'] : 'N/A'; ?></p>
            <p><strong>Quantity:</strong> <?php echo isset($data['quantity']) ? $data['quantity'] : 'N/A'; ?></p>
            <p><strong>Address:</strong> <?php echo isset($data['address']) ? $data['address'] : 'N/A'; ?></p>
            
            <p>Thank you.</p>

            <a href="mailto:<?php echo isset($data['email']) ? $data['email'] : ''; ?>" class="btn">Reply to Customer</a>
        </div>
        <div class="email-footer">
            <p>Regards,</p>
            <p><strong>Team MNNCHAHA</strong></p>
        </div>
    </div>
</body>
</html>
