<div>
    <?php
        $price=$_SESSION["stock"];
        $stock_price = number_format($price, 3, '.', '');
        print("{$stock_price}");
    ?>
</div>