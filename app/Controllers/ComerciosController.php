<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ComercioModel;
use App\Models\Tipo_facturacionModel;
use CodeIgniter\Files\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

#use Skilla\ValidatorCifNifNie\Constant;
class ComerciosController extends Controller
{
    protected $helpers = ['form'];

    //protected $library=['form_validation'];



    public function index()
    {


        $model = new ComercioModel();

        /*$data['comercios'] = $model->join('tipo_facturacion','comercios.id_tipo_facturacion=tipo_facturacion.id')
            ->select('comercios.id,comercios.nombre_comercial, comercios.razon_social, comercios.cif_nif_nie, comercios.telefono, comercios.email, comercios.persona_contacto, comercios.file_logo, comercios.id_tipo_facturacion,tipo_facturacion.tipo_facturacion')
            ->orderBy('id', 'DESC')->findAll(); */

        $data['comercios'] = $model->listaComercios();
        // $data['query']=$model->listaComerciosBuilder();
        $data['query'] = $model->listaComerciosBuilderQuery();

        return view('comerciosView', $data);
    }


    public function nuevo()
    {
        $tipo_facturacion_model = new Tipo_facturacionModel();

        $data['tipo_facturacion'] = $tipo_facturacion_model->orderBy('id', 'DESC')->findAll();

        return view('comercios_newView', $data);
    }

    public function nuevo2()
    {
        $tipo_facturacion_model = new Tipo_facturacionModel();

        $tiposFacturacion = $tipo_facturacion_model->orderBy('id', 'DESC')->findAll();


        $options = array('--Select--');

        foreach ($tiposFacturacion as $row) {
            $options[$row['id']] = $row['tipo_facturacion'];
        }
        $data['optionsTipoFacturacion'] = $options;
        return view('comercios_newView2', $data);
    }

    public function nuevo3()
    {
        $tipo_facturacion_model = new Tipo_facturacionModel();

        $tiposFacturacion = $tipo_facturacion_model->orderBy('id', 'DESC')->findAll();


        $options = array('--Select--');

        foreach ($tiposFacturacion as $row) {
            $options[$row['id']] = $row['tipo_facturacion'];
        }
        $data['optionsTipoFacturacion'] = $options;
        return view('comercios_newView3', $data);
    }

    public function nuevo4()
    {
        $tipo_facturacion_model = new Tipo_facturacionModel();

        $tiposFacturacion = $tipo_facturacion_model->orderBy('id', 'DESC')->findAll();


        $options = array('--Select--');

        foreach ($tiposFacturacion as $row) {
            $options[$row['id']] = $row['tipo_facturacion'];
        }
        $data['optionsTipoFacturacion'] = $options;
        return view('comercios_newView4', $data);
    }

    public function save()
    {

        /*if (! $this->request->is('post')) {
            echo 0;
        }*/

        $rules = [
            'nombre_comercial' => [
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir un nombre comercial.',
                ]
            ],
            'razon_social' => [
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir una razon social.',
                ]
            ],
            'cif_nif_nie' => [
                'rules'  => 'required|max_length[25]|validDniCifNie',
                'errors' => [
                    'required' => 'Debes introduccir un cif/nif/nie válido.',
                ]
            ],

            'telefono' => [
                'rules'  => 'required|max_length[25]',
                'errors' => [
                    'required' => 'Debes introduccir un teléfono.',
                ]
            ],
            'email' => [
                'rules'  => 'required|valid_email|trim|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir un email.',
                    'valid_email' => 'Debes introduccir un email válido.',
                ]
            ],
            'id_tipo_facturacion' => [
                'rules'  => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Debes elegir un tipo facturación.',
                ]
            ],

            'file_logo' => [

                'rules' => 'required',

                'errors' => [
                    'required' => 'Vacío',

                ]
            ],


        ];

        $data = $this->request->getPost($this->getDataKeys($rules));

        if (! $this->validateData($data, $rules)) {
            echo 0;
            return;
        }

        $model = new ComercioModel();
        $newData = [
            'nombre_comercial'     => $this->request->getVar('nombre_comercial'),
            'razon_social' => $this->request->getVar('razon_social'),
            'cif_nif_nie' => $this->request->getVar('cif_nif_nie'),
            'telefono' => $this->request->getVar('telefono'),
            'email' => $this->request->getVar('email'),
            'file_logo' => '',
            'id_tipo_facturacion' => $this->request->getVar('id_tipo_facturacion'),
            'persona_contacto' => $this->request->getVar('persona_contacto'),
        ];

        if ($model->save($newData)) {
            if ($this->request->getFile('file_logo') != "") {
                $comercio_id = $model->getInsertID();

                $file_logo = $this->request->getFile('file_logo');
                $ext = $file_logo->guessExtension();
                $nameImgFile = "Comercio_" . $comercio_id . "." . $ext;
                $file_logo->move(ROOTPATH . 'public/uploads', $nameImgFile);
                $filepath = 'public/uploads/' . $nameImgFile;

                $Comercio_Model = new ComercioModel();
                $Comercio_Model->where('id', $comercio_id)
                    ->set(['file_logo' => $filepath])
                    ->update();
            }
            echo 1;
        } else echo 0;

        /* $data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 
        
        return view('agencias', $data);*/

        //return redirect()->route('comercios');

    }


    public function save2()
    {

        /*if (! $this->request->is('post')) {
            echo 0;
        }*/
        //SELECT `id`, `nombre_comercial`, `razon_social`, `cif_nif_nie`, `telefono`, `email`, `persona_contacto`, `file_logo`, `id_tipo_facturacion`, `created_at`, `updated_at` FROM `comercios` WHERE 1

        $rules = [
            'nombre_comercial' => [
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir un nombre comercial.',
                ]
            ],
            'razon_social' => [
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir una razon social.',
                ]
            ],
            'cif_nif_nie' => [
                'rules'  => 'required|max_length[25]|validDniCifNie',
                'errors' => [
                    'required' => 'Debes introduccir un cif/nif/nie válido.',
                ]
            ],

            'telefono' => [
                'rules'  => 'required|max_length[25]',
                'errors' => [
                    'required' => 'Debes introduccir un teléfono.',
                ]
            ],
            'email' => [
                'rules'  => 'required|valid_email|trim|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir un email.',
                    'valid_email' => 'Debes introduccir un email válido.',
                ]
            ],
            'id_tipo_facturacion' => [
                'rules'  => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Debes elegir un tipo facturación.',
                ]
            ],

            'file_logo' => [

                'rules' => 'required',

                'errors' => [
                    'required' => 'Vacío',

                ]
            ],


        ];



        $data = $this->request->getPost($this->getDataKeys($rules));

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput();
        }

        $model = new ComercioModel();
        $newData = [
            'nombre_comercial'     => $this->request->getVar('nombre_comercial'),
            'razon_social' => $this->request->getVar('razon_social'),
            'cif_nif_nie' => $this->request->getVar('cif_nif_nie'),
            'telefono' => $this->request->getVar('telefono'),
            'email' => $this->request->getVar('email'),
            'file_logo' => '',
            'id_tipo_facturacion' => $this->request->getVar('id_tipo_facturacion'),
            'persona_contacto' => $this->request->getVar('persona_contacto'),
        ];

        if ($model->save($newData)) {
            if ($this->request->getFile('file_logo') != "") {
                $comercio_id = $model->getInsertID();

                $file_logo = $this->request->getFile('file_logo');
                $ext = $file_logo->guessExtension();
                $nameImgFile = "Comercio_" . $comercio_id . "." . $ext;
                $file_logo->move(ROOTPATH . 'public/uploads', $nameImgFile);
                $filepath = 'public/uploads/' . $nameImgFile;

                $Comercio_Model = new ComercioModel();
                $Comercio_Model->where('id', $comercio_id)
                    ->set(['file_logo' => $filepath])
                    ->update();
            }
            echo 1;
        } else echo 0;

        /* $data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 
        
        return view('agencias', $data);*/

        //return redirect()->route('comercios');

    }



    public function save3()
    {

        /*if (! $this->request->is('post')) {
            echo 0;
        }*/
        //SELECT `id`, `nombre_comercial`, `razon_social`, `cif_nif_nie`, `telefono`, `email`, `persona_contacto`, `file_logo`, `id_tipo_facturacion`, `created_at`, `updated_at` FROM `comercios` WHERE 1

        $rules = [
            'nombre_comercial' => [
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir un nombre comercial.',
                ]
            ],
            'razon_social' => [
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir una razon social.',
                ]
            ],
            'cif_nif_nie' => [
                'rules'  => 'required|max_length[25]|validDniCifNie',
                'errors' => [
                    'required' => 'Debes introduccir un cif/nif/nie válido.',
                ]
            ],

            'telefono' => [
                'rules'  => 'required|max_length[25]',
                'errors' => [
                    'required' => 'Debes introduccir un teléfono.',
                ]
            ],
            'email' => [
                'rules'  => 'required|valid_email|trim|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir un email.',
                    'valid_email' => 'Debes introduccir un email válido.',
                ]
            ],
            'id_tipo_facturacion' => [
                'rules'  => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Debes elegir un tipo facturación.',
                ]
            ],

            /*'file_logo' => [

                'rules' => 'required',
                
            'errors' => [
                'required' => 'Vacío',
              
            ]
                    ],*/


        ];



        $data = $this->request->getPost($this->getDataKeys($rules));

        if (! $this->validateData($data, $rules)) {

            //$dat["error"]=$this->validateData($data, $rules);
            $dat["fichero"] = $this->request->getFile('file_logo');
            $tipo_facturacion_model = new Tipo_facturacionModel();

            $tiposFacturacion = $tipo_facturacion_model->orderBy('id', 'DESC')->findAll();


            $options = array('--Select--');

            foreach ($tiposFacturacion as $row) {
                $options[$row['id']] = $row['tipo_facturacion'];
            }
            $dat['optionsTipoFacturacion'] = $options;

            return view('comercios_newView3', $dat);
            //return redirect()->back()->withInput()->with('fichero',$this->request->getFile('file_logo'));
        }

        $model = new ComercioModel();
        $newData = [
            'nombre_comercial'     => $this->request->getVar('nombre_comercial'),
            'razon_social' => $this->request->getVar('razon_social'),
            'cif_nif_nie' => $this->request->getVar('cif_nif_nie'),
            'telefono' => $this->request->getVar('telefono'),
            'email' => $this->request->getVar('email'),
            'file_logo' => '',
            'id_tipo_facturacion' => $this->request->getVar('id_tipo_facturacion'),
            'persona_contacto' => $this->request->getVar('persona_contacto'),
        ];

        if ($model->save($newData)) {
            if ($this->request->getFile('file_logo') != "") {
                $comercio_id = $model->getInsertID();

                $file_logo = $this->request->getFile('file_logo');
                $ext = $file_logo->guessExtension();
                $nameImgFile = "Comercio_" . $comercio_id . "." . $ext;
                $file_logo->move(ROOTPATH . 'public/uploads', $nameImgFile);
                $filepath = 'public/uploads/' . $nameImgFile;

                $Comercio_Model = new ComercioModel();
                $Comercio_Model->where('id', $comercio_id)
                    ->set(['file_logo' => $filepath])
                    ->update();
            }
            echo 1;
        } else echo 0;

        /* $data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 
        
        return view('agencias', $data);*/

        //return redirect()->route('comercios');

    }

    public function editar()
    {
        $model = new ComercioModel();
        $id = $this->request->getVar('id');

        $data['com'] = $model->where('id', $id)->first();
        $tipo_facturacion_model = new Tipo_facturacionModel();

        $data['tipo_facturacion'] = $tipo_facturacion_model->orderBy('id', 'DESC')->findAll();

        return view('comercios_editView', $data);
    }


    public function editar2()
    {
        $model = new ComercioModel();
        $id = $this->request->getVar('id');

        $data['com'] = $model->where('id', $id)->first();
        $tipo_facturacion_model = new Tipo_facturacionModel();

        $tiposFacturacion = $tipo_facturacion_model->orderBy('id', 'DESC')->findAll();


        $options = array('--Select--');

        foreach ($tiposFacturacion as $row) {
            $options[$row['id']] = $row['tipo_facturacion'];
        }
        $data['optionsTipoFacturacion'] = $options;

        return view('comercios_editView2', $data);
    }

    public function editar4()
    {
        $model = new ComercioModel();
        $id = $this->request->getVar('id');

        $data['com'] = $model->where('id', $id)->first();
        $tipo_facturacion_model = new Tipo_facturacionModel();

        $tiposFacturacion = $tipo_facturacion_model->orderBy('id', 'DESC')->findAll();


        $options = array('--Select--');

        foreach ($tiposFacturacion as $row) {
            $options[$row['id']] = $row['tipo_facturacion'];
        }
        $data['optionsTipoFacturacion'] = $options;

        return view('comercios_editView4', $data);
    }

    public function update()
    {



        $model = new ComercioModel();

        $nombre_comercial = $this->request->getVar('nombre_comercial');
        $razon_social = $this->request->getVar('razon_social');

        $cif_nif_nie = $this->request->getVar('cif_nif_nie');
        $telefono = $this->request->getVar('telefono');
        $email = $this->request->getVar('email');
        $persona_contacto = $this->request->getVar('persona_contacto');
        //$file_logo=$this->request->getVar('file_logo');
        $id_tipo_facturacion = $this->request->getVar('id_tipo_facturacion');
        $updated_at = date('Y-m-d h:i:s');




        $model->where('id', $this->request->getVar('id'))
            ->set(['nombre_comercial' => $nombre_comercial, 'razon_social' => $razon_social, 'cif_nif_nie' => $cif_nif_nie, 'telefono' => $telefono, 'email' => $email, 'persona_contacto' => $persona_contacto, 'id_tipo_facturacion' => $id_tipo_facturacion, 'updated_at' => $updated_at])
            ->update();


        if ($this->request->getFile('file_logo') != "") {

            $file_logo = $this->request->getFile('file_logo');
            $ext = $file_logo->guessExtension();
            $nameImgFile = "Comercio_" . $this->request->getVar('id') . "." . $ext;

            $comercio_ANt = $model->where('id', $this->request->getVar('id'))->first();
            if (file_exists(ROOTPATH . "/" . $comercio_ANt["file_logo"])) {
                unlink(ROOTPATH . "/" . $comercio_ANt["file_logo"]);
            }

            $file_logo->move(ROOTPATH . 'public/uploads', $nameImgFile);
            $filepath = 'public/uploads/' . $nameImgFile;
            $model->where('id', $this->request->getVar('id'))
                ->set(['file_logo' => $filepath])
                ->update();
        }

        echo 1;



        /*$data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 
        
        return view('agencias', $data);*/
    }


    public function update2()
    {
        $rules = [
            'nombre_comercial' => [
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir un nombre comercial.',
                ]
            ],
            'razon_social' => [
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir una razon social.',
                ]
            ],
            'cif_nif_nie' => [
                'rules'  => 'required|max_length[25]|validDniCifNie',
                'errors' => [
                    'required' => 'Debes introduccir un cif/nif/nie válido.',
                ]
            ],

            'telefono' => [
                'rules'  => 'required|max_length[25]',
                'errors' => [
                    'required' => 'Debes introduccir un teléfono.',
                ]
            ],
            'email' => [
                'rules'  => 'required|valid_email|trim|max_length[150]',
                'errors' => [
                    'required' => 'Debes introduccir un email.',
                    'valid_email' => 'Debes introduccir un email válido.',
                ]
            ],
            'id_tipo_facturacion' => [
                'rules'  => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Debes elegir un tipo facturación.',
                ]
            ],

            'file_logo' => [

                'rules' => 'uploaded[file_to_upload]',

                'errors' => [
                    'required' => 'Vacío',

                ]
            ],


        ];



        $data = $this->request->getPost($this->getDataKeys($rules));

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput();
        }

        $model = new ComercioModel();

        $nombre_comercial = $this->request->getVar('nombre_comercial');
        $razon_social = $this->request->getVar('razon_social');

        $cif_nif_nie = $this->request->getVar('cif_nif_nie');
        $telefono = $this->request->getVar('telefono');
        $email = $this->request->getVar('email');
        $persona_contacto = $this->request->getVar('persona_contacto');
        //$file_logo=$this->request->getVar('file_logo');
        $id_tipo_facturacion = $this->request->getVar('id_tipo_facturacion');
        $updated_at = date('Y-m-d h:i:s');




        $model->where('id', $this->request->getVar('id'))
            ->set(['nombre_comercial' => $nombre_comercial, 'razon_social' => $razon_social, 'cif_nif_nie' => $cif_nif_nie, 'telefono' => $telefono, 'email' => $email, 'persona_contacto' => $persona_contacto, 'id_tipo_facturacion' => $id_tipo_facturacion, 'updated_at' => $updated_at])
            ->update();


        if ($this->request->getFile('file_logo') != "") {

            $file_logo = $this->request->getFile('file_logo');
            $ext = $file_logo->guessExtension();
            $nameImgFile = "Comercio_" . $this->request->getVar('id') . "." . $ext;

            $comercio_ANt = $model->where('id', $this->request->getVar('id'))->first();
            if (file_exists(ROOTPATH . "/" . $comercio_ANt["file_logo"])) {
                unlink(ROOTPATH . "/" . $comercio_ANt["file_logo"]);
            }

            $file_logo->move(ROOTPATH . 'public/uploads', $nameImgFile);
            $filepath = 'public/uploads/' . $nameImgFile;
            $model->where('id', $this->request->getVar('id'))
                ->set(['file_logo' => $filepath])
                ->update();
        }

        //   echo 1;



        $data['comercios'] = $model->listaComercios();
        // $data['query']=$model->listaComerciosBuilder();
        $data['query'] = $model->listaComerciosBuilderQuery();

        return view('comerciosView', $data);
    }



    public function update4()
    {
        $rules = [
            'nombre_comercial' => [
                'rules'  => 'required|max_length[1]',
                'errors' => [
                    'required' => 'Debes introduccir un nombre comercial.',
                ]
            ],
            'cif_nif_nie' => [
                'rules'  => 'required|max_length[25]|validDniCifNie',
                'errors' => [
                    'required' => 'Debes introduccir un cif/nif/nie válido.',
                ]
            ],

        ];



        $data = $this->request->getPost($this->getDataKeys($rules));

        if (! $this->validateData($data, $rules)) {
            echo 0;
            return;
        }

        $model = new ComercioModel();

        $nombre_comercial = $this->request->getVar('nombre_comercial');
        $razon_social = $this->request->getVar('razon_social');

        $cif_nif_nie = $this->request->getVar('cif_nif_nie');
        $telefono = $this->request->getVar('telefono');
        $email = $this->request->getVar('email');
        $persona_contacto = $this->request->getVar('persona_contacto');
        //$file_logo=$this->request->getVar('file_logo');
        $id_tipo_facturacion = $this->request->getVar('id_tipo_facturacion');
        $updated_at = date('Y-m-d h:i:s');




        $model->where('id', $this->request->getVar('id'))
            ->set(['nombre_comercial' => $nombre_comercial, 'razon_social' => $razon_social, 'cif_nif_nie' => $cif_nif_nie, 'telefono' => $telefono, 'email' => $email, 'persona_contacto' => $persona_contacto, 'id_tipo_facturacion' => $id_tipo_facturacion, 'updated_at' => $updated_at])
            ->update();


        if ($this->request->getFile('file_logo') != "") {

            $file_logo = $this->request->getFile('file_logo');
            $ext = $file_logo->guessExtension();
            $nameImgFile = "Comercio_" . $this->request->getVar('id') . "." . $ext;

            $comercio_ANt = $model->where('id', $this->request->getVar('id'))->first();
            if (file_exists(ROOTPATH . "/" . $comercio_ANt["file_logo"])) {
                unlink(ROOTPATH . "/" . $comercio_ANt["file_logo"]);
            }

            $file_logo->move(ROOTPATH . 'public/uploads', $nameImgFile);
            $filepath = 'public/uploads/' . $nameImgFile;
            $model->where('id', $this->request->getVar('id'))
                ->set(['file_logo' => $filepath])
                ->update();
        }

        echo 1;




        return;
    }

    public function eliminar()
    {
        $model = new ComercioModel();



        if ($model->where('id', $this->request->getVar('id'))->delete()) echo 1;
        else echo 0;


        // $data['agencies'] = $model->orderBy('id', 'DESC')->findAll(); 

        //return view('agencias', $data);


    }



    private function getDataKeys(array $rules): array
    {
        /*unset($rules['fruit.*']);
        $rules['fruit'] = '';*/

        return array_keys($rules);
    }

    function exportar()
    {
        //['nombre_comercial', 'razon_social', 'cif_nif_nie', 'telefono', 'email', 'persona_contacto', 'file_logo', 'id_tipo_facturacion', 'created_at', 'updated_at'];
        $comercioObject = new ComercioModel();

        $data = $comercioObject->findAll();
        //$data['query'] = $comercioObject->listaComerciosBuilder(); COMPROBAR, DA ERROR

        $file_name = 'Comercio.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        //$sheet->setCellValue('A1', 'Id');

        $sheet->setCellValue('B1', 'nombre_comercial');

        $sheet->setCellValue('C1', 'razon_social');

        $sheet->setCellValue('D1', 'cif_nif_nie');
        $sheet->setCellValue('F1', 'telefono');
        $sheet->setCellValue('G1', 'email');
        $sheet->setCellValue('H1', 'persona_contacto');
        $sheet->setCellValue('H1', 'id_tipo_facturacion');
        $sheet->setCellValue('H1', 'created_at');
        $sheet->setCellValue('H1', 'updated_at');

        $count = 2;

        foreach ($data as $row) {
            $sheet->setCellValue('A' . $count, $row['id']);

            $sheet->setCellValue('B' . $count, $row['nombre_comercial']);

            $sheet->setCellValue('C' . $count, $row['razon_social']);

            $sheet->setCellValue('D' . $count, $row['cif_nif_nie']);
            $sheet->setCellValue('F' . $count, $row['telefono']);
            $sheet->setCellValue('G' . $count, $row['email']);
            $sheet->setCellValue('H' . $count, $row['persona_contacto']);
            $sheet->setCellValue('H' . $count, $row['id_tipo_facturacion']);
            $sheet->setCellValue('H' . $count, $row['created_at']);
            $sheet->setCellValue('H' . $count, $row['updated_at']);

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
        $model = new ComercioModel();
        $path             = 'public/documents/Comercio/';
        $path2             = 'public\documents\Comercio';
        $json             = [];

        if ($this->request->getFile('file') != "") {

            $file = $this->request->getFile('file');
            $extension = $file->guessExtension();
            $nameFile = "Comercio." . $extension;
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
            //`id`, `nombre_comercial`, `razon_social`, `cif_nif_nie`, `telefono`, `email`, `persona_contacto`, `file_logo`, `id_tipo_facturacion`, `created_at`, `updated_at`
            foreach ($sheet_data as $key => $val) {
                if ($key != 0) {
                    $result     = $model->getComercio(["id" => $val[0]]);
                    if ($result) {
                    } else {
                        $list[] = [
                            'id'                    => $val[0],
                            'nombre_comercial'           => $val[1],
                            'razon_social'               => $val[2],
                            'cif_nif_nie'                => $val[3],
                            'telefono'                   => $val[4],
                            'email'                      => $val[5],
                            'persona_contacto'           => $val[6],
                            
                            'id_tipo_facturacion'        => $val[7],                            
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
}
