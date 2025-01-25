<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Interfaces\CartInterface;

class CartDao extends Model implements CartInterface
{
    // protected $db;
    protected $table = 'cart_items';
    protected $primaryKey = 'rowid';
    protected $allowedFields = ['rowid', 'id', 'qty', 'price', 'name', 'options', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    private $cartContents;
    private $myLogger;

    public function __construct()
    {
        parent::__construct(); // This ensures the Model class's constructor is called ensuring automatic DB connection
        $this->myLogger = service('logger'); // Initialize logger here
        // $this->db = \Config\Database::connect(); // Manually connect to  DB here if not using Model construct, needs protected $db property
    }

    // Validate connection to DB is successful
    public function isConnected(): bool
    {
        try {
            // Simple query to check database connection
            $this->db->query('SELECT 1');
            log_message('debug', 'Database connection succeeded');
            $this->myLogger->debug('Database connection succeeded');
            return true;
        } catch (\Exception $e) {
            log_message('error', 'Database connection failed: ' . $e->getMessage());
            $this->myLogger->error('Database connection failed: ' . $e->getMessage());
            return false;
        }
    }
    
    // Add a product to the cart
    public function addItem(array $data)
    {
        $data['options'] = json_encode($data['options']);
        $this->insert($data); // Insert items into DB
        // \Config\Services::cart()->insert($data); // Call cart service
    }

    // Update a product in the cart
    public function updateItem(array $data)
    {
        $this->update($data['rowid'], $data); // Update item in DB
        // \Config\Services::cart()->update($data); // Update cart service
    }

    // Remove a product from the cart
    public function remove($rowid)
    {
        $this->delete($rowid); // Remove item from DB
        // \Config\Services::cart()->remove($rowid); // Remove from cart service
    }

    // Clear the cart
    public function destroy()
    {
        $this->truncate(); // Clear all items from DB
        // \Config\Services::cart()->destroy(); // Destroy cart session
    }

    // Get cart contents
    public function contents()
    {
        $this->cartContents = $this->findAll(); // Retrieve all items from DB
    
        // Add subtotal calculation
        foreach ($this->cartContents as &$item) {
            $item['subtotal'] = $this->getSubtotal($item);
        }
        return $this->cartContents; // Return array with subtotal property calculated
    }

    // Calculate item subtotal
    public function getSubtotal($item)
    {
        return $item['qty'] * $item['price'];
    }

    // Get total count of items in cart
    public function totalItems()
    {
        $totalItems = 0;

        foreach ($this->cartContents as &$item) {
            $totalItems += $item['qty'];
        }

        return $totalItems; // Return the total count of items in cart
    }

    // Get total price from all items in cart
    public function totalPrice()
    {
        $totalPrice = 0;

        foreach ($this->cartContents as &$item) {
            $totalPrice += $item['subtotal'];
        }

        return $totalPrice; // Return calculated total price
    }

    // Get total count of different items or products
    public function totalProducts()
    {
        return $this->countAllResults(); // Return the total count of different items or registers in DB
    }
}
