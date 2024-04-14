<?php

namespace Repositories;

use Models\OrderItem;
use PDO;
use PDOException;
use Repositories\Repository;

class OrderItemRepository extends Repository
{
    public function createOrderItem($orderItem)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO order_items (order_id, product_id) VALUES (:order_id, :product_id)");
            $stmt->bindParam(':order_id', $orderItem->order_id);
            $stmt->bindParam(':product_id', $orderItem->product_id);
            $stmt->execute();
            
            $orderItemId = $this->connection->lastInsertId();

            return $this->getOrderItemById($orderItemId);
        } catch (PDOException $e) {
            error_log('Error creating order item: ' . $e->getMessage());
            throw new \Exception('Error creating order item');
        }
    }

    public function getOrderItemById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM order_items WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $orderItemData = $stmt->fetch(PDO::FETCH_ASSOC);

            return $orderItemData;
        } catch (PDOException $e) {
            error_log('Error fetching order item: ' . $e->getMessage());
            throw new \Exception('Error fetching order item');
        }
    }

    public function getOrderItemsByOrderId($orderId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM order_items WHERE order_id = :order_id");
            $stmt->bindParam(':order_id', $orderId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, OrderItem::class);
        } catch (PDOException $e) {
            error_log('Error getting order items: ' . $e->getMessage());
            throw new \Exception('Error getting order items');
        }
    }
}