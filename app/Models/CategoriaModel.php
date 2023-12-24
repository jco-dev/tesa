<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table            = 'categorias';
    protected $primaryKey       = 'id_categoria';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'categoria',
        'descripcion',
        'estado'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';
    
}
