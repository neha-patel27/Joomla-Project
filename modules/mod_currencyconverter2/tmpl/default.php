<?php defined('_JEXEC') or die;

$moduleId = 'currency-converter-' . $module->id;
?>

<div id="<?= $moduleId ?>" class="currency-converter border p-3 rounded">

    <input type="number" class="amount form-control mb-2"
           value="<?= $defaultAmount ?>" step="0.01">

    <label>From</label>
    <select class="from form-control mb-2">
        <?php foreach ($rates as $code => $rate) : ?>
            <option value="<?= $rate ?>" <?= $code === $defaultFrom ? 'selected' : '' ?>>
                <?= $code ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>To</label>
    <select class="to form-control mb-2">
        <?php foreach ($rates as $code => $rate) : ?>
            <option value="<?= $rate ?>" <?= $code === $defaultTo ? 'selected' : '' ?>>
                <?= $code ?>
            </option>
        <?php endforeach; ?>
    </select>

    <div class="mt-2">
        Result: <strong><span class="result">0</span></strong>
    </div>
</div>

<script>
(function () {

    const container = document.getElementById('<?= $moduleId ?>');

    if (!container) return;

    const amount = container.querySelector('.amount');
    const from   = container.querySelector('.from');
    const to     = container.querySelector('.to');
    const result = container.querySelector('.result');

    function convertCurrency() {
        let amt = parseFloat(amount.value) || 0;
        let fromRate = parseFloat(from.value);
        let toRate   = parseFloat(to.value);

        let converted = (amt / fromRate) * toRate;
        result.innerText = converted.toFixed(2);
    }

    container.addEventListener('input', convertCurrency);
    convertCurrency();

})();
</script>
