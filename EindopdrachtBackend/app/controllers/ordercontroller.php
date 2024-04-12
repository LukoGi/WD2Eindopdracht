<?php

namespace Controllers;

use Exception;
use Services\OrderService;
use Models\Order;

class OrderController extends Controller
{
    private $service;

    // initialize services
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
}
