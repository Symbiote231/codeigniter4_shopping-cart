<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
</head>
<body>

<h1>Your Shopping Cart</h1>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color: green;"><?= session()->getFlashdata('success'); ?></p>
<?php endif; ?>

<form action="<?= site_url('cart/update'); ?>" method="post">
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart_contents as $item): ?>
                <tr>
                    <td><?= esc($item['name']); ?></td>
                    <td>
                        <input type="number" name="qty" value="<?= esc($item['qty']); ?>" min="1" />
                        <input type="hidden" name="rowid" value="<?= esc($item['rowid']); ?>" />
                    </td>
                    <td><?= esc($item['price']); ?></td>
                    <td><?= esc($item['subtotal']); ?></td>
                    <td>
                        <button type="submit">Update</button>
                    </td>
                    <td>
                        <a href="<?= site_url('cart/remove/' . $item['rowid']); ?>">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>

<p><a href="<?= site_url('cart/clear'); ?>">Clear Cart</a></p>

<p>Total Items: <?= esc(\Config\Services::cart()->totalItems()); ?></p>
<p>Total Price: <?= esc(\Config\Services::cart()->total()); ?></p>

</body>
</html>
