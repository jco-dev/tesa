<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Provincias extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_provincia' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'id_departamento' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false
            ],

            'nombre_provincia' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
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
                'constraint' => ['REGISTRADO', 'ELIMINADO'],
                'default'    => 'REGISTRADO',
                'null'       => false
            ],

        ]);

        $this->forge->addKey('id_provincia', true);
        $this->forge->addForeignKey('id_departamento', 'departamentos', 'id_departamento');
        $this->forge->createTable('provincias');
    }

    public function down()
    {
        $this->forge->dropTable('provincias');
    }
}
