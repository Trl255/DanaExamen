<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MessageController extends BaseController
{
    public function index()
    {
        //
    }
    
    public function showSweetAlertMessages()
	{
		// Flash messages settings
		session()->setFlashdata("success", "This is success message");
		session()->setFlashdata("warning", "This is warning message");
		session()->setFlashdata("info", "This is information message");
		session()->setFlashdata("error", "This is error message");
		return view("sweetalert-notification");
	}
    
    
    public function showDeleteAlertMessages()
	{
		
            
        $data['id'] = $this->request->getVar('id'); 
        $data['controlador'] = $this->request->getVar('controlador');
        
            
		return view("sweetalert-delete",$data);
	}
    
     public function showInfoTimerIntervalAlertMessages()
	{
        if($this->request->getVar('respuesta')==1){
            $mensaje="Actualizado correctamente";
             $data['error']=0;
        }else{
            $mensaje="NO Actualizado correctamente";
             $data['error']=1;
        }
            
        $data['mensaje'] = $mensaje; 
        $data['controlador'] = $this->request->getVar('controlador');
       
        
            
		return view("sweetalert-info",$data);
	}
    
     public function showInfoAlertMessages()
	{
        if($this->request->getVar('respuesta')==1){
            $mensaje="Actualizado correctamente";
             $data['error']=0;
        }else if($this->request->getVar('respuesta')==0){
              $mensaje="NO Actualizado correctamente";
             $data['error']=1;
        }else{
            
            $mensaje=$this->request->getVar('respuesta');
             $data['error']=1;
        }
            
        $data['mensaje'] = $mensaje; 
        $data['controlador'] = $this->request->getVar('controlador');
       
        
            
		return view("sweetalert-info",$data);
	}
}
