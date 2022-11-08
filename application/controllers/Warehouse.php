<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller 
{
    public function __construct()
    {
		parent::__construct();
        if($this->session->userdata('logged_in') !== TRUE) {
			redirect('Login');
		}
        

    
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('category_model');
        $this->load->model('inventory_model');
	
	}
	public function index()
	{
        if($this->session->userdata('level')==='2') {
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/home');
            $this->load->view('HeaderNFooter/Footer');
		} else {
			redirect('Login');
        }
        // $this->load->view('HeaderNFooter/Header');
		// $this->load->view('Pages/home');
        // $this->load->view('HeaderNFooter/Footer');
	}
    // public function category()
	// { 
    //     $this->load->view('HeaderNFooter/Header');
	// 	   $this->load->view('Pages/category');
    //     $this->load->view('HeaderNFooter/Footer');
	// }
    
    //edit page
    public function edit($id = "")
    {
        //load data
        $data['products'] = $this->inventory_model->getProductDataById($this->uri->segment(3));
        $data['array'] = $this->category_model->getCategoryName();
       
        // $this->session->set_flashdata('prodId',$this->uri->segment(3));
        // // echo $this->session->flashdata('prodId');
       
        //form validations
         $this->form_validation->set_rules('productNameForm', 'Product Name' ,'required|max_length[30]');
         $this->form_validation->set_rules('productCategoryForm', 'Product Category' ,'required|max_length[30]');
         $this->form_validation->set_rules('productQuantityForm', 'Product Quantity' ,'required|max_length[30]');
         $this->form_validation->set_rules('productConditionForm', 'Product Condition' ,'required|max_length[30]');
         $this->form_validation->set_rules('DateTimeForm', 'Date' ,'required|max_length[30]');

        //get Data
        $data['document'] = (object)$postData = array(
            'productId' => $this->input->post('productIdField'),
            'productName' => $this->input->post('productNameForm'),
            'productCategory' => $this->input->post('productCategoryForm'),
            'productQuantity' => $this->input->post('productQuantityForm'),
            'productCondition' => $this->input->post('productConditionForm'),
            'DateTime' => $this->input->post('DateTimeForm'),
            
        );

        //save data
        if($this->form_validation->run() === true){
            
            if($this->inventory_model->updateProductRecord($postData)){
                $this->session->set_flashdata('success','Update Success');             
            }
            else{
                $this->session->set_flashdata('error','Update Failed');
             
            }
            redirect('products');
        }
       
        else{
            if(validation_errors()){
                $this->session->set_flashdata('error',validation_errors());
                redirect('main/edit/'.$postData['productId']);
            }
           else{
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/productseditpage',  $data);
            $this->load->view('HeaderNFooter/Footer'); 
           }
        }
      
    }

    public function delete($data)
    {
        // $data = $this->get('');
        if($this->inventory_model->deleteProducts($data)){
            $this->session->set_flashdata('success','Delete Success');
         }
         else{
            $this->session->set_flashdata('error','Delete Failed');
         }
        redirect('products');
    }

    //get products that is entered in the database
    public function getProducts()
    {
      $products = $this->inventory_model->productList();
      $json_data['data'] = $products;
      echo json_encode($json_data);
    }

    public function products()
	{ 
         // form validation
         $this->form_validation->set_rules('productNameForm', 'Product Name' ,'required|max_length[30]');
         $this->form_validation->set_rules('productCategoryForm', 'Product Category' ,'required|max_length[30]');
         $this->form_validation->set_rules('productQuantityForm', 'Product Quantity' ,'required|max_length[30]');
         $this->form_validation->set_rules('productConditionForm', 'Product Condition' ,'required|max_length[30]');
         $this->form_validation->set_rules('DateTimeForm', 'Date' ,'required|max_length[30]');

        $data['array'] = $this->category_model->getCategoryName();
        
        //create new product
        $data['document'] = (object)$postData = array(
            'productId' => "PRD-".$this->randStrGen(2,7),
            'productName' => $this->input->post('productNameForm'),
            'productCategory' => $this->input->post('productCategoryForm'),
            'productQuantity' => $this->input->post('productQuantityForm'),
            'productCondition' => $this->input->post('productConditionForm'),
            'DateTime' => $this->input->post('DateTimeForm'),
        );
        
        //add products
         if($this->form_validation->run() === true){ 
             if($this->inventory_model->create($postData)){
                $this->session->set_flashdata('success','Add Success');
             }
             else{
                $this->session->set_flashdata('error','Add Failed');
             }
             redirect('products');
         }          
         else{
             $this->load->helper('form');
             $this->load->view('HeaderNFooter/Header');
             $this->load->view('Pages/products',$data);
             $this->load->view('HeaderNFooter/Footer');
         }

	}
    public function report()
	{
        $this->load->view('HeaderNFooter/Header');
		$this->load->view('Pages/report');
        $this->load->view('HeaderNFooter/Footer');
	}
    public function scan()
	{
        $this->load->view('HeaderNFooter/Header');
		$this->load->view('Pages/scan');
        $this->load->view('HeaderNFooter/Footer');
	}
    public function category()
	{
        $this->load->view('HeaderNFooter/Header');
		$this->load->view('Pages/category');
        $this->load->view('HeaderNFooter/Footer');
	}

    public function approveproducts()
	{
        $this->load->view('HeaderNFooter/Header');
		$this->load->view('Pages/approveproducts');
        $this->load->view('HeaderNFooter/Footer');
	}

    public function reqproducts()
	{
        $this->load->view('HeaderNFooter/Header');
		$this->load->view('Pages/reqproducts');
        $this->load->view('HeaderNFooter/Footer');
	}
    public function notifications()
	{
        $this->load->view('HeaderNFooter/Header');
		$this->load->view('Pages/notifications');
        $this->load->view('HeaderNFooter/Footer');
	}

    //random id generator
    public function randStrGen($mode = null, $len = null){
        $result = "";
        if($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 4):
            $chars = "0123456789";
        endif;

        $charArray = str_split($chars);
        for($i = 0; $i <= $len; $i++) {
                $randItem = array_rand($charArray);
                $result .="".$charArray[$randItem];
        }
        return $result;
    }

    // public function create(){
    //     $this->load->helper('url');
    //     $this->load->model('inventory_model');
    //     $this->inventory_model->insertProductRecord();
    //     redirect('');
    // }


    // public function home(){
        
    //     $this->load->view('header');
    //     $this->load->view('home');
    //     $this->load->view('footer');
    // }
    // public function products(){
    //     $this->load->view('header');
    //     $this->load->view('products');
    //     $this->load->view('footer');

    // }
}
