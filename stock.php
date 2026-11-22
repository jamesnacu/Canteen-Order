<?php

declare(strict_types=1);

//Available stocks for each products
$products = [
    'Chicken Adobo Meal' => [85.00, 8],
    'Pork Sisig Meal' => [100.00, 15],
    'Vegetable Meal' => [70.00, 6],
    'Bicol Express Meal' => [95.00, 12],
    'Bottled Water' => [20.00, 25],
    'Iced Tea' => [35.00, 9],
    'Nachos' => [50.00, 7],
    'Soft Drink' => [30.00, 18]
];

//Tax rate used for each products
$tax_rate = 12;

//Checks whether the stock is below the reorder level
function get_reorder_message(int $stock): string
{
    return $stock < 10 ? 'Yes' : 'No';
}

//Calculates the total value of the remaining stock
function get_total_value(float $price, int $quantity): float
{
    return $price * $quantity;
}

//Calculates the tax due when all remaining stock is sold
function get_tax_due(
    float $price,
    int $quantity,
    int $tax_rate = 0
): float {
    $total_value = $price * $quantity;
    $tax_percentage = $tax_rate / 100;

    return $total_value * $tax_percentage;
}

require_once 'header.php';
?>

<h2>Stock Monitoring</h2>
<p>Monitor the available stock, reorder status, total stock value, and estimated tax due.</p>

<table>
    <tr>
        <th>Product</th>
        <th>Stock</th>
        <th>Reorder?</th>
        <th>Total Value</th>
        <th>Tax Due</th>
    </tr>

    <?php foreach ($products as $product_name => $data): ?>
        <?php
        $price = $data[0];
        $quantity = $data[1];
        ?>
        <tr>
            <td>
                <?php echo htmlspecialchars($product_name, ENT_QUOTES, 'UTF-8'); ?>
            </td>
            <td>
                <?php echo $quantity; ?>
            </td>
            <td>
                <?php echo get_reorder_message($quantity); ?>
            </td>
            <td>
                ₱<?php echo number_format(
                    get_total_value($price, $quantity),
                    2
                ); ?>
            </td>
            <td>
                ₱<?php echo number_format(
                    get_tax_due($price, $quantity, $tax_rate),
                    2
                ); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<p>
    <strong>Tax Rate:</strong>
    <?php echo $tax_rate; ?>%
</p>

<p id = "backButton">
    <a href="index.php">Back to Order Form</a>
</p>

<?php require_once 'footer.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Stock Monitoring</title>
        <style>
            #backButton > a {
                color: #A00;
            }
        </style>
    </head>
</html>