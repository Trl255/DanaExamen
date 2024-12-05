<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UserModel;
  
class SigninController extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('signin');
    } 
  
    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
       // $data = $userModel->where('email', $email)->first();
        
        
        $data = $userModel->join('roles','users.id_roles=roles.id')
            ->select('users.id_user,users.firstname,users.password, users.lastname, users.email, users.act_user, roles.role')
            ->where('email', $email)
            ->orderBy('id', 'DESC')->first();
        
        
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                //SELECT `id_user`, `act_user`, `firstname`, `lastname`, `email`, `password`, `created_at`, `updated_at` FROM `users` WHERE 1
                $ses_data = [
                    'id' => $data['id_user'],
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'email' => $data['email'],
                    'act_user' => $data['act_user'],
                    'role' => $data['role'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/profile');
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/signin');
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/signin');
        }
    }
}