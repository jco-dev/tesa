<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $table            = 'personas';
    protected $primaryKey       = 'id_persona';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_persona',
        'ci',
        'expedido',
        'nombre',
        'paterno',
        'materno',
        'fecha_nacimiento',
        'celular',
        'correo_electronico',
        'genero',
        'direccion',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';

    public function getGrupoUsuarioModel(int $id_persona): array
    {
        $builder = $this->db->table('usuarios_grupos ug');
        $builder->select('g.nombre_grupo');
        $builder->join('grupos g', 'g.id_grupo = ug.id_grupo');
        $builder->where('ug.id_usuario', $id_persona);
        $builder->where('ug.estado', 'ACTIVO');
        $query = $builder->get();
        return $query->getResult();
    }
}
