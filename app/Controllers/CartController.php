<?php

namespace App\Controllers;

use App\Models\CartDao;
use App\Services\CartServiceWrapper;

class CartController extends BaseController
{
    private $cartDao;
    private $myLogger;

    public function __construct()
    {
        $this->myLogger = service('logger'); // Initialize logger here
        $cartDao = new CartDao();
        
        if ($cartDao->isConnected()) {
            $this->cartDao = $cartDao; // Use CartDao if the connection is successful
            log_message('debug', 'Initialized CartDao DB layer correctly');
            $this->myLogger->debug('Initialized CartDao DB layer correctly');
        } else {
            $this->cartDao = new CartServiceWrapper(); // If connection to DB failed fall back to default cart service
            log_message('error', 'Fallback cart service activated due to DB connection failure.');
            $this->myLogger->error('Fallback cart service activated due to DB connection failure.');
        }
    }

    
    public function index()
    {
        $data = [
            'title' => 'Shopping Cart',
            'cart_contents' => $this->cartDao->contents(),
            'totalProducts' => $this->cartDao->totalProducts(),
            'totalItems' => $this->cartDao->totalItems(),
            'totalPrice' => $this->cartDao->totalPrice(), // Pass total price to the view
        ];
    
        // Logging examples for complex variables:
        // $this->myLogger->debug('Item data print_r: ' . print_r($data, true));
        // $this->myLogger->debug('Item data json_encode: ' . json_encode($data));

        // Pass title and cart contents to the view
        return view('cart_view', $data);
    }

    public function add()
    {
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
            // return redirect()->to('/cart/add')->withInput()->with('error', $validation->listErrors()); Other way to pass the errors to the method
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('/cart/add')->withInput();
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
        $this->cartDao->addItem($productData);

        session()->setFlashdata('success', 'Item added to the cart successfully!');
        return redirect()->to('/cart');
    }

    public function update()
    {
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
            $this->cartDao->updateItem([
                'rowid' => $rowid,
                'qty'   => $qty,
            ]);

            session()->setFlashdata('success', 'Cart updated successfully!');
        }

        return redirect()->to('/cart');
    }

    public function remove($rowid)
    {
        $this->cartDao->remove($rowid);

        session()->setFlashdata('success', 'Item removed from the cart!');
        return redirect()->to('/cart');
    }

    public function clear()
    {
        $this->cartDao->destroy();

        session()->setFlashdata('success', 'Cart cleared!');
        return redirect()->to('/cart');
    }

    public function totalItems()
    {
        return $this->cartDao->totalItems();
    }

    public function totalPrice()
    {
        return $this->cartDao->totalPrice();
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
