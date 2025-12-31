<?php defined('_JEXEC') or die; ?>

<h2>CRUD Sample</h2>

<a href="index.php?option=com_crudsample&task=item.add">Add New</a> |
<a href="index.php?option=com_crudsample&task=export.csv">Export CSV</a>

<form method="post"
      enctype="multipart/form-data"
      action="index.php?option=com_crudsample&task=import.csv">

    <input type="file" name="csv" required>
    <button type="submit">Import CSV</button>

    <?php echo \Joomla\CMS\HTML\HTMLHelper::_('form.token'); ?>
</form>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Title</th>
</tr>

<?php foreach ($this->items as $item): ?>
<tr>
    <td><?= $item->id ?></td>
    <td><?= $item->title ?></td>
</tr>
<?php endforeach; ?>
</table>
