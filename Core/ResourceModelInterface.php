<?php
namespace AHT\Core;

interface ResourceModelInterface {
    public function save($model);

    public function delete($id);

    public function _init($table, $id, $model);
}