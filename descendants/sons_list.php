
<table class="table table-bordered table-condensed table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Filho</th>
            <th>Idade</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_POST['value'] as $value): ?>
            <tr>
                <td class="col-md-1">
                    <?= $value['id'] ?>   
                </td>
                <td>
                    <?= $value['name'] ?>   
                </td>
                <td>
                    <?= $_POST['age'][$value['id']] + $value['id'] ?>  
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
