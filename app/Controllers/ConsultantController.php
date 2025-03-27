<?php
require_once __DIR__ . '/../Models/Consultant.php';

class ConsultantController
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $consultants = Consultant::getAllConsultants($this->pdo);
        require_once '../app/Views/consultant/index.php';
    }

    public function show($id)
    {
        $consultant = Consultant::getConsultantById($this->pdo, $id);
        $clients = Consultant::getClientsData($this->pdo, $id);
        require_once '../app/Views/consultant/show.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = isset($_POST['first_name']) ? htmlspecialchars(trim($_POST['first_name'])) : null;
            $last_name = isset($_POST['last_name']) ? htmlspecialchars(trim($_POST['last_name'])) : null;
            $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
            $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : null;
            $action = isset($_POST['action']) ? htmlspecialchars(trim($_POST['action'])) : null;

            if ($action === 'update_consultant') {
                $results = Consultant::updateConsultant($this->pdo, $id, $first_name, $last_name, $email, $phone);
            }
            elseif ($action === 'delete_consultant') {
                $results = Consultant::deleteConsultant($this->pdo, $id);

                if (isset($results['status']) && $results['status'] === 'success') {
                    header('Location: /consultant');
                }
            }
        }
        
        $consultant = Consultant::getConsultantById($this->pdo, $id);
        require_once '../app/Views/consultant/edit.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = isset($_POST['first_name']) ? htmlspecialchars(trim($_POST['first_name'])) : null;
            $last_name = isset($_POST['last_name']) ? htmlspecialchars(trim($_POST['last_name'])) : null;
            $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
            $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : null;
            $action = isset($_POST['action']) ? htmlspecialchars(trim($_POST['action'])) : null;

            if ($action === 'create_consultant') {
                $results = Consultant::createConsultant($this->pdo, $first_name, $last_name, $email, $phone);

                if (isset($results['id']) && $results['id']) {
                    header('Location: /consultant/edit/' . $results['id']);
                }
            }
        }
        
        require_once '../app/Views/consultant/create.php';
    }
}