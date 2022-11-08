<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Modal Request Product-->
<div class="modal fade" tabindex="-1" id="reqProduct" style="">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header" style="background-color:#A71C49;">
            <h3 class="modal-title" style="color:#FFFFFF">Request Product</h3>
        </div>
        <div class="modal-body"style="word-wrap: break-word;">
            <?php echo form_open_multipart('main/reqproducts') ?>
            <!-- Modal Body -->
                        <!-- Product Name Part -->
                        <div class="card-body">
                    <?php echo form_open_multipart('main/reqproducts') ?>
                    <div class="form">
                        <div class="reqproductIdForm col-12" style="padding:10px;">
                            <label for="reqproductIdForm">Product Serial Id</label>
                            <input name="productIdField" type="text" class="form-control" id="productIdField" placeholder="Product Serial Id" value="" readonly>
                        </div> 
                        <!-- Product Name Part -->
                        <div class="reqproductNameForm col-12" style="padding:10px;">
                            <label for="reqproductNameForm">Product Name</label>
                            <input name="reqproductNameForm" type="text" class="form-control" id="reqproductNameForm" placeholder="Product Name"  readonly>
                        </div>
                    </div>
                <!-- Product Quantity Part -->
                <div class="form"> 
                <div class="reqproductQuantityForm col-12" style="padding:10px;">
                        <label for="pr">Quantity</label>
                        <input name="reqproductQuantityForm" type="text" class="form-control" id="reqproductQuantityForm" placeholder="Input Quantity"  >
                    </div>
                    <!-- DateRequest -->
                    <div class="reqDateTimeForm col-12"style="padding:10px;">
                        <label for="">Request Date & Time</label>
                        <input type="datetime-local" name="reqDateTimeForm" class="form-control">
                    </div>
                </div>    
            <!-- Modal Body End -->  
        </div>
        <div class="modal-footer">
            <!-- Create Button  -->
            <button type="submit" style="margin-top: 30px;" class="btn btn-primary">Request Product</button>
        </div>
        <?php echo form_close() ?>
        </div>                       
        </div>
    </div>
</div>
<!-- Modal Request Product End-->


<!-- Product Table Container -->
  <div class="Reqproduct-Table container-fluid" style="margin-top: 50px">
    <div class="card">

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

        <div class="card-header"  style="margin-bottom: 10px; background-color:#A71C49;" >
            <h3 style="color:white">Select Products to Request</h3>
            <!-- <h7>Select Product to Release</h7> -->
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="reqproduct_table" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Product Serial Id</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Sub-Category</th>
                            <th>Size</th>
                            <th>Brand/Suppliers</th>
                            <th>Color</th>
                            <th>Location</th>
                            <th>Condition</th>
                            <th>Quantity</th>
                            <th>Product Picture</th>
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
<div class="Statusproduct-Table container-fluid" style="margin-top: 50px">
    <div class="card">
        <div class="card-header"  style="margin-bottom: 10px; background-color:#A71C49;" >
            <h3 style="color:white">Product Request Status</h3>
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="statusproduct_table" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Request Id</th>
                            <th>Product Serial Id</th>
                            <th>Product Name</th>
                            <th>Product Category</th>
                            <th>Quantity to Pull Out</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Approve/Reject Date and Time</th>
                        </tr>
                    </thead>

                </table>
            </div>        
        </div>
    </div>
</div>