<?php defined('_JEXEC') or die; ?>

<form method="post"
      action="index.php?option=com_crudsample&task=item.save">

    <input type="hidden" name="id" value="<?= (int) $id ?>">

    <div class="mb-2">
        <input type="text"
               name="title"
               class="form-control"
               placeholder="Enter title">
    </div>

    <button type="submit" class="btn btn-success btn-sm">
        Save
    </button>

    <?= \Joomla\CMS\HTML\HTMLHelper::_('form.token'); ?>
</form>
