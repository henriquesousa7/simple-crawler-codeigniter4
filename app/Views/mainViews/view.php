<div class="text-center">
    <h2>Cursos PHP - Alura</h2>
    <a href="/cursos" class="btn btn-primary">Retornar para pagina inicial</a>
    <a href="/cursos/exportCSV" class="btn btn-primary">Exportar para arquivo CSV</a>
    <table class="table">
        <tr>
            <th>Nome</th>
        </tr>
        <?php foreach ($cursos as $curso):?>
            <tr>
                <td><?php echo $curso['nome'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>