<table class="table table-bordered table-condensed table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Pais</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_POST['value'] as $value): ?>
            <tr>
                <td class="col-md-1">
                    <input type="checkbox" 
                        name="id_<?= $value['grandparent_id'] ?>[]" 
                        value="<?= $value['id'] ?>" 
                        class="parents-<?= $value['grandparent_id'] ?>">
                        <?= $value['id'] ?>
                </td>
                <td>
                    <?= $value['name'] ?>   
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div style="color: blue" id="respost-<?= $_POST['value'][0]['grandparent_id'] ?>"></div>
<div id="sons"></div>

<script>
var grandparent_id = 
        <?php echo isset($_POST['value'][0]['grandparent_id']) ? $_POST['value'][0]['grandparent_id']:0 ?>;
    $(".parents-"+grandparent_id).click(function () {

        var parents_ids = 0;
        var age = [];
        
        var sons = [
             {id:10, name:"Flavia"},
             {id:5, name:"Georgia"}, 
             {id:3, name:"Marcia"},
             {id:14, name:"Marta"}, 
             {id:13, name:"Mario"}, 
             {id:15, name:"Joana"},
             {id:9, name:"Jose"}, 
             {id:7, name:"Julia"},

        ];

        var parents_selects = [];
        $(".parents-"+grandparent_id+":checked").each(function () {
            parents_selects.push($(this).val());

        });
        if(parents_selects.length === 2){
             $("#respost-"+grandparent_id).html('');

            parents_ids = parseInt(parents_selects[0]) + parseInt(parents_selects[1]);
            age[parents_ids] = parents_ids + parseInt(grandparent_id);
            result = sons.filter(function (sons) { return sons.id === parents_ids });
            if(result.length > 0){
                $.post(
                    "descendants/sons_list.php",
                    {value:result,age:age},
                    function (value) {
                        $("#grandparent-parents-sons-"+ grandparent_id).html(value);
                    }
                );
            }else{
                $("#respost-"+ grandparent_id).html('');
                $("#grandparent-parents-sons-"+ grandparent_id).html('Sem descendentes...');
            }
        }
        else if(parents_selects.length < 2){
            $("#respost-"+ grandparent_id).html('Selecione dois pais');
            $("#grandparent-parents-sons-"+ grandparent_id).html('');
        }else{
            $("#respost-"+ grandparent_id).html('Selecione apenas dois pais');
            $("#grandparent-parents-sons-"+ grandparent_id).html('');
        }

    });

  unset(grandparent_id);
</script>