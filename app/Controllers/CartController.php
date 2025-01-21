<?php

namespace App\Controllers;

class CartController extends BaseController
{
    public function index()
    {
        // Get the cart service
        $cart = \Config\Services::cart();

        // Insert a product into the cart
        $cart->insert([
            'id'      => 'sku_1234ABCD',
            'qty'     => 1,
            'price'   => '19.56',
            'name'    => 'T-Shirt',
            'options' => ['Size' => 'L', 'Color' => 'Red']
        ]);

        // Pass cart contents to the view
        return view('cart_view', ['cart_contents' => $cart->contents()]);
    }

    public function update()
    {
        $cart = \Config\Services::cart();
        
        // Get the rowid and qty from the request
        $rowid = $this->request->getVar('rowid');
        $qty = (int)$this->request->getVar('qty');
        
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
            
            // Set flashdata success message
            session()->setFlashdata('success', 'Cart updated successfully!');
        }
        
        return redirect()->to('/cart');
    }    


    public function remove($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);

        return redirect()->to('/cart');
    }

    public function clear()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();

        return redirect()->to('/cart');
    }
}
