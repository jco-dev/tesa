<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarDescripcionCategoriaColumna extends Migration
{
    public function up()
    {
        $this->forge->addColumn('categorias', [
            'descripcion'     => [
                'type'        => 'VARCHAR',
                'constraint'  => '250',
                'null'        => true,
                'after'       => 'categoria',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('categorias', 'descripcion');
    }
}
