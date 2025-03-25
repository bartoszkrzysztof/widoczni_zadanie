<?php
    require_once __DIR__ . '/../Models/Client.php';

    class ClientController
    {
        private $pdo;
        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function index()
        {
            $clients = Client::getAllClients($this->pdo);
            require_once '../app/Views/clients/index.php';
        }

        public function show($id)
        {
            $client = Client::getClientById($this->pdo, $id);
            require_once '../app/Views/clients/show.php';
        }


        public function edit($id)
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $city = $_POST['city'];
                $postal_code = $_POST['postal_code'];
                $country = $_POST['country'];
                $action = $_POST['action'];
    
                if ($action === 'update_client') {
                    $results = Client::updateClient($this->pdo, $id, $name, $email, $phone, $address, $city, $postal_code, $country);
                }
                elseif ($action === 'delete_client') {
                    $results = Client::deleteClient($this->pdo, $id);
    
                    if (isset($results['status']) && $results['status'] === 'success') {
                        header('Location: /client');
                    }
                }
            }
            
            $client = Client::getClientById($this->pdo, $id);
            require_once '../app/Views/clients/edit.php';
        }
    
        public function create()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $city = $_POST['city'];
                $postal_code = $_POST['postal_code'];
                $country = $_POST['country'];
                $action = $_POST['action'];
    
                if ($action === 'create_client') {
                    $results = Client::createClient($this->pdo, $name, $email, $phone, $address, $city, $postal_code, $country);
    
                    if (isset($results['id']) && $results['id']) {
                        header('Location: /client/edit/' . $results['id']);
                    }
                }
            }
            
            require_once '../app/Views/clients/create.php';
        }
    }