
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <!-- <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
      color: #000;
    }

    .invoice-container {
      width: 80%;
      margin: 20px auto;
      background: #fff;
      padding: 20px;
      border: 1px solid #ddd;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #000;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .header .details {
      width: 70%;
      display: flex;
    gap: 30px;
    }

    .header .details h1 {
      margin: 0;
      font-size: 24px;
    }

    .header .details p {
      margin: 5px 0;
      line-height: 1.4;
    }

    .header .qr {
      width: 30%;
      text-align: right;
    }

    .header .qr img {
      width: 120px;
      height: 120px;
    }

    .addresses {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .addresses div {
      width: 48%;
    }

    .addresses h3 {
      margin: 0 0 10px;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .table th, .table td {
      border: 1px solid #000;
      padding: 8px;
      text-align: left;
    }

    .table th {
      background: #f4f4f4;
    }

    .footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 20px;
    }

    .footer .signature {
      text-align: center;
    }

    .footer .signature img {
      width: 120px;
      height: auto;
    }

    .footer p {
      margin: 5px 0;
    }

    .footer .notes {
      width: 65%;
      font-size: 12px;
    }

    .footer .order-details {
      text-align: right;
    }

    .footer .order-details img {
      width: 100px;
    }
  </style> -->

  <style>
  /* Page Styling */
  body { font-family: Arial, sans-serif; font-size: 12px; color: #000; }
  
  .invoice-container { width: 100%; border: 1px solid #ddd; padding: 10px; }
  
  /* Table-based header */
  .header-table { width: 100%; border-bottom: 2px solid #000; }
  .header-table td { vertical-align: top; }

  /* Styling for tables */
  .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
  .table th, .table td { border: 1px solid #000; padding: 5px; text-align: left; }
  .table th { background: #f4f4f4; }

  /* Signature & Footer */
  .signature { text-align: center; margin-top: 20px; }
  .signature img { width: 120px; }

  /* Fixing image paths */
  .order-details img { width: 100px; }

</style>

</head>
<body>
  <div class="invoice-container">
    <div class="header">
      <div class="details">
        <h1>Tax Invoice</h1>
        <p><strong>Order ID:</strong> <?= $trackdata['track']['data']['id']?><br>
          <strong> Invoice No:</strong> <?php echo $trackdata['track']['data']['invoice_no'] ?><br>
          <strong> GSTIN:</strong> 36BTMP6791E1ZD</p>
        <p><strong>Order Date:</strong> <?= $trackdata['track']['data']['created_at']?><br>
          <strong> Invoice Date:</strong><?php echo date('d M Y h:i A', strtotime($trackdata['track']['data']['invoice_date']));?></p>
      </div>
      <!-- <div class="qr">
        <img src="qr-placeholder.png" alt="QR Code">
      </div> -->
    </div>

    <div class="addresses">
      <div>
        <h3>Sold By:</h3>
        <p><?= $trackdata['track']['data']['billing_address']. ' ' . $trackdata['track']['data']['billing_address_2'].' '.$trackdata['track']['data']['billing_city']. ' '.$trackdata['track']['data']['billing_pincode'] ?></p>
      </div>
      <div>
        <h3>Shipping Address:</h3>
        <p><?= $trackdata['track']['data']['billing_address']. ' ' . $trackdata['track']['data']['billing_address_2'].' '.$trackdata['track']['data']['billing_city']. ' '.$trackdata['track']['data']['billing_pincode'] ?></p>
      </div>
    </div>


    <table class="table product-detail-table">
                        <thead class="thead">
                            <tr>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Gross Amount</th>
                                <th>Discount</th>
                                <th>Taxable Value</th>
                                <th>IGST</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="order-list">
                            <?php
                            //  echo '<pre>';
                            // print_r($trackdata['track']['data']['products']);
                            foreach ($trackdata['track']['data']['products'] as $product) {?>
                            <tr>
                                <td><?=$product['name'] ?></td>
                                <td><?= 'HSN: '. $product['hsn'] . ' || IGST ' . $product['tax_percentage'].' %' ?></td>
                                <td><?= $product['quantity']?></td>
                                <td><?= $product['net_total']+$product['tax']?></td>
                                <td><?= $product['discount']?></td>
                                <td><?= $product['price']?></td>
                                <td><?= $product['tax']?></td>
                                <td><?= $product['net_total']+$product['tax']?></td>
                                </tr>
                                <tr>
                                    <td>Shipping and Handling Charges</td>
                                    <td></td>
                                    <td></td>
                                    <td> </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                      <?php }?>
                                    </tbody>
                                                    <tfoot>
                                    <tr>
                                    <td colspan="7" style="text-align: right;">TOTAL PRICE:</td>
                                    <td>
                                    <?php 
                                    if ($trackdata['track']['data']['payment_method'] == 'cod') { 
                                        echo $product['net_total'] + $product['tax'] + 40; 
                                    } else { 
                                        echo $product['net_total'] + $product['tax']; 
                                    } 
                                ?> 
                            </td>
        </tr>
      </tfoot>
                    </table>

    <div class="footer">
      <div class="notes">
        <p>Seller Registered Address: Mnnchaha<br>
        213 , Meghdoot signature . HDIL industrial business park . Chandansar road Virar East 401305 district Palghar , Maharashtra.</p>
        <p><strong>Declaration:</strong> The goods sold are intended for end user consumption and not for resale.</p>
      </div>

      <!-- <div class="signature">
        <img src="signature-placeholder.png" alt="Signature">
        <p> Mnnchaha<br>
           Authorized Signature</p>
      </div> -->

      <table style="width: 100%; text-align: right;">
    <tr>
        <td>
            <!-- <p>Ordered Through</p> -->
            <img src="<?php echo base_url().'assets/images/header-new-logo.png'?>" 
                 alt="Flipkart Logo"
                 style="width: 100px; height: auto;">
        </td>
    </tr>
</table>

    </div>
  </div>
</body>
</html>
