<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GruposSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre_grupo' => 'ADMINISTRADOR',
            ],
            [
                'nombre_grupo' => 'GERENTE',
            ],
            [
                'nombre_grupo' => 'PRODUCCIÓN',
            ],
            [
                'nombre_grupo' => 'ALMACEN',
            ],
            [
                'nombre_grupo' => 'VENTAS',
            ]
        ];

        $this->db->table('grupos')->insertBatch($data);
    }
}
