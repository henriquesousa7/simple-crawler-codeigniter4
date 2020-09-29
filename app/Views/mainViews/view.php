<div class="text-center">
    <h2>Cursos PHP - Alura</h2>
    <a href="/cursos" class="btn btn-primary">Retornar para pagina inicial</a>
    <a href="/cursos/exportCSV" class="btn btn-primary">Exportar para arquivo CSV</a>

    <div id="well">
      	<input id="search" type="text" class="form-control" placeholder="Search">
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cursos as $curso):?>
                <tr>
                    <td><?php echo $curso['nome'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>

        function search_table(value){
            $('tbody tr').each(function(){
                var found = 'false';
                $(this).each(function(){
                    if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){
                        found = 'true';                    
                    }
                })
                if(found == 'true'){
                    $(this).show()
                }else{
                    $(this).hide()
                }
            })
        }

        $('#search').keyup(function(){
            search_table($(this).val());
            console.log($(this).val())
        })

    </script>
</div>