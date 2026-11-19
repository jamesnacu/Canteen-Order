<?php
//Won't open without submitting order.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

require_once 'menu.php';

//Get customers/users information
$name = trim($_POST['customer_name'] ?? '');
$type = $_POST['customer_type'] ?? '';
$budget = filter_var($_POST['budget'] ?? null, FILTER_VALIDATE_FLOAT);
$submittedQuantities = $_POST['quantities'] ?? [];

$valid = $name !== ''
    && in_array($type, ['student', 'employee', 'guest'], true)
    && $budget !== false
    && $budget !== null
    && $budget >= 0
    && is_finite($budget)
    && is_array($submittedQuantities);

$cart = [];
$subtotal = 0;
$foodSubtotal = 0;
$totalQuantity = 0;

//Loop that will check each menu item that are selected and add to the cart.
if ($valid) {
    foreach ($menu as $code => $item) {
        $quantity = filter_var(
            $submittedQuantities[$code] ?? 0,
            FILTER_VALIDATE_INT
        );

        if ($quantity === false || $quantity < 0 || $quantity > 10) {
            $valid = false;
            break;
        }

        if ($quantity > 0) {
            $lineTotal = $item['price'] * $quantity;

            $cart[] = [
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $quantity,
                'line_total' => $lineTotal,
                'is_food' => $item['is_food']
            ];

            $subtotal += $lineTotal;
            $totalQuantity += $quantity;

            if ($item['is_food']) {
                $foodSubtotal += $lineTotal;
            }
        }
    }
}

//Reject invalid orders
if (!$valid || count($cart) === 0) {
    require_once 'header.php';
    echo '<h2 class="error">Unable to Process Order</h2>';

    if (!$valid) {
        echo '<p class="error">Invalid information. Please check your name, customer type, quantities, and budget.</p>';
    } else {
        echo '<p class="error">Please select at least one product.</p>';
    }

    echo '<p><a href="index.php">Return to order form</a></p>';
    require_once 'footer.php';
    exit;
}

//Discount rate based on customer type
switch ($type) {
    case 'student':
        $discountRate = 0.10;
        break;
    case 'employee':
        $discountRate = 0.05;
        break;
    default:
        $discountRate = 0;
        break;
}

// Discount applies only to food products
$discount = $foodSubtotal * $discountRate;
$total = $subtotal - $discount;

require_once 'header.php';
?>

<h2>Order Receipt</h2>
<p><strong>Customer:</strong> <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></p>
<p><strong>Customer Type:</strong> <?php echo htmlspecialchars(ucfirst($type), ENT_QUOTES, 'UTF-8'); ?></p>

<h3>Items Ordered</h3>
<table>
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Subtotal</th>
    </tr>

    <?php foreach ($cart as $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td>₱<?php echo number_format($item['price'], 2); ?></td>
            <td>₱<?php echo number_format($item['line_total'], 2); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p><strong>Total Items:</strong> <?php echo $totalQuantity; ?></p>
<p><strong>Subtotal:</strong> ₱<?php echo number_format($subtotal, 2); ?></p>
<p><strong>Discount Rate:</strong> <?php echo number_format($discountRate * 100, 0); ?>%</p>
<p><strong>Discount Amount:</strong> ₱<?php echo number_format($discount, 2); ?></p>
<h2>Final Bill: ₱<?php echo number_format($total, 2); ?></h2>
<p><strong>Budget:</strong> ₱<?php echo number_format($budget, 2); ?></p>

<?php
//Compare customer's budget with the total bill of the order
if ($budget >= $total) {
    echo '<p class="success">Budget is sufficient!</p>';
    echo '<p>Change: ₱' . number_format($budget - $total, 2) . '</p>';
} else {
    echo '<p class="error">Insufficient budget!</p>';
    echo '<p>Additional amount needed: ₱' . number_format($total - $budget, 2) . '</p>';
}
?>

<h3>Preparation Progress</h3>
<?php
//display a preparation message for item ordered. 
$counter = 1;
while ($counter <= $totalQuantity) {
    echo '<p>Preparing item ' . $counter . ' of ' . $totalQuantity . '</p>';
    $counter++;
}
?>

<p><a href="index.php">Place another order</a></p>

<?php require_once 'footer.php'; ?>
