<?php

namespace app\controllers;

use app\models\User;
use app\Router;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        $users = $this->userModel->all();
        require_once(__DIR__ . '/../views/user/index.php');
    }

    public function show($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            header("HTTP/1.0 404 Not Found");
            echo "User not found";
            return;
        }
        require_once(__DIR__ . '/../views/user/show.php');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email']
            ];
            $this->userModel->create($data);
            header('Location: /mvc-project/public/');
            exit;
        }
        require_once(__DIR__ . '/../views/user/create.php');
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email']
            ];
            $this->userModel->update($id, $data);
            header('Location: /mvc-project/public/');
            exit;
        }
        $user = $this->userModel->find($id);
        if (!$user) {
            header("HTTP/1.0 404 Not Found");
            echo "User not found";
            return;
        }
        require_once(__DIR__ . '/../views/user/edit.php');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        header('Location: /mvc-project/public/');
        exit;
    }
}