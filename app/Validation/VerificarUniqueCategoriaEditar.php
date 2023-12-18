<?php

namespace App\Validation;

use App\Models\CategoriaModel;

class VerificarUniqueCategoriaEditar
{
    public function is_unique_categoria_editar(string $str, string $fields, array $data): bool
    {
        $model = new CategoriaModel();
        $row = $model->where([ 'categoria' =>  $data['categoria'], 'id_categoria !=' => $data['id_categoria']])->first();
        return $row == null;
    }
}
