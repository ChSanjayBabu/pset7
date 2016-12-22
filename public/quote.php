<?php
    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
            render("quote_form.php");
    }
    
    // checks if user enters symbol
    if (empty($_POST["symbol"]))
    {
        apologize("please provide symbol");
    }
    
    
    $stock = lookup($_POST["symbol"]);
    
    // checks if user enters valid symbol
    if($stock == false)
    {
        apologize("invalid symbol");
    }
    $_SESSION["stock"] = $stock["price"];
    
    // renders to display info of stock
    render("quote.php");
?>
