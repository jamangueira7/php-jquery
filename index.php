<html lang="pt-br">
    <head>
        <link href="front/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>

            <?php
        $grandparents = array(
            1 => array('id' => 1, 'name' => 'Anselmo'),
            2 => array('id' => 2, 'name' => 'Joao'),
            3 => array('id' => 3, 'name' => 'Antonio')
        );

        ?>
        <h2>Lista            Familiar</h2>

        <div id="container">
            <div id="grandparent">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Avô</th>
                        <th>Pais</th>
                        <th>Filhos</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($grandparents as $grandparent): ?>
                        <tr>
                            <td class="col-md-1">
                                    <input type="radio" 
                                    id="grandparent-<?= $grandparent['id'] ?>" 
                                    name="grandparent" 
                                    onclick='parents(<?= $grandparent['id'] ?>)'> 
                                    <?= $grandparent['id'] ?>
                            </td>
                            <td>
                                <?= $grandparent['name'] ?>   
                            </td>
                            <td class="grandparent-parents" 
                            id="grandparent-parents-<?=$grandparent['id']?>"></td>
                            <td class="grandparent-parents-sons"
                            id="grandparent-parents-sons-<?=$grandparent['id']?>"></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div id="parents"></div>
        </div>
    </body>
</html>

<script src="front/js/jquery.js"></script>

<script>
    //GRANDPARENTS
    function parents(id) {
		$(".grandparent-parents").html('');
        $(".grandparent-parents-sons").html('');

        if ($('#grandparent-'+id).prop('checked')) {
            var parents = [
                    {id:1, name:"Marcos", grandparent_id:1}, 
                    {id:2, name:"George", grandparent_id:1}, 
                    {id:3, name:"Marcio", grandparent_id:1},
                    {id:4, name:"Maria", grandparent_id:2}, 
                    {id:5, name:"Jose", grandparent_id:2}, 
                    {id:6, name:"Joao", grandparent_id:2},
                    {id:7, name:"Flavio", grandparent_id:2},
                    {id:8, name:"Julia", grandparent_id:3},
            ];
            result = parents.filter(function (parents) { return parents.grandparent_id === id });

            $.post(
                "descendants/parents_list.php",
                {value:result,grandparent_id:id},
                function (value) {
                    $("#grandparent-parents-"+id).html(value);

                }
                );
        }
        else{
            $("#grandparent-parents-"+ id).html('');
            $("#grandparent-parents-sons-"+ id).html('');
        }

    }

</script>