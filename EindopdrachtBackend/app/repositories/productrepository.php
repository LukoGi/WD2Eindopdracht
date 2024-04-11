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
}
