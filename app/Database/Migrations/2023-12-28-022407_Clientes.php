<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clientes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cliente' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],

            'id_provincia' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false
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

        $this->forge->addKey('id_cliente', true);
        $this->forge->addForeignKey('id_cliente', 'personas', 'id_persona');
        $this->forge->addForeignKey('id_provincia', 'provincias', 'id_provincia');
        $this->forge->createTable('clientes');
    }

    public function down()
    {
        $this->forge->dropTable('clientes');
    }
}
