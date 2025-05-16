<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        helper(['form']);
        echo view('auth/login');
    }

    public function loginAuth()
{
    $session = session();
    $userModel = new UserModel();

    $user_name = $this->request->getPost('user_name');
    $password = $this->request->getPost('password');

    $user = $userModel->where('user_name', $user_name)->first();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $ses_data = [
                'user_id' => $user['id'],
                'user_name' => $user['user_name'],
                'name' => $user['name'],
                'logged_in' => true,
            ];
            $session->set($ses_data);
            return redirect()->to('/employee');
        } else {
            $session->setFlashdata('msg', 'Incorrect password.');
            return redirect()->to('/login');
        }
    } else {
        $session->setFlashdata('msg', 'Username not found.');
        return redirect()->to('/login');
    }
}

    public function register()
    {
        helper(['form']);
        echo view('auth/register');
    }

    public function registerSave()
    {
        helper(['form']);
        $rules = [
            'name'      => 'required',
            'user_name' => 'required|is_unique[login_details.user_name]',
            'password'  => 'required|min_length[6]',
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'name'      => $this->request->getVar('name'),
                'user_name' => $this->request->getVar('user_name'),
                'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];
            $model->save($data);
            return redirect()->to('/login')->with('message', 'Registration successful. Please login.');
        } else {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
