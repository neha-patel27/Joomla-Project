<?php defined('_JEXEC') or die; ?>

<form method="post">
    <label>Title</label><br>
    <input type="text" name="jform[title]"
           value="<?= $this->item->title ?? '' ?>"><br><br>

    <button type="submit">Save</button>
    <input type="hidden" name="task" value="item.save">
    <?php echo \Joomla\CMS\HTML\HTMLHelper::_('form.token'); ?>
</form>
