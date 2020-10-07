<?php

namespace AHT\Core;

use AHT\Config\Database;

class ResourceModel implements ResourceModelInterface
{
    protected $table;
    protected $id;
    protected $model;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }
    
    public function save($model)
    {
            $result = $model->getProperties($model);
            unset($result['id']);
            $key = implode(', ', array_keys($result));
            $value = '"' . implode('","', array_values($result)) . '"';
            $sql = "INSERT INTO ".$this->table." (" . $key . ") VALUES (" . $value . ")";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute();
    }

    public function edit($id, $model) {
            $result = $model->getProperties($model);
            unset($result['id']);
            $update = implode(',', array_map(
                function ($v, $k) {
                    return sprintf("`%s` = '%s'", $k, $v);
                },
                $result,
                array_keys($result)
            ));
            $time = date('Y-m-d H:i:s');
            $sql = 'UPDATE '.$this->table.' SET '.$update.' , updated_at = "'.$time.'" WHERE id ='.$id;
            $req = Database::getBdd()->prepare($sql);
            return $req->execute();
    }

    public function get($id) {
        $sql = "SELECT * FROM ".$this->table." WHERE id  = ".$id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM '.$this->table.' WHERE id = '.$id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM ".$this->table;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}
