<?php
use App\Library\App;
$app = App::getInstance();
$base_url = $app->get('base_url') ?? '';
?>
<div class="breadcrumbs">
    <a href="<?= $base_url ?>/">Home</a> > <a href="<?= $base_url ?>/data/?server=<?= htmlspecialchars($requestServer, ENT_QUOTES) ?>">Data</a> > <?= htmlspecialchars($key) ?>
</div>

<?php if (isset($data)) : ?>
    <table border="1">
        <tr>
            <td>Key:</td>
            <td><?= htmlspecialchars($key) ?></td>
        </tr>
        <tr>
            <td>Data:</td>
            <td><?= htmlspecialchars($data) ?></td>
        </tr>
    </table>

<?php endif ?>
