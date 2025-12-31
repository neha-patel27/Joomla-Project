<?php defined('_JEXEC') or die; ?>

<div class="container mt-4">
    <h2 class="mb-3">Frontend CRUD Sample</h2>

    <div class="mb-3">
        <a class="btn btn-primary" href="index.php?option=com_crudsample&view=item">Add</a>
        <a class="btn btn-success" href="index.php?option=com_crudsample&task=export.csv">Export</a>
        <a class="btn btn-secondary" href="index.php?option=com_crudsample&view=import">Import</a>
    </div>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($this->items as $item): ?>
            <tr>
                <td><?= $item->id ?></td>
                <td><?= $item->title ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
