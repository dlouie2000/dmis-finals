<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Design Your Category Here! -->
<div class="Category">



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

<!-- Create Buttons-->

<div class = "row" id="createbuttons" style="margin-bottom: -30px; margin-left: 15px; margin-top: 40px;">
    <div class="AddSubCategoryButton">
        <button type="button" style="background-color:#A71C49;" class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#addSubCategory">Add Sub-category</button>
    </div>
    <div class="AddSizeButton">
        <button type="button" style="background-color:#A71C49;" class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#addSize">Add Size </button>
    </div>
    <div class="AddBrandButton">
        <button type="button" style="background-color:#A71C49;" class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#addBrand">Add Brands/Supplier</button>
    </div>
    <div class="AddColorButton">
        <button type="button" style="background-color:#A71C49;" class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#addColor">Add Color</button>
    </div>
    <div class="AddLocationButton">
        <button type="button" style="background-color:#A71C49;" class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#addLocation">Add Location</button>
    </div>
</div>


<!-- Modal Add Category-->
<div class="modal" tabindex="-1" id="addCategory" style="">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header" style="background-color:#A71C49;">
                <h5 class="modal-title" style="color:#FFFFFF">Add a Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"style="word-wrap: break-word;">
                <?php echo form_open_multipart('main/category') ?>
                <!-- Modal Body -->
                <!-- Product Name Part -->
                <div class="categoryNameForm col-12" style="padding:10px;">
                    <label for="categoryNameForm">Product Category Name</label>
                    <input name="categoryNameForm" type="text" class="form-control" id="categoryNameForm" placeholder="Input Name">
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

<!-- Modal Add SubCategory-->
<div class="modal" tabindex="-1" id="addSubCategory" style="">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header" style="background-color:#A71C49;">
                <h5 class="modal-title" style="color:#FFFFFF">Add a Sub-category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"style="word-wrap: break-word;">
                <?php echo form_open_multipart('main/subcategory') ?>
                <!-- Modal Body -->
                <!-- Product Name Part -->
                <div class="pickCategoryForm col-12" style="padding:10px;">
                <label for="pickCategoryForm">Category</label>
                    <select class="form-control" id="pickCategoryForm" name="pickCategoryForm">
                        <option value="DDLSCTGRY-1">Tops</option>
                        <option value="DDLSCTGRY-2">Bottoms</option>
                        <option value="DDLSCTGRY-3">Dress</option>
                        <option value="DDLSCTGRY-4">Accesories</option>
                        <option value="DDLSCTGRY-5">Hats</option>
                        <option value="DDLSCTGRY-6">Shoes</option>
                    </select>
            </div>   
            <div class="subcategoryNameForm col-12" style="padding:10px;">
                    <label for="subcategoryNameForm">Product Sub-category Name</label>
                    <input name="subcategoryNameForm" type="text" class="form-control" id="subcategoryNameForm" placeholder="Input Name">
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

<!-- Modal Add Size-->
<div class="modal" tabindex="-1" id="addSize" style="">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header" style="background-color:#A71C49;">
                <h5 class="modal-title" style="color:#FFFFFF">Add a Size</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"style="word-wrap: break-word;">
                <?php echo form_open_multipart('main/size') ?>
                <!-- Modal Body -->
                <!-- Product Name Part -->
                <div class="sizeNameForm col-12" style="padding:10px;">
                    <label for="sizeNameForm">Size</label>
                    <input name="sizeNameForm" type="text" class="form-control" id="sizeNameForm" placeholder="Input Name">
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

<!-- Modal Add Brand-->
<div class="modal" tabindex="-1" id="addBrand" style="">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header" style="background-color:#A71C49;">
                <h5 class="modal-title" style="color:#FFFFFF">Add a Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"style="word-wrap: break-word;">
                <?php echo form_open_multipart('main/brand') ?>
                <!-- Modal Body -->
                <!-- Product Name Part -->
                <div class="brandNameForm col-12" style="padding:10px;">
                    <label for="brandNameForm">Brands</label>
                    <input name="brandNameForm" type="text" class="form-control" id="brandNameForm" placeholder="Input Name">
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

<!-- Modal Add Color-->
<div class="modal" tabindex="-1" id="addColor" style="">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header" style="background-color:#A71C49;">
                <h5 class="modal-title" style="color:#FFFFFF">Add a Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"style="word-wrap: break-word;">
                <?php echo form_open_multipart('main/color') ?>
                <!-- Modal Body -->
                <!-- Product Name Part -->
                <div class="colorNameForm col-12" style="padding:10px;">
                    <label for="colorNameForm">Colors</label>
                    <input name="colorNameForm" type="text" class="form-control" id="colorNameForm" placeholder="Input Name">
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

<!-- Modal Add Location-->
<div class="modal" tabindex="-1" id="addLocation" style="">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header" style="background-color:#A71C49;">
                <h5 class="modal-title" style="color:#FFFFFF">Add a Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"style="word-wrap: break-word;">
                <?php echo form_open_multipart('main/location') ?>
                <!-- Modal Body -->
                <!-- Product Name Part -->
                <div class="locationNameForm col-12" style="padding:10px;">
                    <label for="locationNameForm">Locations</label>
                    <input name="locationNameForm" type="text" class="form-control" id="locationNameForm" placeholder="Input Name">
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

<!-- Category Table Container
<div class="Category-Table container-fluid" style="margin-top: 50px">
    <div class="card">
        <div class="card-header"  style="margin-bottom: 10px; background-color:#A71C49;">
            <h3 style="color:#FFFFFF">Product Categories</h3>
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="category_table" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Category Id</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>        
        </div>
    </div>
</div> -->

<!-- SubCategory Table Container -->
<div class="Category-Table container-fluid" style="margin-top: 50px">
    <div class="card">
        <div class="card-header"  style="margin-bottom: 10px; background-color:#A71C49;">
            <h3 style="color:#FFFFFF">Product Sub-categories</h3>
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="subcategory_table" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Sub-category Id</th>
                            <th>Sub-category Name</th>
                            <th>Category</th>
                            
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>        
        </div>
    </div>
</div>

<!-- Size Table Container -->
<div class="Size-Table container-fluid" style="margin-top: 50px">
    <div class="card">
        <div class="card-header"  style="margin-bottom: 10px; background-color:#A71C49;">
            <h3 style="color:#FFFFFF">Size</h3>
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="size_table" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Size Id</th>
                            <th>Size</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>        
        </div>
    </div>
</div>

<!-- Brand Table Container -->
<div class="Brands-Table container-fluid" style="margin-top: 50px">
    <div class="card">
        <div class="card-header"  style="margin-bottom: 10px; background-color:#A71C49;">
            <h3 style="color:#FFFFFF">Brands</h3>
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="brand_table" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Brand Id</th>
                            <th>Brand</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>        
        </div>
    </div>
</div>

<!-- Color Table Container -->
<div class="Color-Table container-fluid" style="margin-top: 50px">
    <div class="card">
        <div class="card-header"  style="margin-bottom: 10px; background-color:#A71C49;">
            <h3 style="color:#FFFFFF">Colors</h3>
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="color_table" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Color Id</th>
                            <th>Color</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>        
        </div>
    </div>
</div>

<!-- Category Table Container -->
<div class="Category-Table container-fluid" style="margin-top: 50px">
    <div class="card">
        <div class="card-header"  style="margin-bottom: 10px; background-color:#A71C49;">
            <h3 style="color:#FFFFFF">Locations</h3>
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="location_table" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Location Id</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>        
        </div>
    </div>
</div>




