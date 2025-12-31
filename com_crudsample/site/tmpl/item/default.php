<?php defined('_JEXEC') or die; ?>

<div class="container mt-4">
    <div class="row justify-content-center">

        <div class="col-md-6">
            <div class="card shadow-sm">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <?= $this->item->id ? 'Edit Item' : 'Add Item'; ?>
                    </h4>
                </div>

                <div class="card-body">

                    <form action="index.php?option=com_crudsample&task=item.save"
                          method="post"
                          name="adminForm"
                          id="adminForm">

                        <div class="mb-3">
                            <?= $this->form->renderField('title'); ?>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="index.php?option=com_crudsample"
                               class="btn btn-secondary">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn btn-primary">
                                Save
                            </button>
                        </div>

                        <?= \Joomla\CMS\HTML\HTMLHelper::_('form.token'); ?>
                    </form>

                </div>

            </div>
        </div>

    </div>
</div>
