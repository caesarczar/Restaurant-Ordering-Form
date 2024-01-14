<html>

<head>
  <?php
  $customer_name = $_POST['customer_name'];
  $email = $_POST['email'];
  $quantity = $_POST['quantity'];
  $order_id = uniqid();
  $item_id = uniqid(); 
  
  $subtotal = 0;
  $total = 0;
  require_once("db_connect.php");
  mysqli_select_db($conn, "aidancbradley");
  ?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Imperial China Chinese Restaurant: Order Online!</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
  <div id="wrapper">
    <div id="wrapper_inner">
      <div id="inner_logo">
        <div id="header">
          <h1>Imperial China Chinese Restaurant</h1>
          <h2>Voted Greater Portland's Best Chinese Restaurant from 1995 through 2008</h2>
          <p>220 Maine Mall Road (Mall Plaza)</p>
          <p> South Portland, Maine 04106</p>
          <p>Phone: (207) 774-4292</p>
        </div>
        <div id="menu">
          <ul>
            <li id="menu_home"><a href="#">Home</a></li>
            <li id="menu_menu"><a href="#">Menu</a></li>
            <li id="menu_about"><a href="#">About Us</a></li>
            <li id="menu_contact"><a href="#">Contact Us</a></li>
          </ul>
        </div>
        <div id="info">
          <ul>
            <li>Hunan Restaurant </li>
            <li>Fine Dining </li>
            <li>Phone Orders</li>
          </ul>
        </div>
        <div id="pageContent">
          <h2>Order Online! </h2>
          <div id="restaurant_menu">
            <h1>Your Order Summary</h1>

            <p>Name: <?php echo ($_POST['customer_name']); ?>
              <br>
              Email: <?php echo ($_POST['email']); ?>
            </p>
            
            <table>
              <tbody>
              <tr>
                <th><strong>Item</strong></th>
                <th><strong>Price</strong></th>
                <th><strong>Quantity</strong></th>
                <th><strong>Subtotal</strong></th>
              </tr>
            
            <?php

           
            foreach ($quantity as $item_id => $num_value) {
              if ($num_value > 0) {

                $price = "";
                $disName = "";
                $attrs = "";
                //rename order_id to item_id
                $getMenuItemQuery = "SELECT * FROM `imperial_china_menu` WHERE `id` = '$item_id'";
                $selectResult = mysqli_query($conn, $getMenuItemQuery);
                if (!$selectResult) {
                  echo ("Error selecting from database table");
                }
                while ($row = mysqli_fetch_assoc($selectResult)) {
                  $price = $row['price'];
                  $disName = $row['displayName'];
                  $attrs = $row['attrs'];
                }
                $subtotal = $price * $num_value;
                
                $single_item_query = "
                
                    INSERT INTO `china_orders`
                    (`customer_name`, `email`, `order_id`, `quantity`, `item_id`)
                    VALUES
                    ('$customer_name', '$email', '$order_id', $num_value, $item_id)
                    ";

                    $single_item_result = mysqli_query($conn, $single_item_query);
                    if (!$single_item_result) {
                      echo ("Error selecting from database table");
                    }
                //order_id is for a combination of item_ids
                $total += $subtotal;
                
                $formatTot = sprintf("%01.2f", $total);
                $formatSub = sprintf("%01.2f", $subtotal);
                
                if ($attrs == "hotSpicy") {
                  echo ("<td>" . $disName . "*" . "</td>");
                } else {
                  echo ("<td>" . $disName . "</td>");
                }
                echo ("<td>" . "$" . $price . "</td>");
                echo ("<td>" . $num_value . "</td>");
                echo ("<td>" . "$" . $formatSub . "</td>");
                echo ("<tr>" . "</tr>");
              }
            }
            
            ?></tbody></table><br><strong><?php
            echo ("ORDER TOTAL: $" . $formatTot);
            mysqli_close($conn);

            ?></strong>
            <p><a href="menu.php">Go back to menu</a></p>
            <h3>&nbsp;</h3>
          </div>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
    <div id="footer">
      <div id="address">
        <p>Imperial China Chinese Restaurant&nbsp;&nbsp; <br>
          Address: 220 Maine Mall Road (Mall Plaza) <br>
          South Portland, Maine 04106<br>
          Phone: (207) 774-4292<br>
          E-mail: <a href="mailto:imperialchina@maine.com">imperialchina@maine.com</a></p>
      </div>
      <div id="hours">
        <p>Hours of Operation:<br>
          Sunday - Thursday 11:00 AM to 9:30 PM<br>
          Friday - Saturday 11:00 AM to 10:30 PM<br>
          We Speak: Chinese &amp; English<br>
        </p>
      </div>
      <div id="cc"> We Accept:
        <ul>
          <li id="li_amex"><span>American Express</span></li>
          <li id="li_discover"><span>Discover</span></li>
          <li id="li_mc"><span>Master Card</span></li>
          <li id="li_visa"><span>VISA</span></li>
        </ul>
      </div>
    </div>
  </div>


</body>

</html>