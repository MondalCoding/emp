<?php namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'emp_details';
    protected $allowedFields = ['name', 'address', 'designation', 'salary', 'picture'];
}
