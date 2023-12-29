<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table            = 'clientes';
    protected $primaryKey       = 'id_cliente';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_cliente',
        'id_usuario',
        'id_municipio',
        'total_compra',
        'estado',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';

    public function listadoMunicipios()
    {
        $builder = $this->db->table('municipios m');
        $builder->select('id_municipio, concat(nombre_departamento, " - " ,nombre_municipio) as municipio');
        $builder->join('provincias p', 'p.id_provincia = m.id_provincia');
        $builder->join('departamentos d', 'd.id_departamento = p.id_departamento');
        $builder->where('m.estado', 'REGISTRADO');
        return $builder->get()->getResult();
    }
}
