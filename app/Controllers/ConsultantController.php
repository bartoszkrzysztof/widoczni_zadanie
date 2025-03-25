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
        require_once '../app/Views/consultant/show.php';
    }

    // public function edit($id)
    // {
    //     $caregiver = Consultant::getById($id);
    //     require_once '../app/Views/caregivers/edit.php';
    // }

    // public function create()
    // {
    //     require_once '../app/Views/caregivers/create.php';
    // }
}