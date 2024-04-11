<?php

namespace Controllers;

use Exception;
use Services\ProductService;

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
}
