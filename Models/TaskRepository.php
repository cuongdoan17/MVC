<?php

namespace AHT\Models;

use AHT\Models\TaskResouceModel;

class TaskRepository
{
    public function add($model)
    {
        $rs = new TaskResourceModel;
        $rs->save($model);
    }

    public function get($id)
    {
        $rs = new TaskResourceModel();
        $task = $rs->get($id);
        return $task;
    }

    public function edit($id, $model) {
        $rs = new TaskResourceModel();
        $rs->edit($id, $model);
    }

    public function delete($id)
    {
        $rs = new TaskResourceModel();
        $rs->delete($id);
    }

    public function getAll()
    {
        $rs = new TaskResourceModel();
        $tasks = $rs->getAll();
        return $tasks;
    }
}
