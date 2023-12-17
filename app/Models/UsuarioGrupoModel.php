<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioGrupoModel extends Model
{
    protected $table            = 'usuarios_grupos';
    protected $primaryKey       = 'id_grupo_usuario';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_usuario',
        'id_grupo',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';
}
