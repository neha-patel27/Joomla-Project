<?php defined('_JEXEC') or die; ?>

<div class="city-temp-module">

    <h4>City Temperature</h4>

    <!-- City Change Form -->
    <form method="post">
        <input 
            type="text" 
            name="city" 
            value="<?php echo htmlspecialchars($city); ?>" 
            placeholder="Enter city"
        />
        <button type="submit">Check Weather</button>
    </form>

    <hr>

    <?php if ($data) : ?>
        <h3><?php echo htmlspecialchars($data['city']); ?></h3>
        <p><strong><?php echo $data['temperature']; ?>°C</strong></p>
        <p><?php echo htmlspecialchars($data['description']); ?></p>
    <?php else : ?>
        <p>Weather data not available.</p>
    <?php endif; ?>

</div>
