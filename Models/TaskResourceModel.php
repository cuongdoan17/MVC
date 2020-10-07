<?php
namespace AHT\Models;

use AHT\Core\ResourceModel;
use AHT\Models\TaskModel;

class TaskResourceModel extends ResourceModel {
    function __construct()
    {
        parent::_init('tasks', 'id', new TaskModel());
    }
}