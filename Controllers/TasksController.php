<?php
namespace AHT\Controllers;

use AHT\Core\Controller;
use AHT\Models\TaskModel;
use AHT\Models\TaskRepository;

class TasksController extends Controller
{
    function index()
    { 
        $rs = new TaskRepository();
    
        $d['tasks'] = $rs->getAll();
        $this->set($d);
        $this->render("index");
    }

    public function create()
    {
        $model = new TaskModel;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->setTitle($_POST['title']);
            $model->setDescription($_POST['description']);
            $tasks = new TaskRepository;
            $tasks->add($model);
            header("Location: " . WEBROOT . "tasks/index");
        }
        $this->render("create");
    }

    public function edit($id) 
    {
        $rs = new TaskRepository;
        $d['task'] = $rs->get($id);
        $this->set($d);
        $model = new TaskModel;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->setTitle($_POST['title']);
            $model->setDescription($_POST['description']);
            $tasks = new TaskRepository;
            $tasks->edit($id, $model);
            header("Location: " . WEBROOT . "tasks/index");
        }
        $this->render("edit");
    }
    
    public function delete($id) 
    {
        if(isset($id)) {
            $tasks = new TaskRepository();
            $tasks->delete($id);
            header("Location: " . WEBROOT . "tasks/index");
        }else {
            echo "Task doesn't exist";
        }
    }
}
?>