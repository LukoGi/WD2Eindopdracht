<?php

namespace Repositories;

use Models\Category;
use Models\Product;
use PDO;
use PDOException;
use Repositories\Repository;

class ProductRepository extends Repository
{
    function getAllProducts()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM products");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Product::class);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log('Error getting products: ' . $e->getMessage());
            throw new \Exception('Error getting products');
        }
    }

    public function deleteProduct($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM products WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error deleting product: ' . $e->getMessage());
            throw new \Exception('Error deleting product');
        }
    }

    public function createProduct($product)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO products (title, price, description, category, image) VALUES (:title, :price, :description, :category, :image)");
            $stmt->bindParam(':title', $product->title);
            $stmt->bindParam(':price', $product->price);
            $stmt->bindParam(':description', $product->description);
            $stmt->bindParam(':category', $product->category);
            $stmt->bindParam(':image', $product->image);
            $stmt->execute();

            $product->id = $this->connection->lastInsertId();

            return $product;
        } catch (PDOException $e) {
            error_log('Error creating product: ' . $e->getMessage());
            throw new \Exception('Error creating product');
        }
    }
}
