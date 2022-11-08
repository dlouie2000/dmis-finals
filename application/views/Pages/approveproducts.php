<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Approve Confirmation Message with Password-->
<div class="modal fade" tabindex="-1" id="approveconfirmationModal" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#A71C49;">
        <h5 class="modal-title" style="color:#FFFFFF">Please Confirm</h5>
      </div>
      <div class="modal-body">
            <?php echo form_open_multipart('main/approvepasswordmodal') ?>
            <p style="color:black">Do you really want to Approve this Product Re?</p>
            <div class="productIdForm col-12" style="padding:10px; margin-top:20px;">
                <label for="productIdField">Product Serial Id</label>
                <input name="productIdField" type="text" class="form-control" id="productIdField"  readonly>
            </div>
            <div class="reqproductIdForm col-12" style="padding:10px; margin-top:20px;">
                <label for="reqproductIdField">Request Product Serial Id</label>
                <input name="reqproductIdField" type="text" class="form-control" id="reqproductIdField"  readonly>
            </div>
            <div class="productQuantityForm col-12" style="padding:10px; margin-top:20px;">
                <label for="productQuantityField">Original Quantity</label>
                <input name="productQuantityField" type="text" class="form-control" id="productQuantityField"  readonly>
            </div>
            <div class="reqproductQuantityForm col-12" style="padding:10px; margin-top:20px;">
                <label for="reqproductQuantityField">Quantity to Pull Out</label>
                <input name="reqproductQuantityField" type="text" class="form-control" id="reqproductQuantityField"  readonly>
            </div>
            <div class="passwordForm col-12" style="padding:10px; margin-top:20px;" >
                <label for="exampleInputPassword1">to continue please enter Admin PIN</label>
                <input type="password" class="form-control" id="approvemodalInputPassword" name="approvemodalInputPassword" placeholder="Password">
            </div>                 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Approve Product</button>           
        </div>
        <?php echo form_close() ?>
    </div>
  </div>
</div>

<!-- Reject Confirmation Message with Password-->
<div class="modal fade" tabindex="-1" id="rejectconfirmationModal" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#A71C49;">
        <h5 class="modal-title" style="color:#FFFFFF">Please Confirm</h5>
      </div>
      <div class="modal-body">
            <?php echo form_open_multipart('main/rejectpasswordmodal') ?>
            <p style="color:black">Do you really want to Reject this Product Request?</p>
            <div class="productIdForm col-12" style="padding:10px; margin-top:20px;">
                <label for="productIdField">Product Serial Id</label>
                <input name="productIdField" type="text" class="form-control" id="productIdField"  readonly>
            </div>
            <div class="reqproductIdForm col-12" style="padding:10px; margin-top:20px;">
                <label for="reqproductIdField">Request Product Serial Id</label>
                <input name="reqproductIdField" type="text" class="form-control" id="reqproductIdField"  readonly>
            </div>
            <div class="reqproductQuantityForm col-12" style="padding:10px; margin-top:20px;">
                <label for="reqproductQuantityField">Quantity to Pull Out</label>
                <input name="reqproductQuantityField" type="text" class="form-control" id="reqproductQuantityField"  readonly>
            </div>
            <div class="rejectmodalInputPassword col-12" style="padding:10px; margin-top:20px;" >
                <label for="rejectmodalInputPassword">to continue please enter Admin PIN</label>
                <input type="password" class="form-control" id="rejectmodalInputPassword" name="rejectmodalInputPassword" placeholder="Password">
            </div>                 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Reject Product</button>           
        </div>
        <?php echo form_close() ?>
    </div>
  </div>
</div>



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
    
<div class="Approveproducts">
    <div>
    <h1></h1>
    </div>
</div>

<!-- Status Product Table Container -->
<div class="Statusproduct-Table container-fluid" style="margin-top: 50px">
    <div class="card">
        <div class="card-header"  style="margin-bottom: 10px; background-color:#A71C49;" >
            <h3 style="color:white">Request Approval</h3>
            <h7 style="color:white">Select Products to Approve</h7>
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="adminstatusproduct_table" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Request Id</th>
                            <th>Product Serial Id</th>
                            <th>Quantity to Pull Out</th>
                            <th>Date and Time</th>
                            <th>Approve Date and Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>        
        </div>
    </div>
    <div class="Statusproduct-Table container-fluid-auto" style="margin-top: 50px;">
    <div class="card">
        <div class="card-header"  style="margin-bottom: 10px; background-color:#A71C49;" >
            <h3 style="color:white">Product Request Status</h3>
            <h7 style="color:white">Select Product to Release</h7>
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
                            <th>Approve Date and Time</th>
                        </tr>
                    </thead>
                </table>
            </div>        
        </div>
    </div>
</div>
