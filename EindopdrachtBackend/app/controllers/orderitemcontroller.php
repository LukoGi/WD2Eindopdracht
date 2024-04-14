<?php

namespace Controllers;

use Exception;
use Services\OrderItemService;
use Models\OrderItem;

class OrderItemController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new OrderItemService();
    }

    public function createOrderItem()
    {
        try {
            $orderItem = $this->createObjectFromPostedJson(OrderItem::class);
            $createdOrderItem = $this->service->createOrderItem($orderItem);
            $this->respond($createdOrderItem);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->respondWithError(500, "An error occurred while creating order item");
        }
    }

    public function getOrderItemsByOrderId($orderId)
    {
        try {
            $orderItems = $this->service->getOrderItemsByOrderId($orderId);

            if (!$orderItems) {
                $this->respondWithError(404, "Order items not found");
                return;
            }

            $this->respond($orderItems);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->respondWithError(500, "An error occurred while retrieving order items");
        }
    }
}
