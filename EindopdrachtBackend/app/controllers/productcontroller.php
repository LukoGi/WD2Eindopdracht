<?php

namespace Controllers;

use Exception;
use Services\ProductService;
use Models\Product;

class ProductController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->service = new ProductService();
    }

    public function getAllProducts()
    {
        try {
            $products = $this->service->getAllProducts();
   
            if (!$products) {
               $this->respondWithError(404, "Orders not found");
               return;
            }
   
            $this->respond($products);
         } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->respondWithError(500, "An error occurred while retrieving products");
         }
    }

    public function deleteProduct($id)
    {
        try {
            $decoded = $this->checkForJwt();

            if ($decoded->data->userId !== 1) {
                $this->respondWithError(403, "You are not authorized to delete products");
                return;
            }

            $this->service->deleteProduct($id);

            $this->respond(null, 200);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->respondWithError(500, "An error occurred while deleting product");
        }
    }

    public function createProduct()
    {
        try {
            $decoded = $this->checkForJwt();

            if ($decoded->data->userId !== 1) {
                $this->respondWithError(403, "You are not authorized to create products");
                return;
            }

            $product = $this->createObjectFromPostedJson(Product::class);

            $createdProduct = $this->service->createProduct($product);

            $this->respond($createdProduct);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->respondWithError(500, "An error occurred while creating product");
        }
    }

    public function getProductById($id)
    {
        try {
            $product = $this->service->getProductById($id);

            if (!$product) {
                $this->respondWithError(404, "Product not found");
                return;
            }

            $this->respond($product);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->respondWithError(500, "An error occurred while retrieving product");
        }
    }

    public function updateProduct($id)
    {
        try {
            $decoded = $this->checkForJwt();

            if ($decoded->data->userId !== 1) {
                $this->respondWithError(403, "You are not authorized to update products");
                return;
            }

            $product = $this->createObjectFromPostedJson(Product::class);

            $updatedProduct = $this->service->updateProduct($id, $product);

            $this->respond($updatedProduct);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->respondWithError(500, "An error occurred while updating product");
        }
    }
}
