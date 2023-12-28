<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EliminarColumnaEstadoDepartamento extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('departamentos', 'estado_departamento');
    }

    public function down()
    {
        $this->forge->addColumn('departamentos', [
            'estado_departamento' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
    }
}
