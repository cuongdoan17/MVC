<?php
namespace AHT\Core;

    class Model
    {
        public function getProperties($model) {
             return get_object_vars($model);
        }
    }
