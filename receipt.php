<!-- receipt.php
     Practicing HTML Forms, jQuery and PHP

     Revision History
        Jaden Ahn, 2017.07.25: Created
        Jaden Ahn, 2017.07.25: Changed If condition in getShipping() and getDeliveryDate() to deal with invalid price which is less than 0.01
                               Changed array_push to array[]
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Assignment4</title>
        <link rel="stylesheet" type="text/css" href="styles\jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="styles\assignmentStyle.css">
    </head>
    <body>
        <header>
            <h1>Assignment4</h1>
        </header>
        <main>
            <article>
                <img src="images\logo.png" id="logo" alt="logo">
                <?php
                    session_start();
                    $errorMessage = array();
                    $userInput = array("firstName", "lastName", "phoneNumber", "email", "street", "city", "province", "postalCode");
                    $inputListName = array("First Name", "Last Name", "Phone Number", "Email", "Street", "City", "province", "Postal Code");
                    $newUserInput = array();
                    $numberOfErrors = 0;

                    for ($i=0; $i < count($userInput); $i++)
                    { 
                        if (!isset($_POST[$userInput[$i]]))
                        {
                            blockInvalidAccess();
                        }
                        else
                        {
                            $newUserInput[$i] = htmlspecialchars(trim($_POST[$userInput[$i]]));
                        }
                    }

                    if(!validateData())
                    {
                        $_SESSION["errorMessage"] = $errorMessage;
                        header("Location: index.php");
                        exit;
                    }

                    function blockInvalidAccess()
                    {
                        global $errorMessage;
                        $errorMessage[] = "* Invalid Access.<br>";
                        $_SESSION["errorMessage"] = $errorMessage;
                        header("Location: index.php");
                        exit;                        
                    }

                    function validateData()
                    {
                        global $userInput, $inputListName, $newUserInput, $errorMessage, $numberOfErrors;
                        $inputListRegEx = array();
                        $inputListRegEx[2] = '/^\(?\d{3}\)?[\.\-\/\s]?\d{3}[\.\-\/\s]?\d{4}$/'; //RegEx for Phone Number
                        $inputListRegEx[3] = '/[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z]+/'; //RegEx for Email
                        $inputListRegEx[4] = '/^\d+\s[A-z]+\s[A-z]+/'; //RegEx for Street
                        $inputListRegEx[7] = '/[ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ] ?[0-9][ABCEGHJKLMNPRSTVWXYZ][0-9]/'; //RegEx for Postal Code
                        $productQuantityA = $_POST["productQuantityA"];
                        $productQuantityB = $_POST["productQuantityB"];
                        $productQuantityC = $_POST["productQuantityC"];
                        
                        if ($productQuantityA + $productQuantityB + $productQuantityC == 0)
                        {
                            $errorMessage[] = "* Please choose at least one product to order.<br>";
                            $numberOfErrors++;
                        }
                        
                        for ($i=0; $i < count($userInput); $i++)
                        {
                            if (empty($newUserInput[$i]))
                            {
                                $errorMessage[] = "* ".$inputListName[$i].": This field must be filled out.<br>";
                                $numberOfErrors++;
                            }
                            else if(!empty($inputListRegEx[$i]))
                            {
                                if(!preg_match($inputListRegEx[$i], $newUserInput[$i]))
                                {
                                    $errorMessage[] = "* ".$inputListName[$i].": Format Doesn't match.<br>";
                                    $numberOfErrors++;
                                }
                            }
                            else
                            {
                                $newUserInput[$i] = htmlspecialchars($_POST[$userInput[$i]]);
                            }
                        }

                        if ($numberOfErrors > 0)
                        {
                            $errorMessage[] = "[ Total Number of Errors: ".$numberOfErrors." ]<br>";
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                    }
                ?>
                <h3 style="color:#EF6C00">Thank you for shopping at Boards"R"Us!</h3>
                <h2><i>Your order has been placed. Please check your receipt :)</i></h2>
                <h2 style="color:#0056AF">[Detailed Order Receipt]</h2>
                <h2>Shipping To:</h2>
                <?php
                    echo "<p id='receipt'>".$newUserInput[0]." ".$newUserInput[1]."</p>"; //firstName lastName
                    echo "<p id='receipt'>".$newUserInput[4]."</p>"; //street
                    echo "<p id='receipt'>".$newUserInput[5].", ".$newUserInput[6]."</p>"; //city, province
                    echo "<p id='receipt'>".$newUserInput[7]."</p>"; //postalCode
                    
                    if ($_POST["message"] != Null)
                    {
                        echo "<p id='receipt'><i>&ldquo;".htmlspecialchars($_POST["message"])."&rdquo;</i></p>";
                    }
                ?>
                
                <h2>Order Information:</h2>
                
                <?php
                    $province = array("Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador", "Northwest Territories", "Nova Scotia", "Nunavut", "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan", "Yukon");
                    $provinceIndex = array_search($_POST["province"], $province);
                    $taxRate = array(5, 12, 13, 15, 15, 5, 15, 5, 13, 15, 14.975, 11, 5);
                    $rateType = array("GST", "GST+PST", "GST+PST", "HST", "HST", "GST", "HST", "GST", "HST", "HST", "GST+QST", "GST+PST", "GST");
                    $finalTaxRate = $taxRate[$provinceIndex];
                    $taxType = $rateType[$provinceIndex];

                    function getSubtotal()
                    {
                        $subTotal = round(($_POST["productPriceA"] * $_POST["productQuantityA"]) + ($_POST["productPriceB"] * $_POST["productQuantityB"]) + ($_POST["productPriceC"] * $_POST["productQuantityC"]), 2);
                        return $subTotal;
                    }

                    function getShipping($subTotal)
                    {
                        $shipping = 0;
                        if ($subTotal >= 0.01 && $subTotal <= 25)
                        {
                            $shipping = 3;
                        }
                        else if ($subTotal >= 25.01 && $subTotal <= 50)
                        {
                            $shipping = 4;
                        }
                        else if ($subTotal >= 50.01 && $subTotal <= 75)
                        {
                            $shipping = 5;
                        }
                        else if ($subTotal > 75)
                        {
                            $shipping = 6;
                        }
                        else
                        {
                            blockInvalidAccess();
                            //If $subTotal is less than 0.01, it is considered invalid access
                        }
                        
                        return $shipping;
                    }

                    function getDeliveryDate($subTotal)
                    {
                        $days = 0;
                        if ($subTotal >= 0.01 && $subTotal <= 50)
                        {
                            $days = 1;
                        }
                        else if ($subTotal >= 50.01 && $subTotal <= 75)
                        {
                            $days = 3;
                        }
                        else if ($subTotal > 75)
                        {
                            $days = 4;
                        }
                        else
                        {
                            blockInvalidAccess();
                            //If $subTotal is less than 0.01, it is considered invalid access
                        }                                                

                        $deliveryDate = Date('M d(D), Y', strtotime("+$days days"));
                        return $deliveryDate;
                    }

                    function getTaxTotal($subTotalBeforeTax, $finalTaxRate)
                    {
                        $taxTotal = round($subTotalBeforeTax * ($finalTaxRate*0.01),2);
                        
                        return $taxTotal;
                    }

                    echo "<p id='receipt'><b>Items Ordered</b></p>";
                    if ($_POST["productQuantityA"] != 0)
                    {
                        echo "<p id='receipt'>".$_POST["productQuantityA"]." ".$_POST["productNameA"]." at $".$_POST["productPriceA"]."</p>";
                    }
                    
                    if ($_POST["productQuantityB"] != 0)
                    {
                        echo "<p id='receipt'>".$_POST["productQuantityB"]." ".$_POST["productNameB"]." at $".$_POST["productPriceB"]."</p>";
                    }
                    
                    if ($_POST["productQuantityC"] != 0)
                    {
                        echo "<p id='receipt'>".$_POST["productQuantityC"]." ".$_POST["productNameC"]." at $".$_POST["productPriceC"]."</p>";
                    }

                    $subTotal = getSubtotal();
                    $shipping = getShipping($subTotal);
                    $taxTotal = getTaxTotal($subTotal, $finalTaxRate);
                    $grandTotal = $subTotal + $shipping + $taxTotal;
                    $deliveryDate = getDeliveryDate($subTotal);
                    
                    echo "<p id='receipt'>------------------------------------------------------------</p>";
                    echo "<p id='receipt'>Item(s) Subtotal: $".number_format($subTotal, 2, '.', ',')."</p>";
                    echo "<p id='receipt'>Shipping: $".number_format($shipping, 2, '.', ',')."</p>";
                    echo "<p id='receipt'>Tax Rate of ".$_POST["province"]."(".$taxType.")".": ".$finalTaxRate."%</p>";
                    echo "<p id='receipt'>Total Tax: $".number_format($taxTotal, 2, '.', ',')."</b></p>";
                    echo "<p id='receipt'>------------------------------------------------------------</p>";
                    echo "<p id='receipt'><b style='font-size:1.2em;'>Grand Total: $".number_format($grandTotal, 2, '.', ',')."</b></p>";
                    echo "<br><p id='receipt' style='color:#EF6C00;'><b><i>Estimated Delivery Date: ".$deliveryDate."</i></b></p>";
                ?>
            </article>
        </main>
        <footer>
            PROG1800-17S-Sec1-Programming Dynamic Websites | Designed &amp; Coded by Jaden
        </footer>
    </body>
</html>
