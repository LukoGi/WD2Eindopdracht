<?php

namespace Controllers;

use Exception;
use Services\OrderService;
use Models\Order;

class OrderController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new OrderService();
    }

    public function createOrder()
    {
        try {
            $order = $this->createObjectFromPostedJson(Order::class);
            $createdOrder = $this->service->createOrder($order);
            $this->respond($createdOrder);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->respondWithError(500, "An error occurred while creating order");
        }
    }

    public function getOrdersByUserId($userId)
    {
        try {
            $decoded = $this->checkForJwt();

            if ((string) $decoded->data->userId !== (string) $userId) {
                $this->respondWithError(403, "You are not authorized to view these orders");
                return;
            }

            $orders = $this->service->getOrdersByUserId($userId);

            $this->respond($orders);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->respondWithError(500, "An error occurred while retrieving orders");
        }
    }
}
