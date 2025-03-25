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
            $clients = Client::getAll($this->pdo);
            require_once '../app/Views/clients/index.php';
        }

        public function show($id)
        {
            $client = Client::getById($this->pdo, $id);
            require_once '../app/Views/clients/show.php';
        }

        public function edit($id)
        {
            // $client = Client::getById($id);
            // require_once '../app/Views/clients/edit.php';
        }

        public function create()
        {
            // require_once '../app/Views/clients/create.php';
        }
    }