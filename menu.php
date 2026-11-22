<?php
$menu = [
    'M1' => ['name' => 'Chicken Adobo Meal', 'price' => 85.00, 'is_food' => true],
    'M2' => ['name' => 'Pork Sisig Meal', 'price' => 100.00, 'is_food' => true],
    'M3' => ['name' => 'Vegetable Meal', 'price' => 70.00, 'is_food' => true],
    'M4' => ['name' => 'Bicol Express Meal', 'price' => 95.00, 'is_food' => true],
    'D1' => ['name' => 'Bottled Water', 'price' => 20.00, 'is_food' => false],
    'D2' => ['name' => 'Iced Tea', 'price' => 35.00, 'is_food' => false],
    'D3' => ['name' => 'Soft Drink', 'price' => 30.00, 'is_food' => false],
    'S1' => ['name' => 'Nachos', 'price' => 50.00, 'is_food' => true]

];
?>

<h2>Available Menu</h2>
<table>
    <tr>
        <th>Code</th>
        <th>Product</th>
        <th>Price</th>
    </tr>
    <?php foreach ($menu as $code => $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($code); ?></td>
            <td><?php echo htmlspecialchars($item['name']); ?></td>
            <td>₱<?php echo number_format($item['price'], 2); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
