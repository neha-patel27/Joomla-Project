<?php defined('_JEXEC') or die; ?>

<div class="container mt-4">
    <div class="mb-3">
        <a class="btn btn-primary" href="index.php?option=com_crudsample&task=item.add">Add</a>
<a class="btn btn-success" href="index.php?option=com_crudsample&task=export.csv">Export</a>
        <a class="btn btn-secondary" href="index.php?option=com_crudsample&view=import">Import</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Title</th>
                <th width="220">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($this->items as $item) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= htmlspecialchars($item->title); ?></td>
                    <td>
                        <a href="<?= \Joomla\CMS\Router\Route::_(
                            'index.php?option=com_crudsample&view=item&id=' . $item->id,
                            false
                        ); ?>" class="btn btn-sm btn-primary">
                            Edit
                        </a>

                        <a href="<?= \Joomla\CMS\Router\Route::_(
                            'index.php?option=com_crudsample&task=item.delete&id=' . $item->id . '&' .
                            \Joomla\CMS\HTML\HTMLHelper::_('form.token')
                        ); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
    <?php if (isset($this->pagination)) : ?>
        <?= $this->pagination->getPagesLinks(); ?>
        <div class="counter">
            <?= $this->pagination->getPagesCounter(); ?>
        </div>
    <?php endif; ?>
</div>
</div>
