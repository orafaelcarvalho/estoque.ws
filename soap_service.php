<?php
class Product {
    public $name;
    public $price;
    public $distributionCenter;
    public $quantityAvailable;

    public function __construct($name, $price, $distributionCenter, $quantityAvailable) {
        $this->name = $name;
        $this->price = $price;
        $this->distributionCenter = $distributionCenter;
        $this->quantityAvailable = $quantityAvailable;
    }
}

class ProductService {
    public function getProducts() {
        $products = array();

        $numProducts = rand(40, 50);

        for ($i = 1; $i <= $numProducts; $i++) {
            $name = "Produto " . $i;
            $price = rand(1000, 20000) / 100;
            $distributionCenter = rand(1, 3);
            $quantityAvailable = rand(0, 5);
        
            $products[] = new Product($name, $price, $distributionCenter, $quantityAvailable);
        }

        error_log("Retornou um total de ".count($products)." produtos");
        error_log("Produtos: ".json_encode($products));

        return $products;
    }
}

$options = array('uri' => 'http://localhost/estoque.ws');

$options['soap_version'] = SOAP_1_2;
$options['uri'] .= '/soap_service.php';

$server = new SoapServer(null, $options);

$server->setClass('ProductService');

error_log("Servidor SOAP iniciado");

$server->handle();
?>