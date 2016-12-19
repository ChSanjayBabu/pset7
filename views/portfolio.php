<table>
    <?php $Positions = $_SESSION["positions"];?>
    <tr>
        <th STYLE="Padding: 10px;"><?= "symbol" ?></th>
        <th STYLE="Padding: 10px;"><?= "shares" ?></th>
        <th STYLE="Padding: 10px;"><?= "price " ?></th>
        <th STYLE="Padding: 10px;"><?= "values" ?></th>
    </tr>   
    <?php foreach ($Positions as $position): ?>

        <tr>
            <td><?= $position["symbol"] ?></td>
            <td><?= $position["shares"] ?></td>
            <td><?= $position["price"] ?></td>
            <td><?= $position["value"] ?></td>
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