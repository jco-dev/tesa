<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartamentosSeeder extends Seeder
{
    public function run()
    {
        $departamentos = [
            [
                'codigo' => 'CH',
                'nombre_departamento' => 'Chuquisaca',
                'creado_el' => date('Y-m-d H:i:s'),
                'estado' => 'REGISTRADO'
            ],
            [
                'codigo' => 'LP',
                'nombre_departamento' => 'La Paz',
                'creado_el' => date('Y-m-d H:i:s'),
                'estado' => 'REGISTRADO'
            ],
            [
                'codigo' => 'CB',
                'nombre_departamento' => 'Cochabamba',
                'creado_el' => date('Y-m-d H:i:s'),
                'estado' => 'REGISTRADO'
            ],
            [
                'codigo' => 'OR',
                'nombre_departamento' => 'Oruro',
                'creado_el' => date('Y-m-d H:i:s'),
                'estado' => 'REGISTRADO'
            ],
            [
                'codigo' => 'PT',
                'nombre_departamento' => 'Potosí',
                'creado_el' => date('Y-m-d H:i:s'),
                'estado' => 'REGISTRADO'
            ],
            [
                'codigo' => 'TJ',
                'nombre_departamento' => 'Tarija',
                'creado_el' => date('Y-m-d H:i:s'),
                'estado' => 'REGISTRADO'
            ],
            [
                'codigo' => 'SC',
                'nombre_departamento' => 'Santa Cruz',
                'creado_el' => date('Y-m-d H:i:s'),
                'estado' => 'REGISTRADO'
            ],
            [
                'codigo' => 'BE',
                'nombre_departamento' => 'Beni',
                'creado_el' => date('Y-m-d H:i:s'),
                'estado' => 'REGISTRADO'
            ],
            [
                'codigo' => 'PD',
                'nombre_departamento' => 'Pando',
                'creado_el' => date('Y-m-d H:i:s'),
                'estado' => 'REGISTRADO'
            ]
        ];

        $this->db->table('departamentos')->insertBatch($departamentos);
    }
}
