<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ClienteModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ClientesController extends Controller
{

    protected $helpers = ['form'];
    public function index()
    {
        $model = new ClienteModel();

        $data['cliente'] = $model->orderBy('id', 'DESC')->findAll();

        return view('clientesView', $data);
    }


    /*public function nuevo()
    {

        return view('cliente_newView');
    }*/
    public function nuevo()
    {

        return view('clientes_newView');
    }


    public function save()
    {

        $rules = [
            'clientes' => [
                'nombre_comercial'  => 'required|is_unique[clientes.nombre_comercial]',
                'errors' => [
                    'required' => 'Debes introduccir un role.',
                    'is_unique' => 'El nombre de role ya existe.',
                ]
            ]

        ];



        $data = $this->request->getPost(array_keys($rules));

        if (! $this->validateData($data, $rules)) {

            return $this->validateDataErrores($data, $rules);
        }




        $model = new ClienteModel();
        $newData = [
            'id_clientes'     => $this->request->getVar('id_clientes'),
            'nombre_comercial'     => $this->request->getVar('nombre_comercial'),
            'razon_social'     => $this->request->getVar('razon_social'),
            'cif_nif_nie'     => $this->request->getVar('cif_nif_nie'),
            'telefono'     => $this->request->getVar('telefono'),
            'email'     => $this->request->getVar('email'),
            'id_provincias'     => $this->request->getVar('id_provincias'),
            'id_operadores'     => $this->request->getVar('id_operadores')

        ];


        if ($model->save($newData)) echo 1;
        else echo 0;
    }





    public function save2()
    {


        $rules = [
            'cliente' => [
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir un tipo facturación.',
                ]
            ]
        ];






        $data = $this->request->getPost(array_keys($rules));

        if (! $this->validateData($data, $rules)) {
            echo 0;
            return;
        }

        $model = new clienteModel();
        $newData = [
            'cliente'     => $this->request->getVar('cliente')
        ];

        if ($model->save($newData)) echo 1;
        else echo 0;

        /* $data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 
        
        return view('agencias', $data);*/

        // return redirect()->route('cliente');

    }

    public function editar()
    {
        $model = new clienteModel();
        $id = $this->request->getVar('id');

        $data['tipo'] = $model->where('id', $id)->first();

        return view('cliente_editView', $data);
    }
    public function editar2()
    {
        $model = new clienteModel();
        $id = $this->request->getVar('id');

        $data['tipo'] = $model->where('id', $id)->first();

        return view('cliente_edit2View', $data);
    }
    public function update()
    {

        $rules = [
            'cliente' => [
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir un tipo facturación.',
                ]
            ]
        ];






        $data = $this->request->getPost(array_keys($rules));

        if (! $this->validateData($data, $rules)) {
            echo 0;
            return;
        }

        $model = new clienteModel();

        $cliente = $this->request->getVar('cliente');


        $updated_at = date('Y-m-d h:i:s');




        if ($model->where('id', $this->request->getVar('id'))
            ->set(['cliente' => $cliente, 'updated_at' => $updated_at])
            ->update()
        ) echo 1;
        else echo 0;


        /*$data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 
        
        return view('agencias', $data);*/
    }

    public function eliminar()
    {
        $model = new clienteModel();



        $model->where('id', $this->request->getVar('id'))->delete();


        // $data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 

        //return view('agencias', $data);

        echo 1;
    }





    function exportar()
    {
        //['cliente', 'created_at', 'updated_at' ];
        $role_object = new clienteModel();

        $data = $role_object->findAll();

        $file_name = 'Tipo_de_Facturacion.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Id');

        $sheet->setCellValue('B1', 'Tipo de Facturación');

        $sheet->setCellValue('C1', 'Creado');

        $sheet->setCellValue('D1', 'Actualizado');

        $count = 2;

        foreach ($data as $row) {
            $sheet->setCellValue('A' . $count, $row['id']);

            $sheet->setCellValue('B' . $count, $row['cliente']);

            $sheet->setCellValue('C' . $count, $row['created_at']);

            $sheet->setCellValue('D' . $count, $row['updated_at']);

            $count++;
        }

        $writer = new Xlsx($spreadsheet);

        $writer->save($file_name);

        header("Content-Type: application/vnd.ms-excel");

        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');

        header('Expires: 0');

        header('Cache-Control: must-revalidate');

        header('Pragma: public');

        header('Content-Length:' . filesize($file_name));

        flush();

        readfile($file_name);

        exit;
    }

    public function importar()
    {
        $model = new clienteModel();
        $path             = 'public/documents/cliente/';
        $path2             = 'public\documents\cliente';
        $json             = [];

        if ($this->request->getFile('file') != "") {

            $file = $this->request->getFile('file');
            $extension = $file->guessExtension();
            $nameFile = "cliente." . $extension;
            $file->move(ROOTPATH . $path, $nameFile);


            $nameFile = ROOTPATH . $path2 . "\\" . $nameFile;
            /*$arr_file 		= explode('.', $file_name);
    $extension 		= end($arr_file);*/
            if ('csv' == $extension) {
                $reader     = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader     = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet     = $reader->load($nameFile);
            $sheet_data     = $spreadsheet->getActiveSheet()->toArray();

            $list             = [];
            foreach ($sheet_data as $key => $val) {
                if ($key != 0) {
                    $result     = $model->getTipoFacturacion(["cliente" => $val[1]]);
                    if ($result) {
                    } else {
                        $list[] = [
                            'id'                    => $val[0],
                            'cliente'            => $val[1],
                            'created_at'             =>  date("Y-m-d H:i:s"),
                            'updated_at'             =>  date("Y-m-d H:i:s"),
                        ];
                    }
                }
            }


            //if(file_exists($nameFile))
            //unlink($nameFile);
            if (count($list) > 0) {
                $result     = $model->bulkInsert($list);
                if ($result) {
                    $json = [
                        'success_message'     => 'showSuccessMessage("All Entries are imported successfully.")'
                    ];
                } else {
                    $json = [
                        'error_message'     => 'showErrorMessage("Something went wrong. Please try again.")'
                    ];
                }
            } else {
                $json = [
                    'error_message' => 'showErrorMessage("No new record is found.")'
                ];
            }
        }


        echo json_encode($json);
    }

    /*public function uploadFile($path, $image) {
    if (!is_dir($path)) 
        mkdir($path, 0777, TRUE);
    //if ($image->isValid() && ! $image->hasMoved()) {
        $newName = $image->getRandomName();
        $image->move('./'.$path, $newName);
        return $path.$image->getName();
    //}
    //return "";
}*/
}
