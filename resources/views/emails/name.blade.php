<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Order Shipping Confirmation</title>
</head>
<body>
  <h1>Order Shipping Confirmation</h1>

  <p>Dear Mr/Ms {{ $orders["customer_name"]}},</p>

  <p>We wanted to let you know that your order has been shipped and is on its way to you!</p>

  <img src="http://www.example.com/images/logo.png" alt="Company Logo">

  <h2>Order Details:</h2>
  <ul>
    @foreach ($orders["items"] as $item)
      <li>{{ $item["product_name"]}} x {{ $item["quantity"] }}</li>
    @endforeach
  </ul>

  <p>Shipping Address:<br>
  {{ $orders["shipping_address"] }}</p>

  <p>Thank you for choosing us for your purchase!</p>

  <p>Best regards,<br>
  {{ $company_name }}</p>
</body>
</html>
