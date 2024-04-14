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

    public function createProduct($product)
    {
        return $this->repository->createProduct($product);
    }

    public function getProductById($id)
    {
        return $this->repository->getProductById($id);
    }

    public function updateProduct($id, $product)
    {
        return $this->repository->updateProduct($id, $product);
    }
}