<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categorias extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_categoria'       => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'categoria'         => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'          => false,
                'unique'        => true,
            ],
            'creado_el TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'actualizado_el'    => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
                'default'       => null,
                'on update'     => 'CURRENT_TIMESTAMP',
            ],
            'estado' => [
                'type'       => 'ENUM',
                'constraint' => ['REGISTRADO', 'ELIMINADO'],
                'default'    => 'REGISTRADO',
                'null'       => false
            ],
        ]);
        $this->forge->addKey('id_categoria', true);
        $this->forge->createTable('categorias');
    }

    public function down()
    {
        $this->forge->dropTable('categorias');
    }
}
