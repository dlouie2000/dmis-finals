<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- Validation Error Code -->
    <?php if (validation_errors()){   
            echo '<div class="alert alert-danger container">
            '.validation_errors().'
            </div>'; 
        }
        ?>

    <!-- Success Notification Code -->
    <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success" > 
            <?php  echo $this->session->flashdata('success'); $this->session->unset_userdata ( 'success' );?>
        </div>
    <?php } ?>

    <!-- Error Notification Code -->
    <?php if ($this->session->flashdata('error')){ ?>
        <div class="alert alert-danger" > 
            <?php  echo $this->session->flashdata('error'); $this->session->unset_userdata ( 'error' );?>
        </div>
    <?php } ?>

<!-- Design Your Category Here! -->
<div class="Reqproducts">
<div class="Reqroduct-Form container" style ="width:auto; margin-top:30px; font-weight: 700;">
        <div class="card mx-auto" >
            <div class="card-header"  >
                <h3>Request Product</h3>
            </div>
            <!-- Product Name Part -->
            <div class="card-body">
                <?php echo form_open_multipart('main/reqproducts') ?>
                <div class="form-row">
                    <div class="reqproductIdForm col-md-6" style="padding:10px;">
                        <label for="reqproductIdForm">Product Id</label>
                        <input name="reqproductIdForm" type="text" class="form-control" id="reqproductIdForm" placeholder="Select a Product Below"readonly>
                    </div>
                    <!-- Product Name Part -->
                    <div class="reqproductNameForm col-md-6" style="padding:10px;">
                        <label for="reqproductNameForm">Product Id</label>
                        <input name="reqproductNameForm" type="text" class="form-control" id="reqproductNameForm" placeholder="Product Name"readonly>
                    </div>
                </div>
             <!-- Product Quantity Part -->
            <div class="form-row"> 
            <div class="reqproductQuantityForm col-md-6" style="padding:10px;">
                    <label for="pr">Quantity</label>
                    <input name="reqproductQuantityForm" type="text" class="form-control" id="reqproductQuantityForm" placeholder="Input Quantity">
                </div>
                <!-- DateRequest -->
                 <div class="ReqDateTimeForm col-md-6"style="padding:10px;">
                    <label for=""> Date & Time</label>
                    <input type="datetime-local" name="ReqDateTimeForm" class="form-control">
                </div>
            </div>    
                <!-- Request Button  -->
                <button type="submit" style="margin-top: 30px;" class="btn btn-primary">Request Product</button>
                <?php echo form_close() ?>
        </div>
    </div>         
</div>

<!-- Product Table Container -->
  <div class="Reqproduct-Table container" style="margin-top: 50px">
    <div class="card">
        <div class="card-header"  style="margin-bottom: 10px" >
            <h3>Products</h3>
            <h7>Select products here to be requested to the admin</h7>
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="reqproduct_table" class="display">
                    <thead>
                        <tr>
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Condition</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Select Product</th>
                        </tr>
                    </thead>
                </table>
            </div>        
        </div>
    </div>
</div>

<!-- Status Product Table Container -->
<div class="Statusproduct-Table container" style="margin-top: 50px">
    <div class="card">
        <div class="card-header"  style="margin-bottom: 10px" >
            <h3>Products Status</h3>
            <h7></h7>
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="statusproduct_table" class="display">
                    <thead>
                        <tr>
                            <th>Request Id</th>
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>        
        </div>
    </div>
</div>