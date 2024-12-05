<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AgencyModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Agencias extends Controller
{
  public function index()
  {
    $model = new AgencyModel();

    $data['agencies'] = $model->orderBy('id', 'DESC')->findAll();

    return view('agencias', $data);
  }


  public function nuevo()
  {

    return view('agencias_new');
  }

  public function save()
  {
    $model = new AgencyModel();
    $newData = [
      'name'   => $this->request->getVar('name'),
      'email' => $this->request->getVar('email'),

    ];

    if ($model->save($newData)) echo 1;
    else echo 0;

    /* $data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 
        
        return view('agencias', $data);*/

    return redirect()->route('agencias');
  }

  public function editar()
  {
    $model = new AgencyModel();
    $id = $this->request->getVar('id');

    $data['ag'] = $model->where('id', $id)->first();

    return view('agencias_edit', $data);
  }
  public function update()
  {
    $model = new AgencyModel();

    $name = $this->request->getVar('name');
    $email = $this->request->getVar('email');

    if ($model->where('id', $this->request->getVar('id'))
      ->set(['name' => $name, 'email' => $email])
      ->update()
    ) echo 1;
    else echo 0;


    /*$data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 
        
        return view('agencias', $data);*/
  }

  public function eliminar()
  {
    $model = new AgencyModel();



    $model->where('id', $this->request->getVar('id'))->delete();


    // $data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 

    //return view('agencias', $data);

    echo 1;
  }



  function exportar()
  {
    $role_object = new AgencyModel();

    $data = $role_object->findAll();

    $file_name = 'data.xlsx';

    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'Id');

    $sheet->setCellValue('B1', 'Nombre');

    $sheet->setCellValue('C1', 'Email');

    $count = 2;

    foreach ($data as $row) {
      $sheet->setCellValue('A' . $count, $row['id']);

      $sheet->setCellValue('B' . $count, $row['name']);

      $sheet->setCellValue('C' . $count, $row['email']);



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
    $model = new AgencyModel();
    $path             = 'public/documents/Agencia/';
    $path2             = 'public\documents\Agencia';
    $json             = [];

    if ($this->request->getFile('file') != "") {

      $file = $this->request->getFile('file');
      $extension = $file->guessExtension();
      $nameFile = "Agencia." . $extension;
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
          $result     = $model->getAgencia(["id" => $val[0]]);
          if ($result) {
          } else {
            
            $list[] = [
              'id'                    => $val[0],
              'name'            => $val[1],
              'email'            => $val[2],

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
}
