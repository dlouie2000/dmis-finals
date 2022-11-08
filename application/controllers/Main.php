<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller 
{
    public function __construct()
    {
		parent::__construct();
        if($this->session->userdata('logged_in') !== TRUE) {
			redirect('Login');
		}

        date_default_timezone_set('Asia/Singapore');
		$this->load->helper('url');
		$this->load->library('session');
        
        //create models
        $this->load->model('category_model');
        $this->load->model('subcategory_model');
        $this->load->model('inventory_model');
        $this->load->model('reqproduct_model');
        $this->load->model('size_model');
        $this->load->model('brand_model');
        $this->load->model('color_model');
        $this->load->model('location_model');

        $this->load->model('dynamic_dependent_model');
        $this->load->model('dynamic_dependent_models');


        $this->load->model('dashboard_model');
        $this->load->model('usermanagement_model');
        $this->load->model('Login_model');
        $this->load->model('role_model');
        $this->load->model('report_model');
        $this->load->model('charts_model');

	}
    
    //sample


    function fetch_subcategory()
    {
            if($this->input->post('categoryId'))
        {
            echo $this->dynamic_dependent_models->fetch_subcategory($this->input->post('categoryId'));
        }
    }

    function fetch_subcategoryedit()
    {
            if($this->input->post('categoryId'))
        {
            echo $this->dynamic_dependent_models->fetch_subcategoryedit($this->input->post('categoryId'),($this->input->post('subcategoryId')));
        }
    }


    //end


	public function index()
	{
        $data['barang'] = $this->db->get('reqproductrecord')->result_array();
        $data['notif'] = $this->inventory_model->notification();
        $data['top'] = $this->reqproduct_model->topRequestedProducts();

        $data['stock'] = $this->dashboard_model->totalStockQuantity();
        $data['request'] = $this->dashboard_model->requestToBeApproved();
        $data['released'] = $this->dashboard_model->totalProductsReleased();
        $data['totNum'] = $this->dashboard_model->totalNumberOfProducts();
        // $this->load->view('Pages/notifications', $data);

        if($this->session->userdata('level')==='1') {
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/home', $data); //homeee ... 
            $this->load->view('HeaderNFooter/Footer');
            // $this->load->view('Pages/reqproducts', $data);
            // $data['notifs'] = $this->db->get('tbl_notif')->result_array();
            // $this->load->view('Pages/notifications', $data);
		} 
        elseif($this->session->userdata('level')==='2') {
            $this->load->view('HeaderNFooter/Header');
            // $this->load->view('Pages/home', $data);
            $this->load->view('HeaderNFooter/Footer');
            $this->load->view('Pages/reqproducts', $data);
            // $data['notifs'] = $this->db->get('tbl_notif')->result_array();
            // $this->load->view('Pages/notifications', $data);
        }

        else {
            redirect('Login');
        }
			
        // $this->load->view('HeaderNFooter/Header');
		// $this->load->view('Pages/home');
        // $this->load->view('HeaderNFooter/Footer');
	}

    
    //request products page/request product and have a pending status
    public function reqproducts()
	{
        $data['products'] = $this->inventory_model->getProductDataById($this->uri->segment(3));

        
        //form validations
        $this->form_validation->set_rules('reqproductQuantityForm', 'Product Quantity' ,'required|max_length[30]');
        $this->form_validation->set_rules('reqDateTimeForm', 'Date' ,'required|max_length[30]');
        
        $reqId = "REQPRD-".$this->randStrGen(2,7);

        //create request form
        $data['document'] = (object)$postData = array(
            'reqproductId' => $reqId,
            'productId' => $this->input->post('productIdField'),
            'reqproductQuantity' => $this->input->post('reqproductQuantityForm'),
            'reqDateTime' => $this->input->post('reqDateTimeForm'),
            'reqproductStatus' => "Pending",
            'approveDateTime' => "Pending",
        );

        $product = $this->db->get_where('reqproductrecord')->row_array();


    

        if($this->form_validation->run() === true){ 
            if($this->reqproduct_model->createrequest($postData)){
                
                //send email prompt
                $this->load->library('email');            
                $config = array();
                $config['protocol'] = 'smtp';
                $config['smtp_host'] = 'ssl://smtp.gmail.com';
                $config['smtp_user'] = 'testingwebsitedoodles@gmail.com';
                $config['smtp_pass'] = 'ljaoafizmicauggp';
                $config['smtp_port'] = 465;
                $config['crlf'] = '\r\n';
                $config['newline'] = '\r\n';
                $config['mailtype'] = "html";
                $config['smtp_timeout'] = '60';
        
                $this->email->initialize($config);
                $this->email->set_newline("\r\n");  
        
                $this->email->to('testingwebsitedoodles@gmail.com');
                $this->email->from('testingwebsitedoodles@gmail.com');
                $this->email->subject('REQUEST PRODUCT ID: ' . $reqId);
                $emailInfo['reqId'] = $reqId;
                $emailInfo['createDate'] = date('Y-m-d');
                $emailInfo['content'] = $this->db->select('*')->where('reqproductId',$reqId)->get('reqproductrecord')->result();
                $body = $this->load->view('EmailTemplates/RequestEmailTemp.php',$emailInfo,TRUE);
                $this->email->message($body);
        
                $this->email->send();

                $this->session->set_flashdata('success','Request Success');
                $notifs = [

                    'title' => 'Requested a Product!',
                    // 'message' => 'Product ' . $product['productId'] . ' is requested' . ' by the Warehouse' . '.', 'is_read' => 0
                    'message' => 'Product ' . $product['productId'] . ' is requested by' . ' the Warehouse' . '.', 'is_read' => 0
                    
                ];
        
                $this->db->insert('tbl_notif', $notifs);
            }
            else{
               $this->session->set_flashdata('error','Request Failed');
            }
            redirect('reqproducts');
        }          
        else{
            $this->load->helper('form');
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/reqproducts', $data);
            $this->load->view('HeaderNFooter/Footer');
        }
	}


    //approve products page/approve products and error statement wherein user cant exceeds in product stock
    public function approve()
    {
        $reqId = $this->uri->segment(3);

        $data['document'] = (object)$postData = array(
            'reqproductId' => $reqId,
            'reqproductStatus' => "Approved", 
            'approveDateTime' => date('Y-m-d H:i:s'), 
        );



        $status = $this->reqproduct_model->updateReqproductRecord($postData);
        
        if($status === TRUE){
            //send email prompt
            $this->load->library('email');            
                $config = array();
                $config['protocol'] = 'smtp';
                $config['smtp_host'] = 'ssl://smtp.gmail.com';
                $config['smtp_user'] = 'testingwebsitedoodles@gmail.com';
                $config['smtp_pass'] = 'ljaoafizmicauggp';
                $config['smtp_port'] = 465;
                $config['crlf'] = '\r\n';
                $config['newline'] = '\r\n';
                $config['mailtype'] = "html";
                $config['smtp_timeout'] = '60';
        
                $this->email->initialize($config);
                $this->email->set_newline("\r\n");  
        
                $this->email->to('testingwebsitedoodles@gmail.com');
                $this->email->from('testingwebsitedoodles@gmail.com');
            $this->email->subject('APPROVED REQUEST PRODUCT ID: ' . $reqId);
            $emailInfo['reqId'] = $reqId;
            $emailInfo['createDate'] = date('Y-m-d');
            $emailInfo['content'] = $this->db->select('*')->where('reqproductId',$reqId)->get('reqproductrecord')->result();
            $body = $this->load->view('EmailTemplates/ApproveEmailTemp.php',$emailInfo,TRUE);
            $this->email->message($body);
    
            $this->email->send();

            $this->session->set_flashdata('success','Success'); 

         
        }
        else if($status == 'stockError'){
            $this->session->set_flashdata('error','Request quantity exceeds Product Stock.');  
        }
        else{
            $this->session->set_flashdata('error','Failed');  
        }



        redirect('approveproducts');
    }


    //approve products page/reject products
    public function reject()
    {
        $reqId = $this->input->post('reqproductIdField');

        $data['document'] = (object)$postData = array(
            'reqproductId' => $reqId,
            'reqproductStatus' => "Rejected",   
        );
        
        if($this->reqproduct_model->rejectReqproductRecord($postData)){
             //send email prompt
             $this->load->library('email');            
             $config = array();
             $config['protocol'] = 'smtp';
             $config['smtp_host'] = 'ssl://smtp.gmail.com';
             $config['smtp_user'] = 'testingwebsitedoodles@gmail.com';
             $config['smtp_pass'] = 'ljaoafizmicauggp';
             $config['smtp_port'] = 465;
             $config['crlf'] = '\r\n';
             $config['newline'] = '\r\n';
             $config['mailtype'] = "html";
             $config['smtp_timeout'] = '60';
     
             $this->email->initialize($config);
             $this->email->set_newline("\r\n");  
     
             $this->email->to('testingwebsitedoodles@gmail.com');
             $this->email->from('testingwebsitedoodles@gmail.com');
             $this->email->subject('REJECTED REQUEST PRODUCT ID: ' . $reqId);
             $emailInfo['reqId'] = $reqId;
             $emailInfo['createDate'] = date('Y-m-d');
             $emailInfo['content'] = $this->db->select('*')->where('reqproductId',$reqId)->get('reqproductrecord')->result();
             $body = $this->load->view('EmailTemplates/RejectEmailTemp.php',$emailInfo,TRUE);
             $this->email->message($body);
     
             $this->email->send();
            $this->session->set_flashdata('error','Request Rejected');             
            }
            else{
                $this->session->set_flashdata('error','Failed');  
            }
            redirect('approveproducts');
    }

    //products page/create new product
    public function products()
	{   

        $data['category'] = $this->dynamic_dependent_model->fetch_category();
        

         // form validation
         $this->form_validation->set_rules('productNameForm', 'Product Name' ,'required|max_length[50]');
         $this->form_validation->set_rules('productCategoryForm', 'Product Category' ,'required');
         $this->form_validation->set_rules('productSubcategoryForm', 'Product Sub-Category' ,'required');
         $this->form_validation->set_rules('productSizeForm', 'Product Size' ,'required');
         $this->form_validation->set_rules('productBrandForm', 'Product Brand' ,'required');
         $this->form_validation->set_rules('productColorForm', 'Product Color' ,'required');
         $this->form_validation->set_rules('productLocationForm', 'Product Location' ,'required');
         $this->form_validation->set_rules('productQuantityForm', 'Product Quantity' ,'required|max_length[30]');
         $this->form_validation->set_rules('productConditionForm', 'Product Condition' ,'required');
         //$this->form_validation->set_rules('productImageForm', 'Product Image' ,'required|max_length[30]'); need to update
         $this->form_validation->set_rules('DateTimeForm', 'Date' ,'required|max_length[30]');

         if (empty($_FILES['productImageForm']['name'])) {
            $this->form_validation->set_rules('attachment','attachment','required');
        }

        //dropdowns
        $data['category'] = $this->dynamic_dependent_model->getCategoryName();
        $data['subcategory'] = $this->dynamic_dependent_models->getSubCategoryName();
        $data['size'] = $this->size_model->getSizeName();
        $data['brand'] = $this->brand_model->getBrandName();
        $data['color'] = $this->color_model->getColorName();
        $data['location'] = $this->location_model->getLocationName();

        $config['upload_path']   = APPPATH.'assets/attachments';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 0;
        $config['max_width']     = 0;
        $config['max_height']    = 0;
        $config['overwrite']     = true;
        
        $this->load->library('upload');
        $this->upload->initialize($config);

        $name = 'productImageForm';
        
        //create new product
        $data['document'] = (object)$postData = array(
            'productId' => "PRD-".$this->randStrGen(2,7),
            'productName' => $this->input->post('productNameForm'),
            'productCategory' => $this->input->post('productCategoryForm'),
            'productSubcategory' => $this->input->post('productSubcategoryForm'),
            'productSize' => $this->input->post('productSizeForm'),
            'productBrand' => $this->input->post('productBrandForm'),
            'productColor' => $this->input->post('productColorForm'),
            'productLocation' => $this->input->post('productLocationForm'),
            'productQuantity' => $this->input->post('productQuantityForm'),
            'productCondition' => $this->input->post('productConditionForm'),
            'DateTime' => $this->input->post('DateTimeForm'),
        );
        
        //add products
         if($this->form_validation->run() === true){
            if ( ! $this->upload->do_upload($name)){
                $this->session->set_flashdata('error', $this->upload->display_errors());       
            }
            else{

                $upload = $this->upload->data();
                $postData ['productImage'] = $upload ['file_name'];
                
                if($this->inventory_model->create($postData)){
                    $this->session->set_flashdata('success','Add Success');
                 }
                 else{
                    $this->session->set_flashdata('error','Add Failed');
                 }
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

    public function rejectpasswordmodal()
    {
    
        $this->form_validation->set_rules('rejectmodalInputPassword', 'Password' ,'required');
    
        if($this->form_validation->run() === true){
        $userdata = $this->db->select('*')->from('users_tbl')->where('userId', $this->session->userdata('userid'))->where('pin', md5($this->input->post('rejectmodalInputPassword')))->get()->result();
        if(!empty($userdata)){
                $reqId = $this->input->post('reqproductIdField');

        $data['document'] = (object)$postData = array(
            'reqproductId' => $reqId,
            'reqproductStatus' => "Rejected",
            'approveDateTime' => date('Y-m-d H:i:s'),    
        );

        $product = $this->db->get_where('reqproductrecord')->row_array();

        $notifs = [

            'title' => 'Request Rejected!',
            'message' => 'Product ' . $product['productId'] . ' is rejected' . ' by the Admin' . '.', 'is_read' => 0
            
        ];


        $this->db->insert('tbl_notif', $notifs);
        
        if($this->reqproduct_model->rejectReqproductRecord($postData)){
             //send email prompt
             $this->load->library('email');
             $config = array();
             $config['protocol'] = 'smtp';
             $config['smtp_host'] = 'ssl://smtp.gmail.com';
             $config['smtp_user'] = 'testingwebsitedoodles@gmail.com';
             $config['smtp_pass'] = 'ljaoafizmicauggp';
             $config['smtp_port'] = 465;
             $config['crlf'] = '\r\n';
             $config['newline'] = '\r\n';
             $config['mailtype'] = "html";
             $config['smtp_timeout'] = '60';
     
             $this->email->initialize($config);
             $this->email->set_newline("\r\n");  
     
             $this->email->to('testingwebsitedoodles@gmail.com');
             $this->email->from('testingwebsitedoodles@gmail.com');
             $this->email->subject('REJECTED REQUEST PRODUCT ID: ' . $reqId);
             $emailInfo['reqId'] = $reqId;
             $emailInfo['createDate'] = date('Y-m-d');
             $emailInfo['content'] = $this->db->select('*')->where('reqproductId',$reqId)->get('reqproductrecord')->result();
             $body = $this->load->view('EmailTemplates/RejectEmailTemp.php',$emailInfo,TRUE);
             $this->email->message($body);
     
            $this->email->send();
            $this->session->set_flashdata('error','Request Rejected');   
            }
            else{
                $this->session->set_flashdata('error','Failed');  
            }
            redirect('approveproducts');


            }
            else{
                $this->session->set_flashdata('error','Wrong Pin');
            }
        }
        else{
            $this->session->set_flashdata('error', validation_errors());
        }
        redirect('approveproducts'); 



    }
    
    public function approvepasswordmodal()
    {

        $this->form_validation->set_rules('approvemodalInputPassword', 'Password' ,'required');
    
        if($this->form_validation->run() === true){
            $userdata = $this->db->select('*')->from('users_tbl')->where('userId', $this->session->userdata('userid'))->where('pin', md5($this->input->post('approvemodalInputPassword')))->get()->result();
            if(!empty($userdata)){
                
                $reqId = $this->input->post('reqproductIdField');

                $data['document'] = (object)$postData = array(
                    'reqproductId' => $reqId,
                    'reqproductStatus' => "Approved", 
                    'approveDateTime' => date('Y-m-d H:i:s'), 
                );

                
                $product = $this->db->get_where('reqproductrecord')->row_array();

                $notifs = [
        
                    'title' => 'Request Approved!',
                    'message' => 'Product ' . $product['productId'] . ' is approved by' . ' the Admin' . '.', 'is_read' => 0
                    
        
        
                ];
        
                $this->db->insert('tbl_notif', $notifs);

                $status = $this->reqproduct_model->updateReqproductRecord($postData);
            
                if($status === TRUE){
                    //send email prompt
                    $this->load->library('email');            
                    $config = array();
                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'ssl://smtp.gmail.com';
                    $config['smtp_user'] = 'testingwebsitedoodles@gmail.com';
                    $config['smtp_pass'] = 'ljaoafizmicauggp';
                    $config['smtp_port'] = 465;
                    $config['crlf'] = '\r\n';
                    $config['newline'] = '\r\n';
                    $config['mailtype'] = "html";
                    $config['smtp_timeout'] = '60';
            
                    $this->email->initialize($config);
                    $this->email->set_newline("\r\n");  
            
                    $this->email->to('testingwebsitedoodles@gmail.com');
                    $this->email->from('testingwebsitedoodles@gmail.com');
                    $this->email->subject('APPROVED REQUEST PRODUCT ID: ' . $reqId);
                    $emailInfo['reqId'] = $reqId;
                    $emailInfo['createDate'] = date('Y-m-d');
                    $emailInfo['content'] = $this->db->select('*')->where('reqproductId',$reqId)->get('reqproductrecord')->result();
                    $body = $this->load->view('EmailTemplates/ApproveEmailTemp.php',$emailInfo,TRUE);
                    $this->email->message($body);
            
                    $this->email->send();

                    $this->session->set_flashdata('success','Success');   
         
                }
                else if($status == 'stockError'){
                    $this->session->set_flashdata('error','Request quantity exceeds Product Stock.');  
                }
                else{
                    $this->session->set_flashdata('error','Failed');  
                }     
            }
            else{
                $this->session->set_flashdata('error','Wrong Pin');
            }     
        }     
        else{
            $this->session->set_flashdata('error', validation_errors());
        }


        redirect('approveproducts');    
    }

    public function deletepasswordmodal() //delete with confirmation password
    {     
        $this->form_validation->set_rules('modalInputPassword', 'Password' ,'required');

        if($this->form_validation->run() === true){
            $userdata = $this->db->select('*')->from('users_tbl')->where('userId', $this->session->userdata('userid'))->where('pin', md5($this->input->post('modalInputPassword')))->get()->result();
            if(!empty($userdata)){

                $query = $this->inventory_model->getProductDataById($this->input->post('productIdField'));
                $imgfile = $query->productImage;
                

                if($this->inventory_model->deleteProducts($this->input->post('productIdField'))){
                    unlink(APPPATH.'/assets/attachments/'.$imgfile);
                    $this->session->set_flashdata('success','Delete Success');
                }
                else{
                    $this->session->set_flashdata('error','Delete Failed');
                }
                redirect('products');
            }
            else {
                $this->session->set_flashdata('error','Wrong Pin');                    
            }
        }
        else{
            $this->session->set_flashdata('error', validation_errors());
        }
        redirect('products');
    }

    //products page/edit and update product by product id
    public function edit($id = "")
    {
        //load data
        $data['products'] = $this->inventory_model->getProductDataById($this->uri->segment(3));
        $data['category'] = $this->dynamic_dependent_model->getCategoryName();
        $data['subcategory'] = $this->dynamic_dependent_models->getSubCategoryName();
        $data['size'] = $this->size_model->getSizeName();
        $data['brand'] = $this->brand_model->getBrandName();
        $data['color'] = $this->color_model->getColorName();
        $data['location'] = $this->location_model->getLocationName();

        $data['category'] = $this->dynamic_dependent_model->fetch_category();
        //$data['subcategory'] = $this->dynamic_dependent_model->fetch_subcategory();
       
        //form validations
         $this->form_validation->set_rules('productNameForm', 'Product Name' ,'required|max_length[50]');
         $this->form_validation->set_rules('productCategoryForm', 'Product Category' ,'required');
         $this->form_validation->set_rules('productSubcategoryForm', 'Product SubCategory' ,'required');
         $this->form_validation->set_rules('productSizeForm', 'Product Size' ,'required');
         $this->form_validation->set_rules('productBrandForm', 'Product Brand' ,'required');
         $this->form_validation->set_rules('productColorForm', 'Product Color' ,'required');
         $this->form_validation->set_rules('productLocationForm', 'Product Location' ,'required');
         $this->form_validation->set_rules('productQuantityForm', 'Product Quantity' ,'required|max_length[30]');
         $this->form_validation->set_rules('productConditionForm', 'Product Condition' ,'required|max_length[30]');
         $this->form_validation->set_rules('DateTimeForm', 'Date' ,'required|max_length[30]');
         $this->form_validation->set_rules('modalInputEditPassword', 'Password' ,'required');

         
         $config['upload_path']   = APPPATH.'assets/attachments';
         $config['allowed_types'] = 'gif|jpg|png';
         $config['max_size']      = 0;
         $config['max_width']     = 0;
         $config['max_height']    = 0;
         $config['overwrite']     = true;
         
         $this->load->library('upload');
         $this->upload->initialize($config);
 
         $name = 'productImageForm';
        

        //get Data
        $data['document'] = (object)$postData = array(
            'productId' => $this->input->post('productIdField'),
            'productName' => $this->input->post('productNameForm'),
            'productCategory' => $this->input->post('productCategoryForm'),
            'productSubcategory' => $this->input->post('productSubcategoryForm'),
            'productSize' => $this->input->post('productSizeForm'),
            'productBrand' => $this->input->post('productBrandForm'),
            'productColor' => $this->input->post('productColorForm'),
            'productLocation' => $this->input->post('productLocationForm'),
            'productQuantity' => $this->input->post('productQuantityForm'),
            'productCondition' => $this->input->post('productConditionForm'),
            'DateTime' => $this->input->post('DateTimeForm'),   
        );

         //save data
        if($this->form_validation->run() === true){
           $userdata = $this->db->select('*')->from('users_tbl')->where('userId', $this->session->userdata('userid'))->where('pin', md5($this->input->post('modalInputEditPassword')))->get()->result();
           if(!empty($userdata)){
                if (empty($_FILES['productImageForm']['name'])) {
                    $this->form_validation->set_rules('attachment','attachment','required');
                    
                    if($this->inventory_model->updateProductRecord($postData)){
                        $this->session->set_flashdata('success','Update Success');             
                    }
                    else{
                        $this->session->set_flashdata('error','Update Failed');  
                    }
                }
                else { 
                    if ( ! $this->upload->do_upload($name)) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());       
                    }
                    else { 

                        $upload = $this->upload->data();
                        $postData ['productImage'] = $upload ['file_name'];

                        $query = $this->inventory_model->getProductDataById($this->input->post('productIdField'));
                        $imgfile = $query->productImage;
                        unlink(APPPATH.'/assets/attachments/'.$imgfile);
                        
                        if($this->inventory_model->updateProductRecord($postData)){
                            $this->session->set_flashdata('success','Update Success');             
                        }
                        else {
                            $this->session->set_flashdata('error','Update Failed');  
                        }
                    }          
                }
           }
           else{
            $this->session->set_flashdata('error','Wrong Pin'); 
           }
            redirect('products');
        } 
        else {
            if(validation_errors()){
                $this->session->set_flashdata('error',validation_errors());
                redirect('products');
            }
           else{
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/productseditpage',  $data);
            $this->load->view('HeaderNFooter/Footer'); 
           }
        }
    }

    public function deletecategory($data)
    {
        if($this->category_model->deleteCategories($data)){
            $this->session->set_flashdata('success','Delete Success');
         }
         else{
            $this->session->set_flashdata('error','Delete Failed');
         }
        redirect('category');
    }

    public function deletesubcategory($data)
    {
        if($this->dynamic_dependent_models->deleteSubCategory($data)){
            $this->session->set_flashdata('success','Delete Success');
         }
         else{
            $this->session->set_flashdata('error','Delete Failed');
         }
        redirect('category');
    }

    public function deletesize($data)
    {
        if($this->size_model->deleteSize($data)){
            $this->session->set_flashdata('success','Delete Success');
         }
         else{
            $this->session->set_flashdata('error','Delete Failed');
         }
        redirect('category');
    }

    public function deletebrand($data)
    {
        if($this->brand_model->deleteBrands($data)){
            $this->session->set_flashdata('success','Delete Success');
         }
         else{
            $this->session->set_flashdata('error','Delete Failed');
         }
        redirect('category');
    }

    public function deletecolor($data)
    {
        if($this->color_model->deleteColor($data)){
            $this->session->set_flashdata('success','Delete Success');
         }
         else{
            $this->session->set_flashdata('error','Delete Failed');
         }
        redirect('category');
    }

    public function deletelocation($data)
    {
        if($this->location_model->deleteLocation($data)){
            $this->session->set_flashdata('success','Delete Success');
         }
         else{
            $this->session->set_flashdata('error','Delete Failed');
         }
        redirect('category');
    }

    public function deleteuser($data)
    {
        if($this->Login_model->deleteUser($data)){
            $this->session->set_flashdata('success','Delete Success');
         }
         else{
            $this->session->set_flashdata('error','Delete Failed');
         }
        redirect('usermanagement');
    }

    public function deleterole($data)
    {
        if($this->role_model->deleteRole($data)){
            $this->session->set_flashdata('success','Delete Success');
         }
         else{
            $this->session->set_flashdata('error','Delete Failed');
         }
        redirect('usermanagement');
    }

    //products page/get products that is entered in the database and load it in the table
    public function getProducts()
    {
      $products = $this->inventory_model->productList();
      $json_data['data'] = $products;
      echo json_encode($json_data);
    }

    public function getTopReqProducts()
    {
      $top = $this->reqproduct_model->topRequestedProducts();
      $json_data['data'] = $top;
      echo json_encode($json_data);
    }

    public function getTopReqCategories()
    {
      $topctrgy = $this->reqproduct_model->topRequestedCategories();
      $json_data['data'] = $topctrgy;
      echo json_encode($json_data);
    }

    //request products page/get request products that is entered in the database and load it in the table
    public function getRequests()
    {
      $reqproducts = $this->reqproduct_model->reqproductList();
      $json_data['data'] = $reqproducts;
      echo json_encode($json_data);
    }

    public function getCategories()
    {
      $categories = $this->dynamic_dependent_model->categoryList();
      $json_data['data'] = $categories;
      echo json_encode($json_data);
    }

    public function getSubCategories()
    {
      $subcategories = $this->dynamic_dependent_models->subCategoryList();
      $json_data['data'] = $subcategories;
      echo json_encode($json_data);
    }
    
    public function getBrands()
    {
      $brands = $this->brand_model->brandList();
      $json_data['data'] = $brands;
      echo json_encode($json_data);
    }

    public function getSize()
    {
      $sizes = $this->size_model->sizeList();
      $json_data['data'] = $sizes;
      echo json_encode($json_data);
    }

    public function getColor()
    {
      $brands = $this->color_model->colorList();
      $json_data['data'] = $brands;
      echo json_encode($json_data);
    }

    public function getLocation()
    {
      $brands = $this->location_model->locationList();
      $json_data['data'] = $brands;
      echo json_encode($json_data);
    }

    public function getUsers()
    {
      $users = $this->Login_model->userList();
      $json_data['data'] = $users;
      echo json_encode($json_data);
    }

    public function getRoles()
    {
      $roles = $this->role_model->roleList();
      $json_data['data'] = $roles;
      echo json_encode($json_data);
    }

    //approve products page/get request products that is entered in the database and load it in the table
    public function getRequestAdminView(){
        $reqproducts = $this->reqproduct_model->reqproductListAdminView();
        $json_data['data'] = $reqproducts;
        echo json_encode($json_data);
    }

    //products page/create new category
    public function category()
	{ 
        // form validation
        $this->form_validation->set_rules('categoryNameForm', 'Category Name' ,'required|max_length[30]');

        $data['array'] = $this->category_model->getCategoryName();
        
        //create new category
        $data['document'] = (object)$postData = array(
            'categoryID' => "CTGRY-".$this->randStrGen(2,7),
            'categoryName' => $this->input->post('categoryNameForm'),
        );
        
        //add products
        if($this->form_validation->run() === true){ 
            if($this->category_model->createcategory($postData)){
                $this->session->set_flashdata('success','Add Success');
            }
            else{
                $this->session->set_flashdata('error','Add Failed');
            }
            redirect('category');
        }          
        else{
            $this->load->helper('form');
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/category', $data);
            $this->load->view('HeaderNFooter/Footer');
        }
	}

    public function subcategory()
	{ 
        // form validation
        $this->form_validation->set_rules('subcategoryNameForm', 'Subcategory Name' ,'required|max_length[30]');
        $this->form_validation->set_rules('pickCategoryForm', 'Product Category' ,'required');

        $data['subcategory'] = $this->subcategory_model->getSubCategoryName();

        //create new category
        $data['document'] = (object)$postData = array(
            'categoryId' => $this->input->post('pickCategoryForm'),
            'subcategoryId' => "DDLSBCTGRY-".$this->randStrGen(2,7),
            'subcategoryName' => $this->input->post('subcategoryNameForm'),
        );
        
        //add products
        if($this->form_validation->run() === true){ 
            if($this->dynamic_dependent_models->createsubcategory($postData)){
                $this->session->set_flashdata('success','Add Success');
            }
            else{
                $this->session->set_flashdata('error','Add Failed');
            }
            redirect('category');
        }          
        else{
            $this->load->helper('form');
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/category', $data);
            $this->load->view('HeaderNFooter/Footer');
        }
	}

    public function size()
	{ 
        // form validation
        $this->form_validation->set_rules('sizeNameForm', 'Size Name' ,'required|max_length[30]');

        $data['size'] = $this->size_model->getSizeName();

        //create new category
        $data['document'] = (object)$postData = array(
            'sizeId' => "SIZEPRD-".$this->randStrGen(2,7),
            'sizeName' => $this->input->post('sizeNameForm'),
        );
        
        //add products
        if($this->form_validation->run() === true){ 
            if($this->size_model->createsize($postData)){
                $this->session->set_flashdata('success','Add Success');
            }
            else{
                $this->session->set_flashdata('error','Add Failed');
            }
            redirect('category');
        }          
        else{
            $this->load->helper('form');
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/category', $data);
            $this->load->view('HeaderNFooter/Footer');
        }
	}

    public function brand()
	{ 
        // form validation
        $this->form_validation->set_rules('brandNameForm', 'Brand Name' ,'required|max_length[30]');

        $data['array'] = $this->brand_model->getBrandName();
        
        //create new category
        $data['document'] = (object)$postData = array(
            'brandId' => "BRNDPRD-".$this->randStrGen(2,7),
            'brandName' => $this->input->post('brandNameForm'),
        );
        
        //add products
        if($this->form_validation->run() === true){ 
            if($this->brand_model->createbrand($postData)){
                $this->session->set_flashdata('success','Add Success');
            }
            else{
                $this->session->set_flashdata('error','Add Failed');
            }
            redirect('category');
        }          
        else{
            $this->load->helper('form');
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/category', $data);
            $this->load->view('HeaderNFooter/Footer');
        }
	}

    public function color()
	{ 
        // form validation
        $this->form_validation->set_rules('colorNameForm', 'Color Name' ,'required|max_length[30]');

        $data['array'] = $this->color_model->getColorName();
        
        //create new category
        $data['document'] = (object)$postData = array(
            'colorId' => "CLRPRD-".$this->randStrGen(2,7),
            'colorName' => $this->input->post('colorNameForm'),
        );
        
        //add products
        if($this->form_validation->run() === true){ 
            if($this->color_model->createcolor($postData)){
                $this->session->set_flashdata('success','Add Success');
            }
            else{
                $this->session->set_flashdata('error','Add Failed');
            }
            redirect('category');
        }          
        else{
            $this->load->helper('form');
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/category', $data);
            $this->load->view('HeaderNFooter/Footer');
        }
	}

    public function location()
	{ 
        // form validation
        $this->form_validation->set_rules('locationNameForm', 'Location Name' ,'required|max_length[30]');

        $data['array'] = $this->location_model->getLocationName();
        
        //create new category
        $data['document'] = (object)$postData = array(
            'locationId' => "LCTNPRD-".$this->randStrGen(2,7),
            'locationName' => $this->input->post('locationNameForm'),
        );
        
        //add products
        if($this->form_validation->run() === true){ 
            if($this->location_model->createlocation($postData)){
                $this->session->set_flashdata('success','Add Success');
            }
            else{
                $this->session->set_flashdata('error','Add Failed');
            }
            redirect('category');
        }          
        else{
            $this->load->helper('form');
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/category', $data);
            $this->load->view('HeaderNFooter/Footer');
        }
	}

    public function report()
	{

        $data['notif'] = $this->inventory_model->notification();
        $data['top'] = $this->reqproduct_model->topRequestedProducts();

        $data['stock'] = $this->dashboard_model->totalStockQuantity();
        $data['request'] = $this->dashboard_model->requestToBeApproved();
        $data['released'] = $this->dashboard_model->totalProductsReleased();
        $data['totNum'] = $this->dashboard_model->totalNumberOfProducts();
        
        $data['dataYear'] = $this->charts_model->yearlyTotalQuantity();
        $data['year'] = $this->charts_model->getYear();

        $data['dataMonth'] = $this->charts_model->monthTotalQuantity();
        $data['month'] = $this->charts_model->getMonth();
        
        $this->load->view('HeaderNFooter/Header');
		$this->load->view('Pages/report', $data);
        $this->load->view('HeaderNFooter/Footer', $data);
        
	}

    public function scan()
	{
        $this->load->view('HeaderNFooter/Header');
		$this->load->view('Pages/scan');
        $this->load->view('HeaderNFooter/Footer');
	}

    public function approveproducts()
	{
        $this->load->view('HeaderNFooter/Header');
		$this->load->view('Pages/approveproducts');
        $this->load->view('HeaderNFooter/Footer');
	}

    //check password for usermanagement
    function checkpassword($password = '') 
    {
		if (strlen ($password) < 8 ) {
			$this->form_validation->set_message('checkpassword', 'The {field} field can should be 8 characters long');
			return false; 
		} else if (!preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $password)) {
			$this->form_validation->set_message('checkpassword', 'The {field} should contain special characters');
			return false; 	
		}
        else if (!preg_match('/[0-9]+/', $password)) {
			$this->form_validation->set_message('checkpassword', 'The {field} should contain numbers');
			return false; 	
		}
        else if (!preg_match('/[A-Z]+/', $password)) {
			$this->form_validation->set_message('checkpassword', 'The {field} should contain capital letters');
			return false; 	
		} 	 	
		else {
			return true;
		}	
	}

    //check pin
    function checkpin($pin = '') 
    {
		if (strlen ($pin) < 6 ) {
			$this->form_validation->set_message('checkpin', 'The {field} field should be 6 digits long');
			return false; 
		} 
        else if (!preg_match('/[0-9]+/', $pin)) {
			$this->form_validation->set_message('checkpin', 'The {field} should contain numbers');
			return false; 	
		} 	
		else {
			return true;
		}	
	}

    public function usermanagement() //needs to change
	{
        // form validation
        $this->form_validation->set_rules('userNameForm', 'User Name' ,'required|max_length[30]');
        $this->form_validation->set_rules('emailForm', 'Email' ,'required|valid_email');
        $this->form_validation->set_rules('userpasswordForm', 'Password', 'required|callback_checkpassword');
        $this->form_validation->set_rules('userpasswordconfirmForm', 'Password Confirmation', 'required|matches[userpasswordForm]');
        $this->form_validation->set_rules('userpinForm', 'User Pin', 'required|callback_checkpin');
        $this->form_validation->set_rules('userpinconfirmForm', 'Pin Confirmation', 'required|matches[userpinForm]');
        //$this->form_validation->set_rules('userRoleForm', 'User Role' ,'required|max_length[30]');

        $data['array'] = $this->role_model->getRoleName();
        
        //create new category
        $data['document'] = (object)$postData = array(
            'userId' => "USERDDLS-".$this->randStrGen(2,7),
            'username' => $this->input->post('userNameForm'),
            'userEmail' => $this->input->post('emailForm'),
            'password' => md5($this->input->post('userpasswordForm')),
            'pin' => md5($this->input->post('userpinForm')),
            'level' => $this->input->post('userRoleForm'),  
            'userDatetime' => date("Y-m-d"),
            //'categoryName' => $this->input->post('categoryNameForm'),
        );
        
        //add users
        if($this->form_validation->run() === true){ 
            if($this->Login_model->createuser($postData)){
                $this->session->set_flashdata('success','User Added');
            }
            else{
                $this->session->set_flashdata('error','Failed');
            }
            redirect('usermanagement');
        }          
        else{
            $this->load->helper('form');
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/usermanagement', $data);
            $this->load->view('HeaderNFooter/Footer');
        }
	}

    public function edituser($id = "")
    {
        //load user data
        $data['users'] = $this->Login_model->getUserDataById($this->uri->segment(3));
        
        
        // form validation
        $this->form_validation->set_rules('userNameForm', 'User Name' ,'required|max_length[30]');
        $this->form_validation->set_rules('emailForm', 'Email' ,'required|valid_email');
        //$this->form_validation->set_rules('userRoleForm', 'User Role' ,'required|max_length[30]');

        if($this->input->post('userpasswordForm') != ''){ 
            $this->form_validation->set_rules('userpasswordForm', 'Password', 'required');
            $this->form_validation->set_rules('userpasswordconfirmForm', 'Password Confirmation', 'required|matches[userpasswordForm]');
        }

        if($this->input->post('userpinForm') != ''){ 
            $this->form_validation->set_rules('userpinForm', 'Pin', 'required');
            $this->form_validation->set_rules('userpinconfirmForm', 'Pin Confirmation', 'required|matches[userpasswordForm]');
        }

        //$data['array'] = $this->user_model->getCategoryName();
        
        //create new category
            $postData = array(
            'userId' => $this->input->post('userIdForm'),
            'username' => $this->input->post('userNameForm'),
            'userEmail' => $this->input->post('emailForm'),
            'level' => $this->input->post('userRoleForm'),
            'userDatetime' => date("Y-m-d"),
        );

        if($this->input->post('userpasswordForm') != ''){ 
            $postData ['password'] = md5($this->input->post('userpasswordForm'));
        }

        if($this->input->post('userpinForm') != ''){ 
            $postData ['password'] = md5($this->input->post('userpinForm'));
        }
         

        $data['array'] = $this->role_model->getRoleName();
        
        //add users
        if($this->form_validation->run() === true){ 
            if($this->Login_model->updateUserRecord($postData)){
                $this->session->set_flashdata('success','User Added');
            }
            else{
                $this->session->set_flashdata('error','Failed');
            }
            redirect('main/edituser/'.$postData['userId']);
        }          
        else{
            $this->load->helper('form');
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/usereditpage', $data);
            $this->load->view('HeaderNFooter/Footer');
        }
    }
    

    public function role() //needs to change
	{
        // form validation
        $this->form_validation->set_rules('roleNameForm', 'Role Name' ,'required|max_length[30]');


        $data['array'] = $this->role_model->getRoleName();
        
        //create new role
        $data['document'] = (object)$postData = array(
            'roleId' => "ROLEDDLS-".$this->randStrGen(2,7),
            'roleName' => $this->input->post('roleNameForm'),
        );
        
        //add role
        if($this->form_validation->run() === true){ 
            if($this->role_model->createrole($postData)){
                $this->session->set_flashdata('success','Add Success');
            }
            else{
                $this->session->set_flashdata('error','Add Failed');
            }
            redirect('usermanagement');
        }          
        else{
            $this->load->helper('form');
            $this->load->view('HeaderNFooter/Header');
            $this->load->view('Pages/usermanagement', $data);
            $this->load->view('HeaderNFooter/Footer');
        }
	}


    public function usersettings()
	{
        $this->load->view('HeaderNFooter/Header');
		$this->load->view('Pages/usersettings');
        $this->load->view('HeaderNFooter/Footer');
	}


    public function notifications()
	{
        $data['notifs'] = $this->db->get('tbl_notif')->result_array();
        $this->load->view('HeaderNFooter/Header');
		$this->load->view('Pages/notifications', $data);
        $this->load->view('HeaderNFooter/Footer');
        // $data['notifs'] = $this->db->get('tbl_notif')->result_array();
        // $notifications = $this->notifications_model->tbl_notif();
        // $json_data['data'] = $notifications;
        // echo json_encode($json_data);
	}

    //random id generator for the id's in the website
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

    public function simpanbarang(){
        $data = [
            'productId' => htmlspecialchars($this->input->post('productId'), TRUE),
            'reqproductStatus' => htmlspecialchars($this->input->post('reqproductStatus'), TRUE),
            'reqDateTime' => time(),
            
        ];

        $product = $this->db->get_where('reqproductrecord')->row_array();

        $notifs = [

            'title' => 'Item Added',
            'message' => 'Product ' . $product['productId'] . ' added to' . ' the Inventory' . '.', 'is_read' => 0
            


        ];

        

        $this->db->insert('tbl_notif', $notifs);
        $this->session->set_flashdata('msg', '<div class="alert alert-success">Barang berhasil ditambahkan</div>');
        return redirection(base_url('Main'));
	}

    public function markasread($id){
        $data = [
            'is_read' => 1
        ];
        $this->db->update('tbl_notif', $data, ['id' => $id]);
        $this->session->set_flashdata('msg', '<div class="alert alert-success"> Notification Updated Successfully</div>');
        return redirect(base_url('notifications'));
    }

    public function markreadall(){
        $notif = $this->db->get_where('tbl_notif', ['is_read' => 0])->result_array();

        for($i = 0; $i < count($notif); $i++){
            $data = [
                'is_read' => 1
            ];
            $this->db->update('tbl_notif', $data, ['id' => $notif[$i]['id']]);

        }
        $this->session->set_flashdata('msg', '<div class="alert alert-success">Notification successfully updated</div>');
        return redirect(base_url('notifications'));
    }

    public function removeall(){
        $this->db->empty_table('tbl_notif');
        $this->session->set_flashdata('msg', '<div class="alert alert-success">Notification successfully updated</div>');

        return redirect (base_url('notifications'));
    }

}

