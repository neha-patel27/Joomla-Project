<?php
defined('_JEXEC') or die;
use Joomla\CMS\Router\Route;

?>

<h2>CRUD Sample Component</h2>

<form action="<?php echo Route::_('index.php?option=com_crudsample&task=crud.import'); ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="csv_file" required>
    <button type="submit">Import CSV</button>
</form>

<a href="<?php echo Route::_('index.php?option=com_crudsample&task=crud.export'); ?>">Export CSV</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->items as $item): ?>
        <tr>
            <td><?php echo $item->id; ?></td>
            <td><?php echo $item->name; ?></td>
            <td><?php echo $item->email; ?></td>
            <td><?php echo $item->phone; ?></td>
            <td>
                <a href="<?php echo Route::_('index.php?option=com_crudsample&task=crud.delete&id=' . $item->id); ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
