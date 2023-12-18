<?php

namespace App\Controllers;

use App\Libraries\Ssp;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface as ResponseInterfaceAlias;

class Categoria extends BaseController
{
    public $model;
    public function __construct()
    {
        $this->model = model('App\Models\CategoriaModel');
    }

    public function index()
    {
        return view('categoria/index');
    }

    public function listadoCategoriasAjax(): ResponseInterfaceAlias
    {
        $table = "categorias";
        $primaryKey = 'id_categoria';
        $where = NULL;
        $columns = [
            ['db' => 'id_categoria', 'dt' => 0],
            ['db' => 'categoria', 'dt' => 1],
            ['db' => 'creado_el', 'dt' => 2, 'formatter' => function ($fecha, $fila) {
                return date('d/m/Y H:i:s', strtotime($fecha));
            }],
            ['db' => 'estado', 'dt' => 3, 'formatter' => function ($d, $row) {
                if ($d == 'REGISTRADO')
                    return '<span class="badge badge-success">REGISTADO</span>';
                else
                    return '<span class="badge badge-danger">ELIMINADO</span>';
            }],
            [
                'db' => 'id_categoria',
                'dt' => 4,
                'formatter' => function ($d, $row) {
                    if ($row['estado'] != 'ELIMINADO') {
                        $button = '
                            <button class="btn btn-icon btn-sm btn-danger btn-eliminar" data-id="' . $d . '" data-categoria="' . $row['categoria'] . '">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        ';
                    } else {
                        $button = '
                            <button class="btn btn-icon btn-sm btn-success btn-activar" data-id="' . $d . '" data-categoria="' . $row['categoria'] . '">
                                <i class="fa-solid fa-up-long"></i>
                            </button>
                        ';
                    }

                    return '
                        <button class="btn btn-icon btn-sm btn-warning btn-editar" data-id="' . $d . '">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        ' . $button;
                }
            ]
        ];

        $db = \Config\Database::connect();

        $sql_details = array(
            'user' => $db->username,
            'pass' => $db->password,
            'db' => $db->database,
            'host' => $db->hostname
        );

        return $this->response->setJSON(
            json_encode(Ssp::complex($_GET, $sql_details, $table, $primaryKey, $columns, $where))
        );
    }

    public function vistaAgregar(): ResponseInterfaceAlias
    {
        $vista = view('categoria/agregar');
        return $this->response->setJSON([
            'vista' => $vista,
        ]);
    }

    public function store()
    {
        $validation = $this->validate([
            'categoria' => 'required|is_unique[categorias.categoria]',
        ]);


        if (!$validation) {
            return $this->response->setJSON(['validacion' => $this->validator->getErrors()]);
        }

        $id_categoria = $this->model->insert([
            'categoria' => mb_convert_case(trim($this->request->getVar('categoria')), MB_CASE_UPPER, "UTF-8"),
            'estado' => 'REGISTRADO'
        ]);

        if (is_numeric($id_categoria)) {
            return $this->response->setJSON(['exito' => true, 'msg' => 'Categoría registrada correctamente']);
        } else {
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo registrar la categoría']);
        }
    }

    public function edit(): ResponseInterfaceAlias
    {
        $id_categoria = $this->request->getVar('id');
        $categoria = $this->model->find($id_categoria);

        $vista = view('categoria/editar', ['categoria' => $categoria]);
        return $this->response->setJSON(['vista' => $vista]);
    }

    public function update(): ResponseInterfaceAlias
    {
        $validation = $this->validate([
            'id_categoria' => 'required',
            'categoria' => 'required|is_unique_categoria_editar[' . trim($this->request->getVar('categoria')) . ']',
        ]);

        if (!$validation) {
            return $this->response->setJSON(['validacion' => $this->validator->getErrors()]);
        }

        $id_categoria = $this->request->getVar('id_categoria');
        $categoria = mb_convert_case(trim($this->request->getVar('categoria')), MB_CASE_UPPER, "UTF-8");

        $respuesta = $this->model->update($id_categoria, [
            'categoria' => $categoria
        ]);

        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Categoría actualizada correctamente']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo actualizar la categoría']);
    }

    /**
     * @throws ReflectionException
     */
    public function delete(): ResponseInterfaceAlias
    {
        $id_categoria = $this->request->getVar('id');
        $respuesta = $this->model->update($id_categoria, ['estado' => 'ELIMINADO']);

        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Categoría eliminado correctamente']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'Error al eliminar la categoría']);
    }

    /**
     * @throws ReflectionException
     */
    public function active(): ResponseInterfaceAlias
    {
        $id_categoria = $this->request->getVar('id');
        $respuesta = $this->model->update($id_categoria, ['estado' => 'REGISTRADO']);
        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Categoría activado correctamente']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'Error al activar la categoría']);
    }
}
