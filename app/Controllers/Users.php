<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\RoleModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Users extends Controller
{

    protected $helpers = ['form'];

    public function index()
    {
        $model = new UserModel();

        $data['users'] = $model->orderBy('id_user', 'DESC')->findAll();

        /* $session = session();
        if($session->get('role')!="Administrador") return view('index');*/

        return view('usuarios', $data);
    }


    public function nuevo()
    {

        $role_model = new RoleModel();

        $roles = $role_model->orderBy('id', 'DESC')->findAll();


        $options = array('--Select--');

        foreach ($roles as $row) {
            $options[$row['id']] = $row['role'];
        }
        $data['optionsRoles'] = $options;

        return view('usuarios_new', $data);
    }

    public function save()
    {

        $model = new UserModel();
        $newData = [
            'act_user'     => $this->request->getVar('act_user'),
            'firstname' => $this->request->getVar('firstname'),
            'lastname'     => $this->request->getVar('lastname'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'id_roles' => $this->request->getVar('id_roles'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at'     => date("Y-m-d h:i:s")


        ];

        $model->save($newData);

        $data['users'] = $model->orderBy('id_user', 'DESC')->findAll();

        return view('usuarios', $data);
    }

    public function editar()
    {
        $model = new UserModel();
        $id_user = $this->request->getVar('id');

        $data['user'] = $model->where('id_user', $id_user)->first();
        $role_model = new RoleModel();

        $roles = $role_model->orderBy('id', 'DESC')->findAll();


        $options = array('--Select--');

        foreach ($roles as $row) {
            $options[$row['id']] = $row['role'];
        }
        $data['optionsRoles'] = $options;

        return view('usuarios_edit', $data);
    }
    public function update()
    {
        $model = new UserModel();


        $act_user = $this->request->getVar('act_user');
        $firstname = $this->request->getVar('firstname');
        $lastname     = $this->request->getVar('lastname');
        $email = $this->request->getVar('email');
        $password     = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        $id_roles = $this->request->getVar('id_roles');


        $model->where('id_user', $this->request->getVar('id_user'))
            ->set(['act_user' => $act_user, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'password' => $password, 'id_roles' => $id_roles, 'updated_at' => date("Y-m-d h:i:s")])
            ->update();

        $data['users'] = $model->orderBy('id_user', 'DESC')->findAll();

        return view('usuarios', $data);
    }

    public function eliminar()
    {
        $model = new UserModel();



        if ($model->where('id_user', $this->request->getVar('id'))->delete()) echo 1;
        else echo 0;


        /*  $data['users'] = $model->orderBy('id_user', 'DESC')->findAll(); 
        
        return view('usuarios', $data);*/
    }


    function exportar()
    {
        //        ['act_user', 'firstname', 'lastname', 'email', 'password', 'id_roles', 'created_at', 'updated_at'];

        $role_object = new UserModel();

        $data = $role_object->findAll();

        $file_name = 'data.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Id');

        $sheet->setCellValue('B1', 'act_user');

        $sheet->setCellValue('C1', 'firstname');

        $sheet->setCellValue('D1', 'lastname');
        $sheet->setCellValue('F1', 'email');

        $sheet->setCellValue('G1', 'id_roles');
        $sheet->setCellValue('H1', 'created_at');
        $sheet->setCellValue('I1', 'updated_at');

        $count = 2;

        foreach ($data as $row) {
            $sheet->setCellValue('A' . $count, $row['id_user']);
            $sheet->setCellValue('B' . $count, $row['act_user']);
            $sheet->setCellValue('C' . $count, $row['firstname']);
            $sheet->setCellValue('D' . $count, $row['lastname']);
            $sheet->setCellValue('F' . $count, $row['email']);
            $sheet->setCellValue('G' . $count, $row['id_roles']);
            $sheet->setCellValue('H' . $count, $row['created_at']);
            $sheet->setCellValue('I' . $count, $row['updated_at']);


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
        $model = new UserModel();
        $path = 'public/documents/Users/';
        $path2 = 'public\documents\Users';
        $json = [];

        if ($this->request->getFile('file') != "") {

            $file = $this->request->getFile('file');
            $extension = $file->guessExtension();
            $nameFile = "users." . $extension;
            $file->move(ROOTPATH . $path, $nameFile);

            $nameFile = ROOTPATH . $path2 . "\\" . $nameFile;

            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($nameFile);
            $sheet_data = $spreadsheet->getActiveSheet()->toArray();

            $list = [];
            foreach ($sheet_data as $key => $val) {
                if ($key != 0) { // Salta la primera fila (encabezados)
                    // Asumiendo que los valores están en las posiciones de la fila del archivo:
                    // 0 => act_user, 1 => firstname, 2 => lastname, 3 => email, 4 => password, 5 => id_roles, 6 => created_at, 7 => updated_at

                    // Verifica si el usuario ya existe por correo (o cualquier otro criterio)
                    $result = $model->getUser(["email" => $val[4]]); // Se asume que el correo está en la posición 3 (columna 4)

                    if (!$result) { // Si el usuario no existe
                        $list[] = [
                            'id_user' => $val[3],       // Asume que 'id_user' está en la columna 1
                            'act_user' => $val[1],       // Asume que 'act_user' está en la columna 1
                            'firstname' => $val[2],      // Asume que 'firstname' está en la columna 2
                            'lastname' => $val[3],       // Asume que 'lastname' está en la columna 3
                            'email' => $val[4],          // Asume que 'email' está en la columna 4
                            'password' => $val[5],       // Asume que 'password' está en la columna 5
                            'id_roles' => $val[6],       // Asume que 'id_roles' está en la columna 6
                            'created_at' => $val[7],     // Asume que 'created_at' está en la columna 7
                            'updated_at' => $val[8],     // Asume que 'updated_at' está en la columna 8
                        ];
                    }
                }
            }

            if (count($list) > 0) {
                $result = $model->bulkInsert($list);
                if ($result) {
                    $json = [
                        'success_message' => 'showSuccessMessage("All Entries are imported successfully.")'
                    ];
                } else {
                    $json = [
                        'error_message' => 'showErrorMessage("Something went wrong. Please try again.")'
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
