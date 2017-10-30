<!-- index.php
     Practicing HTML Forms, jQuery and PHP

     Revision History
        Jaden Ahn, 2017.07.25: Created
        Jaden Ahn, 2017.07.27: Used php loop for combo boxes
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Assignment4</title>
        <link rel="SHORTCUT ICON" href="images\favicon.ico">
        <link rel="stylesheet" type="text/css" href="styles\jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="styles\assignmentStyle.css">
        <script src="javaScript\jquery.js"></script>
        <script src='javaScript\jquery.elevatezoom.js'></script>
        <script src="javaScript\validation.js"></script>
        <?php
            session_start();
        ?>
    </head>
    <body onLoad="onPageLoad()">
        <header>
            <h1>Assignment4</h1>
        </header>
        <main>
            <article>
                <img src="images\logo.png" id="logo" alt="logo">
                <p> 1-3 of 3 results for Toys &amp; Games : Games : "board games"</p>
                <h3>Product List</h3>
                <em>Bestsellers</em><br><br>
                <form action="receipt.php" method="POST" onsubmit="return validateData()">
                    <table>
                        <thead>
                            <tr>
                                <td></td>
                                <td>Product</td>
                                <td>Price</td>
                                <td>Quantity</td>
                            </tr>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img class="zoom" src="images/small/productA.jpg" data-zoom-image="images/large/productA.jpg" alt="Product A photo" style="width: 200px;"/>
                                <td class="description">
                                    <input type="hidden" name="productNameA" value="DRUNK STONED OR STUPID [A Party Game]"><h2>DRUNK STONED OR STUPID [A Party Game]</h2>
                                    <p>DRUNK STONED OR STUPID is a party game for you and your stupid friends. Each round a card is drawn and the group decides who in the group would be most likely to do stupid things!</p>

                                </td>
                                <td class="price"><input type="hidden" name="productPriceA" value="15.50">$15.50</td>
                                <td>
                                    <select name="productQuantityA" id="productQuantityA" class="quantity" autofocus="true">
                                        <?php
                                            for ($i=0; $i <= 10 ; $i++) { 
                                                echo "<option value='$i'>$i</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="zoom" src="images/small/productB.jpg" data-zoom-image="images/large/productB.jpg" alt="Product B photo" style="width: 200px;"/>
                                </td>
                                <td class="description">
                                    <input type="hidden" name="productNameB" value="Exploding Kittens"><h2>Exploding Kittens</h2>
                                    <p>This NSFW Edition of Exploding Kittens is an ADULT ONLY party game for 2-5 players (up to 9 players when combined with any other deck)</p>
                                </td>
                                <td class="price"><input type="hidden" name="productPriceB" value="25.00">$25.00</td>
                                <td>
                                    <select name="productQuantityB" id="productQuantityB" class="quantity">
                                        <?php
                                            for ($i=0; $i <= 10 ; $i++) { 
                                                echo "<option value='$i'>$i</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="zoom" src="images/small/productC.jpg" data-zoom-image="images/large/productC.jpg" alt="Product C photo" style="width: 200px;"/>
                                </td>
                                <td class="description">
                                    <input type="hidden" name="productNameC" value="Secret Hitler"><h2>Secret Hitler</h2>
                                    <p>Secret Hitler is a dramatic game of political intrigue and betrayal set in 1930's Germany. Players are secretly divided into two teams - liberals and fascists. Known only to each other, the fascists coordinate to sow distrust and install their cold-blooded leader.</p>
                                </td>
                                <td class="price"><input type="hidden" name="productPriceC" value="69.99">$69.99</td>
                                <td>
                                    <select name="productQuantityC" id="productQuantityC" class="quantity">
                                        <?php
                                            for ($i=0; $i <= 10 ; $i++) { 
                                                echo "<option value='$i'>$i</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table><br><br>

                    <fieldset>
                        <legend><h2>Shipping Information</h2></legend>
                        <p>* Some fields are mandatory</p>
                        <table id="userInfo">
                            <tr>
                                <th>First Name:</th>
                                <td><input type="text" name="firstName" id="firstName" onfocusout="this.value = capitalizeFirstLetter(this.value)" size="24"></input></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Last Name:</th>
                                <td><input type="text" name="lastName" id="lastName" onfocusout="this.value = capitalizeFirstLetter(this.value)" size="24"></input></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Phone Number:</th>
                                <td><input type="text" name="phoneNumber" id="phoneNumber" onfocusout="this.value = capitalizeFirstLetter(this.value)" size="24"></input></td>
                                <td class="example">Ex. (123) 456-7890</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><input type="text" name="email" id="email" onfocusout="this.value = trimWhiteSpace(this.value)" size="24"></input></td>
                                <td class="example">Ex. username@gmail.com</td>
                            </tr>
                            <tr>
                                <th>Street</th>
                                <td><input type="text" name="street" id="street" onfocusout="this.value = capitalizeFirstLetter(this.value)" size="24"></input></td>
                                <td class="example">Ex. 150 Pioneer Drive</td>
                            </tr>
                            <tr>
                                <th>City:</th>
                                <td><input type="text" name="city" id="city" onfocusout="this.value = capitalizeFirstLetter(this.value)" size="24"></input></td>
                            </tr>
                            <tr>
                                <th>Province:</th>
                                <td>
                                    <select name="province" id="province">
                                        <option value="Alberta">Alberta</option>
                                        <option value="British Columbia">British Columbia</option>
                                        <option value="Manitoba">Manitoba</option>
                                        <option value="New Brunswick">New Brunswick</option>
                                        <option value="Newfoundland And Labrador ">Newfoundland And Labrador</option>
                                        <option value="Northwest Territories">Northwest Territories</option>
                                        <option value="Nova Scotia">Nova Scotia</option>
                                        <option value="Nunavut">Nunavut</option>
                                        <option value="Ontario" selected>Ontario</option>
                                        <option value="Prince Edward Island">Prince Edward Island</option>
                                        <option value="Quebec">Quebec</option>
                                        <option value="Saskatchewan">Saskatchewan</option>
                                        <option value="Yukon ">Yukon</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Postal Code:</th>
                                <td><input type="text" name="postalCode" id="postalCode" onfocusout="this.value = capitalizeWord(this.value)" size="24"></input></td>
                                <td class="example">Ex. N2G 4M4</td>
                            </tr>
                            <tr>
                                <th>Messages:</th>
                                <td colspan="2"><textarea name="message" id="message" cols="45" rows="5" placeholder="Messages"></textarea>
                            </tr>
                        </table>
                    </fieldset>
                    <noscript>
                        <p style="color:#0056AF">## Some functions may not work properly without JavaScript ##</p>
                    </noscript>
                    
                    <p class="notice" id="ErrorMessage">
                        <?php
                            if (isset($_SESSION["errorMessage"]))
                            {
                                for ($i=0; $i < count($_SESSION["errorMessage"]); $i++) { 
                                    echo $_SESSION["errorMessage"][$i];
                                }
                                unset($_SESSION["errorMessage"]);
                                session_destroy();
                            }
                        ?>
                    </p>
                    <input class="button" type="submit" value="Place Order">
                    <input class="button" type="reset" value="Reset">
                </form>
            </article>
        </main>
        <footer>
            PROG1800-17S-Sec1-Programming Dynamic Websites | Designed &amp; Coded by Jaden
        </footer>
    </body>
</html>
