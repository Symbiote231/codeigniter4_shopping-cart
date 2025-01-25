<?= $this->extend('bootstrap_layout'); ?>

<?= $this->section('content'); ?>

<h1>Your Shopping Cart</h1>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (!empty($cart_contents)): ?>
        <table class="table table-bordered mt-4">
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
                        <form action="<?= site_url('cart/update'); ?>" method="post">
                            <td><?= esc($item['name']); ?></td>
                            <td>
                                <input type="number" name="qty" value="<?= esc($item['qty']); ?>" min="1" class="form-control" style="width: 80px; display: inline-block;">
                                <input type="hidden" name="rowid" value="<?= esc($item['rowid']); ?>" />
                            </td>
                            <td>$<?= esc(number_format($item['price'], 2)); ?></td>
                            <td>$<?= esc(number_format($item['subtotal'], 2)); ?></td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                <a href="<?= site_url('cart/remove/' . $item['rowid']); ?>" class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <div class="mt-4">
        <p><strong>Total Products:</strong> <?= esc($totalProducts) ?></p>
        <p><strong>Total Items:</strong> <?= esc($totalItems) ?></p>
        <p><strong>Total Price:</strong> $<?= number_format(esc($totalPrice), 2) ?></p>
    </div>
    <a href="<?= site_url('cart/clear'); ?>" class="btn btn-warning">Clear Cart</a>

<?php else: ?>
    <p class="text-muted">Your cart is empty. <a href="<?= site_url('cart/add'); ?>">Add items to your cart</a>.</p>
<?php endif; ?>

<?= $this->endSection(); ?>
