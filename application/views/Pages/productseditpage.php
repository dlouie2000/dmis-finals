<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
        body{
            font-family: 'Sen', sans-serif;
	  background: #fafafa;
  }
  p{
    font-family: 'Sen', sans-serif;
	  font-size: 1.1em;
	  font-weight: 300;
	  line-height: 1.7em;
	  color: #999;
  }
  a,
  a:hover,
  a:focus{
	  color: inherit;
	  text-decoration: none;
	  transition: all 0.3s;
  }
  
  /* Side Bar*/
  
  
  
  #sidebar.active {
	  margin-left: -250px;
  }
  .wrapper{
	  display: flex;
	  text-decoration: none;
	  transition: all 0.3s;
  }
  
  #sidebar{
	  min-width: 250px;
	  max-width: 250px;
	  /* background: #fda4ba; */
	  color: #fff;
	  transition: all 0.3s;
  }
  
  #grad1 {
	background-color: red; /* For browsers that do not support gradients */
	background-image: linear-gradient(#fda4ba, #CC4576);
  }
  
  
  #sidebar .sidebar-header{
	  padding: 20px;
	  /* background: #fda4ba; */
  }
  #sidebar ul.components{
	  padding: 20px 0;
	  border-bottom: 1px solid #fda4ba;;
  }
  
  #sidebar ul p{
	  color: #fff;
	  padding: 10px;
  }
  
  #sidebar ul li a{
	  padding: 10px;
	  font-size: 1.1em;
	  display: block;
  }
  
  #sidebar ul li a:hover{
	  color: #7386D5;
	  background: #fff;
  }
  /* #sidebar ul li.active>a,
  a[aria-expanded="true"] {
	  color: #fff;
	
  } */
  
  a[data-toggle="collapse"]{
	  position: relative;
  }
  
  .dropdown-toggle::after{
	  display: block;
	  position: absolute;
	  top: 50%;
	  right: 20%;
	  transform: translateY(-50%);
  }
  ul ul a{
	  font-size: 0.9em !important;
	  padding-left: 30px !important;
	  background: #fda4ba;
  }
  
  #content{
	  width: 100%;
	  padding: 20px;
	  min-height: 100vh;
	  transition: all 0.3s;
  }
  
  
  @media (max-width: 768px) {
	  #sidebar {
		  margin-left: -250px;
	  }
	  #sidebar.active {
		  margin-left: 0;
	  }
	  #sidebarCollapse span {
		  display: none;
	  }
  }
</style>

<div class="modal" tabindex="-1" id="editProduct">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Add Product-->
<div class="modal" tabindex="-1" id="ediddtProduct" style="">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"style="word-wrap: break-word;">
                <!-- Modal Body -->
                <?php echo form_open_multipart('main/edit') ?>
                <div class="form-row">
                <div class="productIdField col-md-6" style="padding:10px;">
                    <label for="productIdField">Product Id</label>
                    <input name="productIdField" type="text" class="form-control" id="productIdField" value="<?php echo $products->productId ?>" readonly>
                </div>
                <div class="productNameForm col-md-6" style="padding:10px;">
                    <label for="productNameForm">Product Name</label>
                    <input name="productNameForm" type="text" class="form-control" id="productNameForm" value="<?php echo $products->productName ?>">
                </div>
                <!-- Product Category Part -->
                <div class="productCategoryForm col-md-3" style="padding:10px;">
                    <label for="productCategoryForm">Product Category Select</label>
                        <select class="form-control" id="productCategoryForm" name="productCategoryForm" value="<?php echo $products->categoryName ?>">
                        '<option value="">Select Category</option>'
                        <?php foreach($array as $list){
                        //needs to change...
                            echo '<option value="'.$list->categoryName.'" '.(($products->productCategory == $list->categoryName)? 'selected' : null ).'> '.$list->categoryName.' </option>';
                        }
                        ?>
                        </select>
                </div>
                <div class="productConditionForm col-md-3" style="padding:10px;">
                    <label for="productConditionForm">Product Condition</label>
                        <select class="form-control" id="productConditionForm" name="productConditionForm" value="<?php echo $products->productCondition ?>">
                            <option value="">Choose a condition...</option>
                            <option value="Good" <?php echo (($products->productCondition == "Good"? 'selected' : null))?>>Good</option>
                            <option value="Mildly Damaged" <?php echo (($products->productCondition == "Mildly Damaged"? 'selected' : null))?>>Mildly Damaged</option>
                            <option value="Repairable" <?php echo (($products->productCondition == "Repairable"? 'selected' : null))?>>Repairable</option>
                            <option value="Bad" <?php echo (($products->productCondition == "Bad"? 'selected' : null))?>>Bad</option>
                        </select>
                </div>
                <!-- Product Quantity Part -->
                <div class="productQuantityForm col-md-3" style="padding:10px;">
                    <label for="pr">Quantity</label>
                    <input name="productQuantityForm" type="text" class="form-control" id="productQuantityForm" placeholder="Input Quantity" value="<?php echo $products->productQuantity ?>">
                 </div>

                <!-- Date Picker Part -->
                <div class="DateTimeForm col-md-3"style="padding:10px;">
                    <label for="">Date & Time</label>
                    <input type="datetime-local" name="DateTimeForm" class="form-control" id="DateTimeForm" value="<?php echo $products->DateTime ?>">
                </div>
            </div>
            <!-- Product Condition Part -->
            <div class="form-row">
            <div class="productViewImageForm col-md-6" style="padding:10px;">
                    <label for="productViewImageForm">Product Image</label>
                    <input name="productViewImageForm" type="text" class="form-control" id="productViewImageForm" value="<?php echo $products->productImage ?>" readonly>
                    <img src="<?php echo base_url();?>/application/assets/attachments/<?php echo $products->productImage ?>" style="border-radius: 10px; margin-top:15px;" width="200" height="200">
                </div>
                <div class="productImageForm col-md-6" style="padding: 10px">
                    <label for="productImageForm">Change Product Picture</label>
                    <input name="productImageForm" type="file" class="form-control-file" id="productImageForm">
                </div>
                <!-- Modal Body End -->            
            </div>
            <div class="modal-footer">
                <!-- Create Button  -->
                <button type="submit" style="margin-top: 30px;" class="btn btn-primary">Create</button>
            </div>
            <?php echo form_close() ?>
        </div>                       
    </div>
</div>

<div class="Products">
    <!-- Product Table Container -->
    <div class="Product-Table container-fluid" style="margin-top: 50px">
        <div class="card">
            <div class="card-header"  style="margin-bottom: 10px" >
                <h3>Inbound Products</h3>
            </div>
            <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
            <table id="product_table" class="display" width="100%">
        <thead>
            <tr>
                <th>Product Id</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Condition</th>
                <th>Quantity</th>
                <th>Product Picture</th>
                <th>Date</th>
                <th>Modify</th>
            </tr>
        </thead>
    </table>
            </div>        
            </div>
    </div>
</div>
