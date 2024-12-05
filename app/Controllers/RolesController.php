<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\RoleModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RolesController extends Controller
{
    
     protected $helpers = ['form'];
    
   
    
    
    public function index()
{    
  $model = new RoleModel(); 
        
        $data['roles'] = $model->orderBy('id', 'DESC')->findAll(); 
        
        return view('rolesView', $data);
}
    
    
public function nuevo()
{    
         
        return view('roles_newView');
}  
    
public function save()
{    
    
     $rules = [
            'role' => [
            'rules'  => 'required|is_unique[roles.role]',
            'errors' => [
                'required' => 'Debes introduccir un role.',
                'is_unique' => 'El nombre de role ya existe.',
            ]]
        
        ];
        
       

        $data = $this->request->getPost(array_keys($rules));

        if (! $this->validateData($data, $rules)) {
            
            return $this->validateDataErrores($data, $rules);
        }
    
    
    
    
                $model = new RoleModel();
				$newData = [
					'role' 	=> $this->request->getVar('role')
					
				];
    
				if($model->save($newData)) echo 1;
                 else echo 0;
     
 
}  
    
    public function editar()
{    
         $model = new RoleModel();
        $id=$this->request->getVar('id');
               
         $data['rol'] = $model->where('id', $id)->first(); 
        
        return view('roles_editView', $data);
}  
 public function update()
{    
            
     
     $id=$this->request->getVar('id');
     $role=$this->request->getVar('role');
     
     $model = new RoleModel();
     $rol = $model->where('id', $id)->first(); 
     
     if($role==$rol["role"]){
          $rules = [
            'role' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Debes introduccir un role.',
            ]]
        
        ];
     }else{
     
       $rules = [
            'role' => [
            'rules'  => 'required|is_unique[roles.role]',
            'errors' => [
                'required' => 'Debes introduccir un role.',
                'is_unique' => 'El nombre de role ya existe.',
            ]]
        
        ];
     }
       

        $data = $this->request->getPost(array_keys($rules));

        if (! $this->validateData($data, $rules)) {
            
            return $this->validateDataErrores($data, $rules);
        }
     
            
   
     
            if($model->where('id', $this->request->getVar('id'))
						->set(['role' => $role])
						->update()) echo 1;
            else echo 0;
            
}     
    
public function eliminar()
{    
             $model = new RoleModel();
     
           
     
           $model->where('id', $this->request->getVar('id'))->delete();
    
        echo 1;
}     
    
    
    
 function exportar()
	{
		$role_object = new RoleModel();

		$data = $role_object->findAll();

		$file_name = 'data.xlsx';

		$spreadsheet = new Spreadsheet();

		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'Id');

		$sheet->setCellValue('B1', 'Role');

		$sheet->setCellValue('C1', 'Creado');

		$sheet->setCellValue('D1', 'Actualizado');

		$count = 2;

		foreach($data as $row)
		{
			$sheet->setCellValue('A' . $count, $row['id']);

			$sheet->setCellValue('B' . $count, $row['role']);

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
    
    
    
    
   public function importar() {
        $model = new RoleModel();
		$path 			= 'public/documents/roles2/';
        $path2 			= 'public\documents\roles2';
		$json 			= [];
	
       if($this->request->getFile('file')!=""){
                       
                       $file = $this->request->getFile('file');
                        $extension = $file->guessExtension();
                        $nameFile= "Roles_2.".$extension;
                        $file->move(ROOTPATH.$path,$nameFile);
                       
                     
       $nameFile=ROOTPATH.$path2."\\".$nameFile;
		/*$arr_file 		= explode('.', $file_name);
		$extension 		= end($arr_file);*/
		if('csv' == $extension) {
			$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else {
			$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
           
    $spreadsheet 	= $reader->load($nameFile);
	$sheet_data 	= $spreadsheet->getActiveSheet()->toArray();

		$list 			= [];
		foreach($sheet_data as $key => $val) {
			if($key != 0) {
				$result 	= $model->getRole(["role" => $val[1]]);
				if($result) {
				} else {
					$list [] = [
						'id'					=> $val[0],
						'role'			=> $val[1],
						'created_at' 			=>  date("Y-m-d H:i:s"),
						'updated_at' 			=>  date("Y-m-d H:i:s"),
					];
				}
			}
		}
           

		//if(file_exists($nameFile))
			//unlink($nameFile);
		if(count($list) > 0) {
			$result 	= $model->bulkInsert($list);
			if($result) {
				$json = [
					'success_message' 	=> 'showSuccessMessage("All Entries are imported successfully.")'
				];
			} else {
				$json = [
					'error_message' 	=> 'showErrorMessage("Something went wrong. Please try again.")'
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