<?php
namespace Services;

use Repositories\OrderItemRepository;

class OrderItemService {

    private $repository;

    function __construct()
    {
        $this->repository = new OrderItemRepository();
    }

    public function createOrderItem($orderItem) {
        return $this->repository->createOrderItem($orderItem);
    }
}