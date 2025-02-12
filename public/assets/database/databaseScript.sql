-- Create database if it doesn't already exist
CREATE DATABASE IF NOT EXISTS shopping_cart;

USE shopping_cart;

-- Create the cart_items table with utf8mb4 charset
CREATE TABLE IF NOT EXISTS cart_items (
    rowid INT AUTO_INCREMENT PRIMARY KEY, -- Database row identifier set as primary key
    id VARCHAR(255) NOT NULL, -- Product ID (string, up to 255 characters)
    name VARCHAR(255) NOT NULL, -- Product name
    price DECIMAL(10, 2) NOT NULL, -- Product price with two decimal places
    qty INT NOT NULL, -- Product quantity
    options JSON DEFAULT NULL, -- JSON field for additional options
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Creation timestamp
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Last update timestamp
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Optional index creation
CREATE INDEX IF NOT EXISTS idx_product_id ON cart_items(id);

-- Insert sample data into the cart_items table
INSERT INTO cart_items (id, name, price, qty, options) 
VALUES
('prod001', 'Product A', 19.99, 2, '{"Size": "M", "Color": "Red"}'),
('prod002', 'Product B', 29.99, 1, '{"Warranty": "1 year"}');

-- Create the shopping_user and grant all privileges
CREATE USER IF NOT EXISTS 'shopping_user'@'localhost' IDENTIFIED BY 'ShoppingPass';
GRANT ALL PRIVILEGES ON shopping_cart.* TO 'shopping_user'@'localhost';
FLUSH PRIVILEGES;
