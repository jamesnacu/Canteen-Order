<?php
// Name: Nacu, James P.
// Section: WD-201

require_once 'header.php';
include 'menu.php';
?>

<h2>Place Your Order</h2>
<p class="note">You may order more than one product. Enter 0 for products you do not want.</p>

<form method="POST" action="process.php">
    <label>Name</label>
    <input type="text" name="customer_name" required>

    <label>Customer Type</label>
    <select name="customer_type" required>
        <option value="student">Student</option>
        <option value="employee">Employee</option>
        <option value="guest">Guest</option>
    </select>

    <h3>Select Products and Quantities</h3>
    <?php foreach ($menu as $code => $item): ?>
        <label>
            <?php echo htmlspecialchars($item['name']); ?>
            (₱<?php echo number_format($item['price'], 2); ?>)
        </label>
        <input
            type="number"
            name="quantities[<?php echo htmlspecialchars($code); ?>]"
            min="0"
            max="10"
            value="0"
            required
        >
    <?php endforeach; ?>

    <label>Budget (PHP)</label>
    <input type="number" name="budget" min="0" step="0.01" required>

    <button type="submit">Process Order</button>
</form>

<?php require_once 'footer.php'; ?>
