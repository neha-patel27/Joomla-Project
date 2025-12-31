<form method="post" enctype="multipart/form-data"
      action="index.php?option=com_crudsample&task=import.upload"
      class="container mt-4">

    <h3>Import CSV</h3>

    <input type="file" name="csv_file" class="form-control mb-3" required>

    <button class="btn btn-success">Upload</button>

    <?= \Joomla\CMS\HTML\HTMLHelper::_('form.token'); ?>
</form>
