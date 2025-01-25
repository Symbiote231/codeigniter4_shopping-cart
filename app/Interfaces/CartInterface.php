<?php

namespace App\Interfaces;

interface CartInterface
{
    public function addItem(array $data);

    public function updateItem(array $data);

    public function totalItems();

    public function remove($rowid);

    public function destroy();

    public function contents();

    public function totalPrice();

    public function totalProducts();
}
