<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
  ?>

  <div class="Home" style="margin-left: 20px; margin-right: 20px;">
    <div class="dashBoard card" style ="width:auto; margin-top:30px; ">
      <div class="card-header" style="background-color:#A71C49;">
      <?php if($this->session->userdata('level')==='1'):?>
        <H3 style="color: white;">Good day Admin User!</H3>
      <?php elseif($this->session->userdata('level')==='2'):?>
        <H3>Good day Warehouse User!</H3>
        <?php endif;?>
      </div>
    </div>
    <div class="notificationBoard card" style=" margin-top: 30px; margin-bottom: 30px; <?php echo (!empty($notif)? null: 'display: none;') ?>"> 
      <div class="card-header" style="background-color:#A71C49;">
        <H3 style="color: white;">Notice Board</H3>
      </div>
      <div class="card-body">
        <h5> Products that are Low on Stocks: </h5>
        <ul>
            <?php
              foreach ($notif as $list){ 
                echo "<li> Product Name: $list->productName | Product ID: $list->productId | Product Condition: $list->productCondition | $list->productLocation </li>";
              }
            ?>
        </ul>
      </div>
    </div>
  </div> <!-- class="Home" -->

  <!-- DASHBOARD SQUARES -->
  <div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="row square justify-content-md-center">
						<div class="col-md-auto"> <!-- for icon -->
							<i class="fa-solid fa-truck-ramp-box fa-5x align-self-center dashBoard-icon"></i>
						</div>
						<div class="col-md-4"> <!-- for label -->
							<h1><b>
                <?php
                  foreach ($stock as $list){
                    echo $list->stock;
                  }
                ?>
							</b></h1>
							<label>TOTAL STOCK <br> QUANTITY</label>
						</div>
					</div>
					<div class="row square justify-content-md-center">
						<div class="col-md-auto"> <!-- for icon -->
							<i class="fa-solid fa-list-check fa-5x dashBoard-icon"></i>
						</div>
						<div class="col-md-4"> <!-- for label -->
							<h1><b>
                <?php
                  foreach ($request as $list){
                  echo $list->request;
                  }
                ?>
							</b></h1>
							<label>REQUEST TO <br> BE APPROVED</label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row square justify-content-md-center">
						<div class="col-md-auto"> <!-- for icon -->
							<i class="fa-solid fa-check-to-slot fa-5x dashBoard-icon"></i>
						</div>
						<div class="col-md-4"> <!-- for label -->
							<h1><b>
                <?php
                  foreach ($released as $list){
                  echo $list->released;
                  }
                ?>
							</b></h1>
							<label>TOTAL APPROVED <br> REQUEST BY <?php echo date('Y')?> </label>
						</div>
					</div>
					<div class="row square justify-content-md-center">
						<div class="col-md-auto"> <!-- for icon -->
							<i class="fa-solid fa-shirt fa-5x dashBoard-icon"></i>
						</div>
						<div class="col-md-4"> <!-- for label -->
							<h1><b>
                <?php
                  foreach ($totNum as $list){
                  echo $list->totNum;
                }
                ?>
							</b></h1>
							<label>TOTAL NUMBER <br> OF UNIQUE PRODUCTS</label>
						</div>
					</div>
				</div>
			</div>
		</div>
</div> <!-- class="content" from Header.php -->  



<!-- Top Report Table Container
<div class = "row">
  <div class="Toprequestedproduct-Table col-md-6" style="margin-top: 50px">
    <div class="card">
      <div class="card-header"  style="margin-bottom: 10px">
        <h3 style= "text-align: center;">Top Requested Products</h3>
      </div>
      <div class="card-body" >
        <div class="table-responsive">
          <table id="toprequestedproduct_table" class="display" width="100%">
            <thead>
              <tr>
                <th>Product Id</th>
                <th>Product Name</th>
              </tr>
            </thead>
          </table>
        </div>    
      </div>
    </div>
  </div>
  <div class="Toprequestedproductcategory-Table col-md-6" style="margin-top: 50px">
    <div class="card">
      <div class="card-header"  style="margin-bottom: 10px">
        <h3 style= "text-align: center;">Top Requested Product Categories</h3>
      </div>
      <div class="card-body" >
        <div class="table-responsive">
          <table id="toprequestedproductcategory_table" class="display" width="100%">
            <thead>
              <tr>
                <th>Category Name</th>
                <th>Quantity</th>
              </tr>
            </thead>
          </table>
        </div>    
      </div>
    </div>
  </div> -->