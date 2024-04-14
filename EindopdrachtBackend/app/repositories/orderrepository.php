<?php

namespace Repositories;

use Models\Order;
use PDO;
use PDOException;
use Repositories\Repository;

class OrderRepository extends Repository
{
    public function createOrder($order)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO orders (user_id) VALUES (:user_id)");
            $stmt->bindParam(':user_id', $order->user_id);
            $stmt->execute();
            
            $orderId = $this->connection->lastInsertId();

            return $this->getOrderById($orderId);
        } catch (PDOException $e) {
            error_log('Error creating order: ' . $e->getMessage());
            throw new \Exception('Error creating order');
        }
    }

    public function getOrderById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM orders WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $orderData = $stmt->fetch(PDO::FETCH_ASSOC);

            return $orderData;
        } catch (PDOException $e) {
            error_log('Error fetching order: ' . $e->getMessage());
            throw new \Exception('Error fetching order');
        }
    }

    public function getOrdersByUserId($userId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM orders WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, Order::class);
        } catch (PDOException $e) {
            error_log('Error getting orders: ' . $e->getMessage());
            throw new \Exception('Error getting orders');
        }
    }
}