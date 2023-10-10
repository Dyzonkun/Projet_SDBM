<table class="">
    <thead>
        <tr>
            <th>ID</th>
            <th>Continent</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($continents as $continent): ?>
            <tr>
                <td><?= $continent['ID_CONTINENT'] ?></td>
                <td><?= $continent['NOM_CONTINENT'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

