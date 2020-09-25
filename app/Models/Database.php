<?php

namespace App\Models;

use CodeIgniter\Model;

class Database extends Model
{
    protected $table = 'cursos';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nome'];

    public function getCursos()
    {
        return $this->findAll();
    }
}
