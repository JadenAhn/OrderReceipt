/* validation.js
     Practicing HTML Forms, jQuery and PHP

     Revision History
        Jaden Ahn + Aubrey Delong, 2017.07.14: Created
*/

$(document).ready(function(){
    $(".zoom").elevateZoom();
    // $(".zoom").elevateZoom({scrollZoom : true}); //This is for scroll zoom
});

var inputList = new Array("firstName", "lastName", "phoneNumber", "email", "street", "city", "postalCode");

function onPageLoad()
{
    for (var i = 0; i < inputList.length; i++)
    {
        document.getElementById(inputList[i]).className = "required"
    }
}

function validateData()
{
    var inputListName = new Array("First Name", "Last Name", "Phone Number", "Email", "Street", "City", "Postal Code");
    var inputListRegEx = new Array();
    inputListRegEx[2] = /^\(?\d{3}\)?[\.\-\/\s]?\d{3}[\.\-\/\s]?\d{4}$/; //RegEx for Phone Number
    inputListRegEx[3] = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/; //RegEx for Email
    inputListRegEx[4] = /^\d+\s[A-z]+\s[A-z]+/; //RegEx for Street
    inputListRegEx[6] = /[ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ] ?[0-9][ABCEGHJKLMNPRSTVWXYZ][0-9]/; //RegEx for Postal Code

    var errorMessage = new Array();
    var numberOfErrors = 0;

    document.getElementById('ErrorMessage').innerHTML = "";
    
    var productQuantityA = document.getElementById("productQuantityA").value;
    var productQuantityB = document.getElementById("productQuantityB").value;
    var productQuantityC = document.getElementById("productQuantityC").value;

    if (productQuantityA + productQuantityB + productQuantityC == 0)
    {
        document.getElementById("productQuantityA").focus();
        errorMessage.push("* Please choose at least one product to order.<br>");
        numberOfErrors++;
    }

    for (var index = 0; index < inputList.length; index++)
    {
        var inputValue = document.getElementById(inputList[index]).value;
        if (inputValue == '')
        {
            document.getElementById(inputList[index]).focus();
            errorMessage.push("* " + inputListName[index] + ": This field must be filled out.<br>");
            document.getElementById(inputList[index]).className = "required"
            numberOfErrors++;
        }
        else if(inputListRegEx[index] != null)
        {
            if (inputValue.match(inputListRegEx[index]) == null)
            {
                errorMessage.push("* " + inputListName[index] + ": Format Doesn't match.<br>");
                document.getElementById(inputList[index]).className = "required"
                numberOfErrors++;
            }
            else
            {
                document.getElementById(inputList[index]).value = inputValue.match(inputListRegEx[index])
                document.getElementById(inputList[index]).className = "valid"
            }
        }
        else
        {
            document.getElementById(inputList[index]).className = "valid"
        }
    }

    //Show compound error messages that includes all of the error messages
    for (var index = 0; index < errorMessage.length; index++) {

        document.getElementById('ErrorMessage').innerHTML += errorMessage[index];
    }

    document.getElementById('ErrorMessage').innerHTML += "[ Total Number of Errors: " + numberOfErrors + " ]<br>";

    //return true only when there's no error
    if (numberOfErrors == 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function capitalizeFirstLetter(input)
{
    var letter = input.split(" ");
    var newWord = "";

    for (var i = 0; i < letter.length; i++)
    {
        var space = "";
        if(i != 0)
        {
            space = " "
        }
        newWord += space + letter[i].charAt(0).toUpperCase() + letter[i].slice(1);
    }
    
    return newWord.trim();
}

function capitalizeWord(input)
{
    
    return input.toUpperCase().trim();
}

function trimWhiteSpace(input)
{
    return input.trim();
}