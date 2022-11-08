<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal fade" tabindex="-1" id="addProduct" style="">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header" style="background-color:#A71C49;">
                <h3 class="modal-title" style="color:#FFFFFF">Add a Product</h3>
            </div>
            <div class="modal-body"style="word-wrap: break-word;">
                <!-- Modal Body -->
                <?php echo form_open_multipart('main/products') ?>
                <div class="form-row">
                    <!-- Product Name -->
                    <div class="productNameForm col-12" style="padding: 10px;">  
                        <label for="productNameForm">Product Name</label>
                        <input name="productNameForm" type="text" class="form-control" id="productNameForm" placeholder="Input Name">
                    </div>
                    <!-- Product Category Part -->
                    <div class="productCategoryForm col-12" style="padding: 10px;">
                        <label for="productCategoryForm">Product Category</label>
                            <select class="form-control"  id="productCategoryForm" name="productCategoryForm">
                            <option value="">Select Category</option>
                            <?php
                            foreach($category as $list)
                            {
                            echo '<option value="'.$list->categoryId.'">'.$list->categoryNamee.'</option>';
                            }
                            ?>
                            </select>
                    </div>
                    <div class="productSubcategoryForm col-12" style="padding: 10px;">
                        <label for="productSubcategoryForm">Product Sub-Category</label>
                            <select class="form-control" id="productSubcategoryForm" name="productSubcategoryForm">
                            '<option value="">Select Sub-category</option>'
                            </select>
                    </div>
                     <!-- Product Size Part -->
                     <div class="productSizeForm col-12" style="padding: 10px;">
                        <label for="productSizeForm">Product Size</label>
                            <select class="form-control" id="productSizeForm" name="productSizeForm">
                            '<option value="">Select Size</option>'
                            <?php foreach($size as $list){
                            //needs to change...
                            echo '<option value="'.$list->sizeName.'"> '.$list->sizeName.' </option>';
                            }
                            ?>
                            </select>
                    </div>
                    <!-- Product Brands Part -->
                    <div class="productBrandForm col-12" style="padding: 10px;">
                        <label for="productBrandForm">Product Brand</label>
                            <select class="form-control" id="productBrandForm" name="productBrandForm">
                            '<option value="">Select Brands/Suppliers</option>'
                            <?php foreach($brand as $list){
                            //needs to change...
                            echo '<option value="'.$list->brandName.'"> '.$list->brandName.' </option>';
                            }
                            ?>
                            </select>
                    </div>
                    <!-- Product Color Part -->
                    <div class="productColorForm col-12" style="padding: 10px;">
                        <label for="productColorForm">Product Color</label>
                            <select class="form-control" id="productColorForm" name="productColorForm">
                            '<option value="">Select Color</option>'
                            <?php foreach($color as $list){
                            //needs to change...
                            echo '<option value="'.$list->colorName.'"> '.$list->colorName.' </option>';
                            }
                            ?>
                            </select>
                    </div>
                     <!-- Product Location Part -->
                     <div class="productLocationForm col-12" style="padding: 10px;">
                        <label for="productLocationForm">Product Location</label>
                            <select class="form-control" id="productLocationForm" name="productLocationForm">
                            '<option value="">Select Location</option>'
                            <?php foreach($location as $list){
                            //needs to change...
                            echo '<option value="'.$list->locationName.'"> '.$list->locationName.' </option>';
                            }
                            ?>
                            </select>
                    </div>
                    <!-- Product Condition Part -->
                    <div class="productConditionForm col-12" style="padding:10px;">
                        <label for="productConditionForm">Product Condition</label>
                            <select class="form-control" id="productConditionForm" name="productConditionForm">
                                <option value="">Choose a condition...</option>
                                <option value="Good">Good</option>
                                <option value="Mildly Damaged">Mildly Damaged</option>
                                <option value="Repairable">Repairable</option>
                                <option value="Bad">Bad</option>
                            </select>
                    </div>
                    <!-- Product Quantity Part -->
                    <div class="productQuantityForm col-12" style="padding:10px;">
                        <label for="productQuantityForm">Quantity</label>
                        <input name="productQuantityForm" type="text" class="form-control" id="productQuantityForm" placeholder="Input Quantity">
                        </div>
                    
                    <div class="DateTimeForm "style="padding:10px;">
                        <label for=""> Date & Time</label>
                        <input type="datetime-local" name="DateTimeForm" class="form-control">
                    </div>

                        <!-- Upload Button  -->
                    <div class="productImageForm " style="padding: 10px">
                        <label for="productImageForm">Upload Product Picture</label>
                        <input name="productImageForm" type="file" class="form-control-file" id="productImageForm">
                    </div>
                </div>

                
                <!-- Modal Body End -->            
            </div>
            <div class="modal-footer" >
                <!-- Create Button  -->
                <button type="submit" style="" class="btn btn-primary">Create</button>
            </div>
            <?php echo form_close() ?>
        </div>                       
    </div>
</div>

<!-- EDIT PRODUCT MODAL -->
<div class="modal fade" tabindex="-1" id="editProduct" style="">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#A71C49;">
                <h3 class="modal-title" style="color:#FFFFFF">Edit Product</h3>
            </div>
            <div class="modal-body"style="word-wrap: break-word;">
                <?php echo form_open_multipart('main/edit') ?>
                <!-- Modal Body -->
                <div class="productIdForm col-12" style="padding:10px;">
                    <label for="productIdField">Product Serial Id</label>
                    <input name="productIdField" type="text" class="form-control" id="productIdField"  readonly>
                </div>
                <div class="productViewImageForm col-12" style="padding:10px;">
                    <p style="color:black">Product Image</p>
                    <center><img src="" id="productImage" style="border-radius: 10px; margin-top:-10px; border:1px lightgray solid;" width="200" height="200"></center> 
                </div>
                <div class="productImageForm col-12" style="padding: 10px" >
                    <label for="productImageForm">Change Product Picture</label>
                    <input name="productImageForm" type="file" class="form-control-file" id="productImageForm">
                </div>
                <div class="productNameForm col-12" style="padding:10px;">
                    <label for="productNameForm">Product Name</label>
                    <input name="productNameForm" type="text" class="form-control" id="productNameForm" >
                </div>
                <div class="productCategoryForm col-12" style="padding:10px;">
                    <label for="productCategoryForm">Product Category</label>
                    <select class="form-control" id="productCategoryEditForm" name="productCategoryForm" >
                        <?php foreach($category as $list){
                        //needs to change...
                            echo '<option value="'.$list->categoryId.'" '.(($products->productCategory == $list->categoryNamee)? 'selected' : null ).'> '.$list->categoryNamee.' </option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="productSubcategoryForm col-12" style="padding:10px;">
                    <label for="productSubcategoryForm">Product Sub-category</label>
                    <select class="form-control" id="productSubcategoryEditForm" name="productSubcategoryForm" >
                    </select>
                </div>
                <div class="productSizeForm col-12" style="padding:10px;">
                    <label for="productSizeForm">Product Size</label>
                    <select class="form-control" id="productSizeForm" name="productSizeForm" >
                        <?php foreach($size as $list){
                        //needs to change...
                            echo '<option value="'.$list->sizeName.'" '.(($products->productSize == $list->sizeName)? 'selected' : null ).'> '.$list->sizeName.' </option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="productBrandForm col-12" style="padding:10px;">
                    <label for="productBrandForm">Product Brand</label>
                    <select class="form-control" id="productBrandForm" name="productBrandForm" >
                        <?php foreach($brand as $list){
                        //needs to change...
                            echo '<option value="'.$list->brandName.'" '.(($products->productBrand == $list->brandName)? 'selected' : null ).'> '.$list->brandName.' </option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="productColorForm col-12" style="padding:10px;">
                    <label for="productColorForm">Product Color</label>
                    <select class="form-control" id="productColorForm" name="productColorForm" >
                        <?php foreach($color as $list){
                        //needs to change...
                            echo '<option value="'.$list->colorName.'" '.(($products->productColor == $list->colorName)? 'selected' : null ).'> '.$list->colorName.' </option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="productLocationForm col-12" style="padding:10px;">
                    <label for="productLocationForm">Product Location</label>
                    <select class="form-control" id="productLocationForm" name="productLocationForm" >
                        <?php foreach($location as $list){
                        //needs to change...
                            echo '<option value="'.$list->locationName.'" '.(($products->productLocation == $list->locationName)? 'selected' : null ).'> '.$list->locationName.' </option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="productConditionForm col-12" style="padding:10px;">
                    <label for="productConditionForm">Product Condition</label>
                    <select class="form-control" id="productConditionForm" name="productConditionForm" value="<?php echo $products->productCondition ?>">
                        <option value="">Choose a condition...</option>
                        <option value="Good" >Good</option>
                        <option value="Mildly Damaged" >Mildly Damaged</option>
                        <option value="Repairable" >Repairable</option>
                        <option value="Bad" >Bad</option>
                    </select>
                </div>
                <div class="productQuantityForm col-12" style="padding:10px;">
                    <label for="pr">Quantity</label>
                    <input name="productQuantityForm" type="text" class="form-control" id="productQuantityForm" placeholder="Input Quantity" >
                </div>
                <div class="DateTimeForm col-12"style="padding:10px;">
                    <label for="">Date & Time</label>
                    <input type="datetime-local" name="DateTimeForm" class="form-control" id="DateTimeForm" >
                </div>
                <div class="passwordForm col-12" style="margin-top:40px;" >
                        <label for="exampleInputPassword1">to continue please enter Warehouse PIN</label>
                        <input type="password" class="form-control" id="modalInputEditPassword" name="modalInputEditPassword" placeholder="Password">
                </div>      
                <!-- Modal Body End -->  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#editconfirmationModal">Save</button>
                <?php echo form_close() ?>            
            </div>
        </div>                          
    </div>
</div> 


<!-- Confirmation Delete Message -->
<div class="modal fade" tabindex="-1" id="deleteconfirmationModal" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#A71C49;">
        <h5 class="modal-title" style="color:#FFFFFF">Please Confirm</h5>
      </div>
      <div class="modal-body">
            <?php echo form_open_multipart('main/deletepasswordmodal') ?>
            <p style="color:black">Do you really want to delete this Product?</p>
            <div class="productIdForm col-12" style="padding:10px; margin-top:20px;">
                <label for="productIdField">Product Serial Id</label>
                <input name="productIdField" type="text" class="form-control" id="productIdField"  readonly>
            </div>
            <div class="productViewImageForm col-12" style="padding:10px;">
                <p style="color:black">Product Image</p>
                <center><img src="" id="productImage" style="border-radius: 10px; margin-top:-10px; border:1px lightgray solid;" width="200" height="200"></center>  
            </div>
            <div class="passwordForm col-12" style="padding:10px; margin-top:20px;" >
                <label for="exampleInputPassword1">to continue please enter Admin PIN</label>
                <input type="password" class="form-control" id="modalInputPassword" name="modalInputPassword" placeholder="Password">
            </div>                 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>           
        </div>
        <?php echo form_close() ?>
    </div>
  </div>
</div>

<?php if($this->session->userdata('level')==='1'):?>   
<?php elseif($this->session->userdata('level')==='2'):?>
<!-- ADD A PRODUCT BUTTON -->
<div class="Add Product Button" style="margin-bottom: -30px; margin-left: 15px; margin-top: 40px;">
    <button type="button" style="background-color:#A71C49;" class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#addProduct"><i class="fas fa-archive" aria-hidden="true"></i> Add a Product</button>
</div>
<?php endif;?>



<!-- Product Table Container -->
<div class="Product-Table container-fluid" style="margin-top: 50px">
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
            <h3 style="color: white;">Inbound Products</h3>
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="product_table" class="display" width="100%">
                    <thead>
                        <?php if($this->session->userdata('level')==='1'):?>
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
                                <th>Modify</th>       
                            </tr>
                        <?php elseif($this->session->userdata('level')==='2'):?>
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
                                <th>Modify</th>      
                            </tr>
                        <?php endif;?>       
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

