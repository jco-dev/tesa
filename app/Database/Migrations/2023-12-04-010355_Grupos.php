<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Grupos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_grupo' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
                'auto_increment' => true,
            ],
            'nombre_grupo' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
                'unique'     => true,
            ],
            'creado_el TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'actualizado_el' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null,
                'on update' => 'CURRENT_TIMESTAMP',
            ],
            'estado' => [
                'type'       => 'ENUM',
                'constraint' => ['ACTIVO', 'ELIMINADO'],
                'default'    => 'ACTIVO',
                'null'       => false
            ],
        ]);

        $this->forge->addKey('id_grupo', true);
        $this->forge->createTable('grupos', true, [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('grupos', true);
    }
}
