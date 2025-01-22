<?php

namespace App\Controllers;

class CartController extends BaseController
{
    public function index()
    {
        // Get the cart service
        $cart = \Config\Services::cart();
        $data = [
            'title' => 'Shopping Cart',
            'cart_contents' => $cart->contents(),
        ];
    
        // Pass title and cart contents to the view
        return view('cart_view', $data);
    }

    public function add()
    {
        $cart = \Config\Services::cart();

        // Add validation rules
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id'      => 'required',
            'name'    => 'required',
            'price'   => 'required|decimal',
            'qty'     => 'required|integer|greater_than[0]',
            'options' => 'permit_empty|valid_json',
        ]);

        // Check if required data exists
        if (!$this->validate($validation->getRules())) {
            return redirect()->to('/cart/add')->withInput()->with('error', $validation->listErrors());
        }

        // Get form data
        $productData = [
            'id'      => $this->request->getPost('id'),
            'qty'     => (int)$this->request->getPost('qty'),
            'price'   => $this->request->getPost('price'),
            'name'    => $this->request->getPost('name'),
            'options' => json_decode($this->request->getPost('options'), true) ?? []
        ];

        // Add the item to the cart
        $cart->insert($productData);

        session()->setFlashdata('success', 'Item added to the cart successfully!');
        return redirect()->to('/cart');
    }

    public function update()
    {
        $cart = \Config\Services::cart();

        // Get the rowid and qty from the request
        $rowid = $this->request->getPost('rowid');
        $qty = (int) $this->request->getPost('qty');

        // Validate quantity
        if ($qty <= 0) {
            session()->setFlashdata('error', 'Quantity must be greater than 0!');
            return redirect()->to('/cart');
        }

        if ($rowid && $qty) {
            // Update cart item
            $cart->update([
                'rowid' => $rowid,
                'qty'   => $qty,
            ]);

            session()->setFlashdata('success', 'Cart updated successfully!');
        }

        return redirect()->to('/cart');
    }

    public function remove($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);

        session()->setFlashdata('success', 'Item removed from the cart!');
        return redirect()->to('/cart');
    }

    public function clear()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();

        session()->setFlashdata('success', 'Cart cleared!');
        return redirect()->to('/cart');
    }

    public function showAddForm()
    {
        $data = [
            'title' => 'Add to Cart',
        ];
    
        // Pass title to the view
        return view('cart_add');
    }
}
