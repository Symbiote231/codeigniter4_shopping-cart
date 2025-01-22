<?= $this->extend('bootstrap_layout'); ?>

<?= $this->section('content'); ?>

<h1>Add Item to Cart</h1>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form action="<?= site_url('cart/add'); ?>" method="post" class="mt-4">
    <div class="mb-3">
        <label for="id" class="form-label">Product ID</label>
        <input type="text" name="id" id="id" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" name="price" id="price" class="form-control" required step="0.01">
    </div>
    <div class="mb-3">
        <label for="qty" class="form-label">Quantity</label>
        <input type="number" name="qty" id="qty" class="form-control" required min="1">
    </div>
    <div class="mb-3">
        <label for="options" class="form-label">Options (JSON)</label>
        <textarea name="options" id="options" class="form-control" rows="3"></textarea>
        <small class="form-text text-muted">Example: {"Size": "M", "Color": "Blue"}</small>
    </div>
    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>

<?= $this->endSection(); ?>
