<?php
namespace Services;

use Repositories\ProductRepository;

class ProductService {

    private $repository;

    function __construct()
    {
        $this->repository = new ProductRepository();
    }

    public function getAllProducts() {
        return $this->repository->getAllProducts();
    }

    public function deleteProduct($id) {
        $this->repository->deleteProduct($id);
    }
}