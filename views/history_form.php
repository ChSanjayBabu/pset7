
<table>
    <tr>
        <th STYLE="Padding: 10px;"><?= "symbol" ?></th>
        <th STYLE="Padding: 10px;"><?= "shares" ?></th>
        <th STYLE="padding :10px;"><?= "stock" ?></th>
        <th STYLE="Padding: 10px;"><?= "price" ?></th>
        <th STYLE="Padding: 30px;"><?= "date" ?></th>
        <th STYLE="Padding: 30px;"><?= "time" ?></th>
    </tr>   
    <?php foreach ($values as $value): ?>

        <tr>
            <td><?= $value["symbol"] ?></td>
            <td><?= $value["shares"] ?></td>
            <td><?= $value["stock"] ?></td>
            <td><?= $value["price"] ?></td>
            <td><?= $value["date"] ?></td>
            <td><?= $value["time"] ?></td>
        </tr>

    <?php endforeach ?>
</table>