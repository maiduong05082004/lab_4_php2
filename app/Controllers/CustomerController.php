<?php
namespace App\Controllers;

use App\Models\CustomerModel;

class CustomerController extends BaseController{
    public function list(){
        $customers = CustomerModel::all();
        $this->render('listCustomer',compact('customers'));
    }
    public function add() {
        $customers = CustomerModel::all();
        $this->render('addCustomer',compact('customers'));
    }
    public function store(){
        $data=$_POST;
        $errors=[];
        if(empty($data['fullName'])) {
            $errors[] = "Tên không được để trống";
        }
        if(empty($data['email'])) {
            $errors[] = "Email không được để trống";
        } elseif (!preg_match("/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i", $data['email'])) {
            $errors[] = "Email không hợp lệ";
        }
        if(empty($data['birthday'])) {
            $errors[] = "ngày sinh không được để trống";
        }
        if(empty($data['address'])) {
            $errors[] = "address không được để trống";
        }
        $file = $_FILES['avatar'];
        $image_name=$file['name'];
        move_uploaded_file($file['tmp_name'],"assets/img/".$image_name);
        $data['avatar']=$image_name;
        if (count($errors) >= 1) {
            echo "<script>alert('";
            foreach ($errors as $error) {
                echo $error ."\\n";
            }
            echo "');window.location.href= '" . BASE_URL . "customers/add_customers';</script> ";
            return;
        }
        
        CustomerModel::insert($data);
        header("location:".BASE_URL."customers/list_customers");
    }
}