<?php
    require_once __DIR__ . '/../Models/Package.php';

    class PackageController
    {
        private $pdo;
        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function index()
        {
            $packages = Package::getAllPackages($this->pdo);
            require_once '../app/Views/package/index.php';
        }

        public function edit($id)
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $action = $_POST['action'];

                if ($action === 'update_package') {
                    $results = Package::updatePackage($this->pdo, $id, $name, $description);
                }
                elseif ($action === 'delete_package') {
                    $results = Package::deletePackage($this->pdo, $id);

                    if (isset($results['status']) && $results['status'] === 'success') {
                        header('Location: /package');
                    }
                }
            }
            
            $package = Package::getPackageById($this->pdo, $id);
            require_once '../app/Views/package/edit.php';
        }

        public function create()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $action = $_POST['action'];

                if ($action === 'create_package') {
                    $results = Package::createPackage($this->pdo, $name, $description);

                    if (isset($results['id']) && $results['id']) {
                        header('Location: /package/edit/' . $results['id']);
                    }
                }
            }
            
            require_once '../app/Views/package/create.php';
        }
    }