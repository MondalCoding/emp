<?php namespace App\Controllers;

use App\Models\EmployeeModel;
use CodeIgniter\Controller;

class Employee extends Controller
{
    public function __construct()
{
    helper(['url']);
    if (!session()->get('logged_in')) {
        header('Location: /login');
        exit;
    }
}

    public function index()
    {
        $model = new EmployeeModel();
        $data['employees'] = $model->findAll();
        return view('employee/list', $data);
    }

    public function create()
    {
        helper(['form']);
    return view('employee/add');
    }

    public function store()
{
    helper(['form', 'url']);

    $validationRules = [
        'name'        => 'required|min_length[3]',
        'address'     => 'required',
        'designation' => 'required',
        'salary'      => 'required|numeric',
        'picture'     => [
            'rules'  => 'uploaded[picture]|is_image[picture]|max_size[picture,2048]',
            'errors' => [
                'uploaded' => 'The picture field is required.',
                'is_image' => 'Only images are allowed.',
                'max_size' => 'Image must be less than 2MB.'
            ]
        ]
    ];

    if (!$this->validate($validationRules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $employeeModel = new \App\Models\EmployeeModel();

    $imageFile = $this->request->getFile('picture');
    $imageName = '';

    if ($imageFile->isValid() && !$imageFile->hasMoved()) {
        $imageName = $imageFile->getRandomName();
        $imageFile->move(ROOTPATH . 'public/uploads', $imageName);
    }

    $data = [
        'name'        => $this->request->getPost('name'),
        'address'     => $this->request->getPost('address'),
        'designation' => $this->request->getPost('designation'),
        'salary'      => $this->request->getPost('salary'),
        'picture'     => $imageName,
    ];

    $employeeModel->save($data);

    return redirect()->to('/employee')->with('msg', 'Employee added successfully.');
}

    public function edit($id)
    {
        helper(['form']);
        $model = new EmployeeModel();
        $employee = $model->find($id);
        if ($this->request->getMethod() === 'post') {
            $data = [
                'name' => $this->request->getPost('name'),
                'address' => $this->request->getPost('address'),
                'designation' => $this->request->getPost('designation'),
                'salary' => $this->request->getPost('salary')
            ];
            $file = $this->request->getFile('picture');
            if ($file->isValid() && !$file->hasMoved()) {
                $name = $file->getRandomName();
                $file->move('public/uploads', $name);
                $data['picture'] = $name;
            }
            $model->update($id, $data);
            return redirect()->to('/employee');
        }
        return view('employee/edit', ['employee' => $employee]);
    }

    public function update($id)
{
    helper(['form']);

    $model = new \App\Models\EmployeeModel();

    $data = [
        'name'        => $this->request->getPost('name'),
        'address'     => $this->request->getPost('address'),
        'designation' => $this->request->getPost('designation'),
        'salary'      => $this->request->getPost('salary'),
    ];

    
    $file = $this->request->getFile('picture');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $imageName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads', $imageName);
        $data['picture'] = $imageName;
    }

    $model->update($id, $data);

    return redirect()->to('/employee')->with('msg', 'Employee updated successfully.');
}

    public function delete($id)
{
    $model = new \App\Models\EmployeeModel();

    
    $employee = $model->find($id);
    if ($employee && !empty($employee['picture'])) {
        $filePath = ROOTPATH . 'public/uploads/' . $employee['picture'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    $model->delete($id);
    return redirect()->to('/employee')->with('msg', 'Employee deleted successfully.');
}
}
