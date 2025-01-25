<?php

namespace App\Services;

use App\Interfaces\CartInterface;

class CartServiceWrapper implements CartInterface
{
    protected $cart;

    public function __construct()
    {
        $this->cart = \Config\Services::cart();
    }

    public function addItem(array $data)
    {
        $this->cart->insert($data);
    }

    public function updateItem(array $data)
    {
        $this->cart->update($data);
    }

    public function totalItems()
    {
        return $this->cart->totalItems();
    }

    public function remove($rowid)
    {
        $this->cart->remove($rowid);
    }

    public function destroy()
    {
        $this->cart->destroy();
    }

    public function contents()
    {
        return $this->cart->contents();
    }

    public function totalPrice()
    {
        return $this->cart->total();
    }

    public function totalProducts()
    {
        $contents = $this->cart->contents();
        return count($contents);
    }
}
