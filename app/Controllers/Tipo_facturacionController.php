<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Tipo_facturacionModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Tipo_facturacionController extends Controller
{

    protected $helpers = ['form'];
    public function index()
    {
        $model = new Tipo_facturacionModel();

        $data['tipo_facturacion'] = $model->orderBy('id', 'DESC')->findAll();

        return view('tipo_facturacionView', $data);
    }


    public function nuevo()
    {

        return view('tipo_facturacion_newView');
    }
    public function nuevo2()
    {

        return view('tipo_facturacion_new2View');
    }

    public function save()
    {


        $rules = [
            'tipo_facturacion' => [
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

        $model = new Tipo_facturacionModel();
        $newData = [
            'tipo_facturacion'     => $this->request->getVar('tipo_facturacion')
        ];

        if ($model->save($newData)) echo 1;
        else echo 0;

        /* $data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 
        
        return view('agencias', $data);*/

        // return redirect()->route('tipo_facturacion');

    }

    public function save2()
    {


        $rules = [
            'tipo_facturacion' => [
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

        $model = new Tipo_facturacionModel();
        $newData = [
            'tipo_facturacion'     => $this->request->getVar('tipo_facturacion')
        ];

        if ($model->save($newData)) echo 1;
        else echo 0;

        /* $data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 
        
        return view('agencias', $data);*/

        // return redirect()->route('tipo_facturacion');

    }

    public function editar()
    {
        $model = new Tipo_facturacionModel();
        $id = $this->request->getVar('id');

        $data['tipo'] = $model->where('id', $id)->first();

        return view('tipo_facturacion_editView', $data);
    }
    public function editar2()
    {
        $model = new Tipo_facturacionModel();
        $id = $this->request->getVar('id');

        $data['tipo'] = $model->where('id', $id)->first();

        return view('tipo_facturacion_edit2View', $data);
    }
    public function update()
    {

        $rules = [
            'tipo_facturacion' => [
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

        $model = new Tipo_facturacionModel();

        $tipo_facturacion = $this->request->getVar('tipo_facturacion');


        $updated_at = date('Y-m-d h:i:s');




        if ($model->where('id', $this->request->getVar('id'))
            ->set(['tipo_facturacion' => $tipo_facturacion, 'updated_at' => $updated_at])
            ->update()
        ) echo 1;
        else echo 0;


        /*$data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 
        
        return view('agencias', $data);*/
    }

    public function eliminar()
    {
        $model = new Tipo_facturacionModel();



        $model->where('id', $this->request->getVar('id'))->delete();


        // $data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 

        //return view('agencias', $data);

        echo 1;
    }





    function exportar()
    {
        //['tipo_facturacion', 'created_at', 'updated_at' ];
        $role_object = new Tipo_facturacionModel();

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

            $sheet->setCellValue('B' . $count, $row['tipo_facturacion']);

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
        $model = new Tipo_facturacionModel();
        $path             = 'public/documents/Tipo_facturacion/';
        $path2             = 'public\documents\Tipo_facturacion';
        $json             = [];

        if ($this->request->getFile('file') != "") {

            $file = $this->request->getFile('file');
            $extension = $file->guessExtension();
            $nameFile = "Tipo_facturacion." . $extension;
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
                    $result     = $model->getTipoFacturacion(["tipo_facturacion" => $val[1]]);
                    if ($result) {
                    } else {
                        $list[] = [
                            'id'                    => $val[0],
                            'tipo_facturacion'            => $val[1],
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
