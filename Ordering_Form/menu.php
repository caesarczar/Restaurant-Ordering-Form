<html><head>
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
                
              <h3>Lunch Menu</h3>
              <h3>Order lunch online for take-out</h3>
              <p>Please fill in how many of each item you would like, and click the "Place order" button<p>
                <form action="confirm.php" method="post">
                  <p>
                    <label for="customer_name">Your name :  </label>
                    <input type="text" id="customer_name" name="customer_name" required="">
                  </p>
                  <p>
                    <label for="email">Your email address :  </label>
                    <input type="email" id="email" name="email" required="">
                  </p>
                  <p>
                  <table>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                    
            
                  <?php
                    require_once("db_connect.php");
                    mysqli_select_db($conn, "aidancbradley");
                    $menuQuery = "SELECT `id`, `displayName`, `attrs`, `price` FROM `imperial_china_menu` WHERE `menu`= 'lunch'";
                    $menuResults = mysqli_query($conn, $menuQuery);
                    if(!$menuResults){
                      echo("Error selecting from database table");
                    }

                    while($row = mysqli_fetch_assoc($menuResults)){
                      echo("<tr>");
                      echo("<td>") ?>
                      <td><input type="number" name="quantity[<?php echo $row['id']; ?>]" style= "width: 50px;"/></td>
                      <?php
                      if($row['attrs'] == "hotSpicy"){
                        echo("<td>" . $row['displayName']  . "*" . "</td>");
                      }
                      else{
                        echo("<td>" . $row['displayName'] . "</td>");
                      }
                      echo("<td>" . "$" . $row['price'] . "</td>");
                        echo("</tr>");
                    } 
                    mysqli_close($conn);
                    ?>
                    </table>
                    <input type="submit" value="Place Order">
                  </p>
                </form>
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
    
    
    </body></html>