<?php
    require_once __DIR__ . '/../Models/Package.php';

    class BaseController
    {
        public function __construct()
        {
        }

        public function index()
        {
            require_once '../app/Views/base/index.php';
        }
    }