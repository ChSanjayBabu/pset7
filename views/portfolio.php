

<table>
    <?php $Positions = $_SESSION["positions"];?>
    <tr>
        <th STYLE="Padding: 10px;"><?= "symbol" ?></th>
        <th STYLE="Padding: 10px;"><?= "shares" ?></th>
        <th STYLE="Padding: 10px;"><?= "price " ?></th>
        <th STYLE="Padding: 10px;"><?= "value" ?></th>
    </tr>   
    <?php foreach ($Positions as $position): ?>
        
       <?php $price = number_format($position["price"], 2, '.', ''); ?>
       <?php $value = number_format($position["value"], 2, '.', ''); ?>
        <tr>
            <td><?= $position["symbol"] ?></td>
            <td><?= $position["shares"] ?></td>
            <td><?= $price ?></td>
            <td><?= $value ?></td>
        </tr>

    <?php endforeach ?>
</table>

<?php $form_cash = number_format($_SESSION["balance"], 3, '.', ''); ?>

<table>
    <tr>
        <th><?= "cash" ?></th>
    </tr>
    <tr>
        <td><?= $form_cash ?></td>
    </tr>
</table>