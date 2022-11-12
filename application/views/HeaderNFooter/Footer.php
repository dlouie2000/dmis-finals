<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Add all script and other footer source here! -->      
		<!-- Script Source Files -->

		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>		
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>

		<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		

		
		<!-- Confirmation Messages -->
		<!-- onclick="return ConfirmDelete()" -->
		<script>
			var mini = true;
			function toggleSidebar() {
				if (mini) {
					console.log("opening sidebar");
					document.getElementById("sidebar").style.width = "250px";
					document.getElementById("content").style.marginLeft = "250px";
					this.mini = false;
				} else {
					console.log("closing sidebar");
					document.getElementById("sidebar").style.width = "70px";
					document.getElementById("content").style.marginLeft = "70px";
					this.mini = true;
				}
			}
		</script>

		<script>
			{
			let sideBar = document.querySelector('.side-bar');
			let arrowCollapse = document.querySelector('#logo-name__icon');
			sideBar.onclick = () => {
				sideBar.classList.toggle('collapse');
				arrowCollapse.classList.toggle('collapse');
				if (arrowCollapse.classList.contains('collapse')) {
				arrowCollapse.classList =
					'bx bx-arrow-from-left logo-name__icon collapse';
				} else {
				arrowCollapse.classList = 'bx bx-arrow-from-right logo-name__icon';
				}
			};
			}
		</script>

		<!-- Product Table Page -->
		<script>
			$(document).ready( function () {
    				$('#product_table').DataTable({
					"ajax": "<?php echo base_url('main/getProducts');?>", 
					<?php if($this->session->userdata('level')==='2'):?>
						<?php elseif($this->session->userdata('level')==='1'):?>
						dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'excel',
                                className: "btn btn-info",
                                text: "Export Excel",
								title: "DoodlesManila-InboundProducts",
								exportOptions: {
									columns: [0,1,2,3,4,5,6,7,8,9,11],
								}
                            },
                            {
                                extend: 'pdf',
                                className: "btn btn-info",
                                text: "Export PDF",
								title: "DoodlesManila-InboundProducts",
								exportOptions: {
									columns: [0,1,2,3,4,5,6,7,8,9,11],
								}
                            },
							{
                                extend: 'copy',
                                className: "btn btn-info",
                                text: "Copy",
								exportOptions: {
									columns: [0,1,2,3,4,5,6,7,8,9,11],
								}
                            },
							{
                                extend: 'print',
                                className: "btn btn-info",
                                text: "Print",
								exportOptions: {
									columns: [0,1,2,3,4,5,6,7,8,9,11],
								}
                            },
							
                        ],
						<?php endif;?>
					 	columns : [
							
						{ "data" : 'productId'},
						{ "data" : 'productName' },
						{ "data" : 'categoryNamee' },
						{ "data" : 'subcategoryName' },
						{ "data" : 'productSize' },
						{ "data" : 'productBrand' },
						{ "data" : 'productColor' },
						{ "data" : 'productLocation' },
						{ "data" : 'productCondition' },
						{ "data" : 'productQuantity' },
						{
                        "data": 'productImage',
						"targets"  : 'no-sort',
      					"orderable": false,
                        render: function(data, type, row, meta) {
							var baseurl = '<?php echo base_url('') ?>';
                            var a = '<img src="'+baseurl+'application/assets/attachments/'+data+'" style="border-radius: 10px;" width="100" height="100">';
                            return a;
                        },
                    	},
						{ "data" : 'DateTime'},
						{ "data" : null,
  						render: function ( data, type, row ) {
						var baseurl = '<?php echo base_url('') ?>';
					   	<?php if($this->session->userdata('level')==='1'):?>
						//delete button
    					return '<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-id="'+data.productId+'" data-prdimagename="'+data.ProductImageName+'" data-prdimage="'+data.productImage+'" data-target="#deleteconfirmationModal"><i class="far fa-trash-alt" aria-hidden="true"></i> Delete</button>';
						//return '<a href="'+baseurl+'main/edit/'+data+'" ></a> <a href="'+baseurl+'main/delete/'+data+'" class="btn btn-danger" <?php echo (($this->uri->segment(2)) == "edit" ? 'style="display:none;"' : null)?>><i class="far fa-trash-alt" aria-hidden="true"></i> Delete</a>';
						<?php elseif($this->session->userdata('level')==='2'):?>
						//edit button
						return '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-id="'+data.productId+'" data-prdname="'+data.productName+'" data-prdcategory="'+data.productCategory+'" data-prdsubcategory="'+data.productSubcategory+'" data-prdsize="'+data.productSize+'" data-prdbrand="'+data.productBrand+'" data-prdcolor="'+data.productColor+'" data-prdlocation="'+data.productLocation+'" data-prdquantity="'+data.productQuantity+'" data-prdcondition="'+data.productCondition+'" data-datetime="'+data.DateTime+'" data-prdimagename="'+data.ProductImageName+'" data-prdimage="'+data.productImage+'" data-target="#editProduct"><i class="far fa-edit" aria-hidden="true"></i> Edit</button>';
						// return '<a href="'+baseurl+'main/edit/'+data+'" class="btn btn-sm btn-primary"><i class="far fa-edit" aria-hidden="true"></i>Edit</a> <a href="'+baseurl+'main/delete/'+data+'" " <?php echo (($this->uri->segment(2)) == "edit" ? 'style="display:none;"' : null)?>> </a>';
						// '<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#editProduct"><i class="fas fa-archive" aria-hidden="true"></i> Add a Product</button>'
						<?php endif;?>
						}
						}  
					]
				} );
			} );
			$('#editProduct').on('show.bs.modal', function (event) {
				

                var button = $(event.relatedTarget);
                var productId = button.data('id');
                var productName = button.data('prdname');
				
				//category
				var productCategory = button.data('prdcategory');
				var productSubcategory = button.data('prdsubcategory');
				var productSize = button.data('prdsize');
				var productBrand = button.data('prdbrand');
				var productColor = button.data('prdcolor');
				var productLocation = button.data('prdlocation');

                var productQuantity = button.data('prdquantity');
				var productCondition = button.data('prdcondition');
				var DateTime = button.data('datetime');
				var productImageName = button.data('prdimagename');
				var productImage = button.data('prdimage');
				var base_url1 = "<?= base_url('application/assets/attachments/') ?>";
           		var url = base_url1+productImage;
                var modal = $(this)
                
				modal.find('.modal-body #productImage').attr("src", url);
                modal.find('.modal-body #productIdField').val(productId);
                modal.find('.modal-body #productNameForm').val(productName);
				
				//category
				modal.find('.modal-body #productCategoryEditForm').val(productCategory);
				// modal.find('.modal-body #productSubcategoryForm').val(productSubcategory);
				
				$.ajax({
				url:"<?php echo base_url(); ?>main/fetch_subcategoryedit",	
				method:"POST",
				data:{categoryId:productCategory, subcategoryId:productSubcategory},
				success:function(data)
				{
				
				
				modal.find('.modal-body #productSubcategoryEditForm').html(data);
					
					
				}
				});

				modal.find('.modal-body #productSizeForm').val(productSize);
				modal.find('.modal-body #productBrandForm').val(productBrand);
				modal.find('.modal-body #productColorForm').val(productColor);
				modal.find('.modal-body #productLocationForm').val(productLocation);
				
				modal.find('.modal-body #productQuantityForm').val(productQuantity);
                modal.find('.modal-body #productConditionForm').val(productCondition);
				modal.find('.modal-body #DateTimeForm').val(DateTime);
				modal.find('.modal-body #productViewImageForm').val(productImageName);
				modal.find('.modal-body #productImageForm').val(productImage);

				
            })
			$('#deleteconfirmationModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var productId = button.data('id');
				var productImageName = button.data('prdimagename');
				var productImage = button.data('prdimage');
				var base_url1 = "<?= base_url('application/assets/attachments/') ?>";
           		var url = base_url1+productImage;
                var modal = $(this)
                
				modal.find('.modal-body #productImage').attr("src", url);
                modal.find('.modal-body #productIdField').val(productId);
				modal.find('.modal-body #productViewImageForm').val(productImageName);
				modal.find('.modal-body #productImageForm').val(productImage);
            })				
		</script>

		<!-- Request Products Page Data Table Script -->
		<script>
			$(document).ready( function () {
    				$('#reqproduct_table').DataTable({
					"ajax": "<?php echo base_url('main/getProducts');?>", 
					 	columns : [
						{ "data" : 'productId'},
						{ "data" : 'productName' },
						{ "data" : 'categoryNamee' },
						{ "data" : 'subcategoryName' },
						{ "data" : 'productSize' },
						{ "data" : 'productBrand' },
						{ "data" : 'productColor' },
						{ "data" : 'productLocation' },
						{ "data" : 'productCondition' },
						{ "data" : 'productQuantity' },
						{
                        "data": 'productImage',
						"targets"  : 'no-sort',
      					"orderable": false,
                        render: function(data, type, row, meta) {
							var baseurl = '<?php echo base_url('') ?>';
                            var a = '<img src="'+baseurl+'application/assets/attachments/'+data+'" style="border-radius: 10px;" width="100" height="100">';
                            return a;
                        },
                    	},
						{ "data" : 'DateTime'},
						{ "data" : null,
  						render: function ( data, type, row ) {
						var baseurl = '<?php echo base_url('') ?>';
						// alert(data);
						return '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-id="'+data.productId+'" data-prdname="'+data.productName+'" data-prdquantity="'+data.productQuantity+'" data-target="#reqProduct">Request Product</button>';
    					// return '<a href="'+baseurl+'main/reqproducts/'+data+'" class="btn btn-sm btn-success">Select Product</a>';
						}
						}
					]
				} );
			} );

			$('#reqProduct').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var productId = button.data('id');
                var productName = button.data('prdname');
                var productQuantity = button.data('prdquantity');
                // alert("test");
                var modal = $(this)
                
                modal.find('.modal-body #productIdField').val(productId);
                modal.find('.modal-body #reqproductNameForm').val(productName);
                modal.find('.modal-body #reqproductQuantityForm').val(productQuantity);
            })

		</script>

		<!-- Sub-categories chu chu -->
		<script>
			$("#sample_group").change(function(){
				var temp = $("#region_group").val();
				$.ajax({
					url:"<?php echo base_url('main/category'); ?>",
					method:"POST",
					data:new FormData(this),
					contentType:false,
					cache:false,
					processData:false,
					type: 'post',
					data: {selectedRegion: temp},
					success:function(response){
						var html = '<option value="">Select Sub-c</option>';
						var obj = JSON.parse(response);
						for(var key in obj){
							if (obj.hasOwnProperty(key)){
								var value=obj[key];
								html += '<option value="'+key+'">'+key+'</option>';
							}
						}
						$('#province_group').html(html);
					}
				});
			});
		</script>

		<!-- Category Dropdowns -->
		<script>
			$(document).ready(function(){
			$('#productCategoryForm').change(function(){
			//alert("david");
			var categoryId = $('#productCategoryForm').val();
			if(categoryId != '')
			{
			$.ajax({
			url:"<?php echo base_url(); ?>main/fetch_subcategory",	
			method:"POST",
			data:{categoryId:categoryId},
			success:function(data)
			{
				$('#productSubcategoryForm').html(data);
				$('#productStyleForm').html('<option value="">Select Style</option>');
			}
			});
			}
			else
			{
				$('#productSubcategoryForm').html('<option value="">Select Sub-category</option>');
				$('#productStyleForm').html('<option value="">Select Style</option>');
			}
			});

			$('#productSubcategoryForm').change(function(){
			var subcategoryId = $('#productSubcategoryForm').val();
			if(subcategoryId != '')
			{
			$.ajax({
			url:"<?php echo base_url(); ?>main/fetch_style",
			method:"POST",
			data:{subcategoryId:subcategoryId},
			success:function(data)
			{
				$('#productStyleForm').html(data);
			}
			});
			}
			else
			{
				$('#productStyleForm').html('<option value="">Select Style</option>');
			}
			});
			});
		</script>

		<!-- Edit category -->
		<script>
			$(document).ready(function(){
			$('#productCategoryEditForm').change(function(){
			//alert("david");
			var categoryId = $('#productCategoryEditForm').val();
			if(categoryId != '')
			{
			$.ajax({
			url:"<?php echo base_url(); ?>main/fetch_subcategory",	
			method:"POST",
			data:{categoryId:categoryId},
			success:function(data)
			{
				$('#productSubcategoryEditForm').html(data);
				$('#productStyleForm').html('<option value="">Select Style</option>');
			}
			});
			}
			else
			{
				$('#productSubcategoryEditForm').html('<option value="">Select Sub-category</option>');
				$('#productStyleForm').html('<option value="">Select Style</option>');
			}
			});

			$('#productSubcategoryEditForm').change(function(){
			var subcategoryId = $('#productSubcategoryEditForm').val();
			if(subcategoryId != '')
			{
			$.ajax({
			url:"<?php echo base_url(); ?>main/fetch_style",
			method:"POST",
			data:{subcategoryId:subcategoryId},
			success:function(data)
			{
				$('#productStyleForm').html(data);
			}
			});
			}
			else
			{
				$('#productStyleForm').html('<option value="">Select Style</option>');
			}
			});
			});
		</script>

		<!-- Status Product Table Warehouse User -->
		<script>
			$(document).ready( function () {
    				$('#statusproduct_table').DataTable({
					"ajax": "<?php echo base_url('main/getRequests');?>", //echo base url needs to change
					<?php if($this->session->userdata('level')==='2'):?>
					<?php elseif($this->session->userdata('level')==='1'):?>
					dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'excel',
                                className: "btn btn-info",
                                text: "Export Excel",
								title: "DoodlesManila-StatusProducts",
								exportOptions: {
									columns: [0, 1, 2, 3, 4,5,6,7,8,9,10,11,12],
								}
                            },
                            {
                                extend: 'pdf',
                                className: "btn btn-info",
                                text: "Export PDF",
								title: "DoodlesManila-StatusProducts",
								exportOptions: {
									columns: [0, 1, 2, 3, 4,5,6,7,8,9,10,11,12],
								}
                            },
							{
                                extend: 'copy',
                                className: "btn btn-info",
                                text: "Copy",
								exportOptions: {
									columns: [0, 1, 2, 3, 4,5,6,7,8,9,10,11,12],
								}
                            },
							{
                                extend: 'print',
                                className: "btn btn-info",
                                text: "Print",
								exportOptions: {
       								columns: [0, 1, 2, 3, 4, 6],
								}
                            },
							
                        ],
						<?php endif;?>
					 	columns : [
						{ "data" : 'reqproductId', visible: false,
                		searchable: false, },
						{ "data" : 'productId' },
						{ "data" : 'productName' },
						{ "data" : 'categoryNamee' },
						{ "data" : 'reqproductQuantity' },
						{
                        "data": 'productImage',
						"targets"  : 'no-sort',
      					"orderable": false,
                        render: function(data, type, row, meta) {
							var baseurl = '<?php echo base_url('') ?>';
                            var a = '<img src="'+baseurl+'application/assets/attachments/'+data+'" style="border-radius: 10px;" width="100" height="100">';
                            return a;
                        },
                    	},		
						{ "data" : 'reqDateTime' },
						{ "data" : 'reqproductStatus' },
						{ "data" : 'approveDateTime' },
						//release product button insert here 	
					]
				} );
			} );
		</script>

	<!-- <script>
		// Selecting the iframe element
		var iframe = document.getElementById("graphsAnalytical");
		
		// Adjusting the iframe height onload event
		iframe.onload = function(){
			iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
		}
    </script> -->


		<!-- Notification -->
		<!-- <script>
			$(document).ready( function () {
    				$('#notifications_table').DataTable({
					"ajax": "<?php echo base_url('main/notifications_list');?>", //echo base url needs to change
					 	columns : [
						{ "data" : 'id' },
						{ "data" : 'title' },
						{ "data" : 'message' },
						{ "data" : 'is_read' },
						//release product button insert here 	
					]
				} );
			} );
		</script> -->

		<!-- Status Product Table Admin User -->
		<script>
			$(document).ready( function () {
    				$('#adminstatusproduct_table').DataTable({
					"ajax": "<?php echo base_url('main/getRequestAdminView');?>", //echo base url needs to change
					dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'excel',
                                className: "btn btn-info",
                                text: "Export Excel",
								title: "DoodlesManila-StatusProducts",
								exportOptions: {
									columns: [0,1,2,3,4,5],
								}
                            },
                            {
                                extend: 'pdf',
                                className: "btn btn-info",
                                text: "Export PDF",
								title: "DoodlesManila-StatusProducts",
								exportOptions: {
									columns: [0,1,2,3,4,5],
								}
                            },
							{
                                extend: 'copy',
                                className: "btn btn-info",
                                text: "Copy",
								exportOptions: {
									columns: [0,1,2,3,4,5],
								}
                            },
							{
                                extend: 'print',
                                className: "btn btn-info",
                                text: "Print",
								exportOptions: {
									columns: [0,1,2,3,4,5],
								}
                            },
							
                        ],
					 	columns : [
						{ "data" : 'reqproductId', visible: false,
                		searchable: false, }, // hide :))
						{ "data" : 'productId' },
						{ "data" : 'reqproductQuantity' },
						{ "data" : 'reqDateTime' },
						{ "data" : 'reqproductStatus' },
						{ "data" : 'approveDateTime' },	
						{ "data" : null ,
  						render: function ( data, type, row ) {
						var baseurl = '<?php echo base_url('') ?>';
						//approve and reject confirmation message password
						// return '<a href="'+baseurl+'main/approve/'+data+'" class="btn btn-primary onclick="return ConfirmApprove()"">Approve</a> <a href="'+baseurl+'main/reject/'+data+'" class="btn btn-danger onclick="return ConfirmReject()"">Reject</a>';
						//approve
						return '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-id="'+data.productId+'" data-reqid="'+data.reqproductId+'" data-qty="'+data.productQuantity+'" data-reqqty="'+data.reqproductQuantity+'" data-target="#approveconfirmationModal"><i class="fa-solid fa-check"></i> Approve</button> <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-id="'+data.productId+'" data-reqid="'+data.reqproductId+'" data-reqqty="'+data.reqproductQuantity+'" data-target="#rejectconfirmationModal"><i class="fa-solid fa-x"></i> Reject</button>'
						; 
						}
						}
					]
				} );
			} );
			$('#approveconfirmationModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var productId = button.data('id');
				var reqproductId = button.data('reqid');
				var reqproductQuantity = button.data('reqqty');
				var productQuantity = button.data('qty');
				
                var modal = $(this)
                modal.find('.modal-body #productIdField').val(productId);
                modal.find('.modal-body #reqproductIdField').val(reqproductId);
				modal.find('.modal-body #reqproductQuantityField').val(reqproductQuantity);
				modal.find('.modal-body #productQuantityField').val(productQuantity);
            })
			$('#rejectconfirmationModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var productId = button.data('id');
				var reqproductId = button.data('reqid');
				var reqproductQuantity = button.data('reqqty');
				var productQuantity = button.data('qty');
				
                var modal = $(this)
                modal.find('.modal-body #productIdField').val(productId);
                modal.find('.modal-body #reqproductIdField').val(reqproductId);
				modal.find('.modal-body #reqproductQuantityField').val(reqproductQuantity);
				modal.find('.modal-body #productQuantityField').val(productQuantity);
            })
		</script>

		<!-- Category Table Admin/Warehouse User -->
		<script>
			$(document).ready( function () {
    				$('#category_table').DataTable({
					"ajax": "<?php echo base_url('main/getCategories');?>", //echo base url needs to change
					 	columns : [
						{ "data" : 'categoryID', visible: false,
                		searchable: false, }, // id hide :))
						{ "data" : 'categoryName' },
						{ "data" : 'categoryID',
							render: function ( data, type, row ) 
							{	
								var baseurl = '<?php echo base_url('') ?>';
								return '<a href="'+baseurl+'main/deletecategory/'+data+'" class="btn btn-sm btn-danger" onclick="return ConfirmDelete()" ">Delete</a>';
							}
						}
					]
				} );
			} );
		</script>

		<!-- Category Table Admin/Warehouse User -->
		<script>
			$(document).ready( function () {
    				$('#subcategory_table').DataTable({
					"ajax": "<?php echo base_url('main/getSubCategories');?>", //echo base url needs to change
					 	columns : [
						{ "data" : 'subcategoryId', visible: false,
                		searchable: false, }, // id hide :))
						{ "data" : 'subcategoryName' },
						{ "data" : 'categoryNamee' },
						{ "data" : 'subcategoryId',
							render: function ( data, type, row ) 
							{	
								var baseurl = '<?php echo base_url('') ?>';
								return '<a href="'+baseurl+'main/deletesubcategory/'+data+'" class="btn btn-sm btn-danger" onclick="return ConfirmDelete()" ">Delete</a>';
							}
						}
					]
				} );
			} );
		</script>

		<!-- Size Table Admin/Warehouse User -->
		<script>
			$(document).ready( function () {
    				$('#size_table').DataTable({
					"ajax": "<?php echo base_url('main/getSize');?>", //echo base url needs to change
					 	columns : [
						{ "data" : 'sizeId', visible: false,
                		searchable: false, }, // id hide :))
						{ "data" : 'sizeName' },
						{ "data" : 'sizeId',
							render: function ( data, type, row ) 
							{	
								var baseurl = '<?php echo base_url('') ?>';
								return '<a href="'+baseurl+'main/deletesize/'+data+'" class="btn btn-sm btn-danger"">Delete</a>';
							}
						}
					]
				} );
			} );
		</script>

		<!-- Brand Table Admin/Warehouse User -->
		<script>
			$(document).ready( function () {
    				$('#brand_table').DataTable({
					"ajax": "<?php echo base_url('main/getBrands');?>", //echo base url needs to change
					 	columns : [
						{ "data" : 'brandId', visible: false,
                		searchable: false, }, // id hide :))
						{ "data" : 'brandName' },
						{ "data" : 'brandId',
							render: function ( data, type, row ) 
							{	
								var baseurl = '<?php echo base_url('') ?>';
								return '<a href="'+baseurl+'main/deletebrand/'+data+'" class="btn btn-sm btn-danger"">Delete</a>';
							}
						}
					]
				} );
			} );
		</script>

		<!-- Color Table Admin/Warehouse User -->
		<script>
			$(document).ready( function () {
    				$('#color_table').DataTable({
					"ajax": "<?php echo base_url('main/getColor');?>", //echo base url needs to change
					 	columns : [
						{ "data" : 'colorId', visible: false,
                		searchable: false, }, // id hide :))
						{ "data" : 'colorName' },
						{ "data" : 'colorId',
							render: function ( data, type, row ) 
							{	
								var baseurl = '<?php echo base_url('') ?>';
								return '<a href="'+baseurl+'main/deletecolor/'+data+'" class="btn btn-sm btn-danger"">Delete</a>';
							}
						}
					]
				} );
			} );
		</script>

		<!-- Color Table Admin/Warehouse User -->
		<script>
			$(document).ready( function () {
    				$('#location_table').DataTable({
					"ajax": "<?php echo base_url('main/getLocation');?>", //echo base url needs to change
					 	columns : [
						{ "data" : 'locationId', visible: false,
                		searchable: false, }, // id hide :))
						{ "data" : 'locationName' },
						{ "data" : 'locationId',
							render: function ( data, type, row ) 
							{	
								var baseurl = '<?php echo base_url('') ?>';
								return '<a href="'+baseurl+'main/deletelocation/'+data+'" class="btn btn-sm btn-danger"">Delete</a>';
							}
						}
					]
				} );
			} );
		</script>
		
		<!-- User Management Table -->
		<script>
			$(document).ready( function () {
    				$('#users_tbl').DataTable({
					"ajax": "<?php echo base_url('main/getUsers');?>", //echo base url needs to change
					 	columns : [ // id hide :))
						{ "data" : 'username' },
						{ "data" : 'level' },
						{ "data" : 'userEmail' },
						{ "data" : 'userDatetime' },
						{ "data" : 'userId',
							render: function ( data, type, row ) 
							{	
								var baseurl = '<?php echo base_url('') ?>';
								return '<a href="'+baseurl+'main/edituser/'+data+'" class="btn btn-primary">Edit</a>  <a href="'+baseurl+'main/deleteuser/'+data+'" " <?php echo (($this->uri->segment(2)) == "edituser" ? 'style="display:none;"' : null)?>> </a> <a href="'+baseurl+'main/edituser/'+data+'" ></a> <a href="'+baseurl+'main/deleteuser/'+data+'" class="btn btn-danger" <?php echo (($this->uri->segment(2)) == "edituser" ? 'style="display:none;"' : null)?>> Delete</a>';
								//return '<a href="'+baseurl+'main/edituser/'+data+'" class="btn btn-primary">Edit</a>  <a href="'+baseurl+'main/deleteuser/'+data+'" class="btn btn-danger"">Delete</a>' ;
							}
						}
					]
				} );
			} );
		</script>
		
		<!-- Role Management Table -->
		<script>
			$(document).ready( function () {
    				$('#role_table').DataTable({
					"ajax": "<?php echo base_url('main/getRoles');?>", //echo base url needs to change
					 	columns : [
						{ "data" : 'roleId'}, // id hide :))
						{ "data" : 'roleName' },
						{ "data" : 'roleId',
							render: function ( data, type, row ) 
							{	
								var baseurl = '<?php echo base_url('') ?>';
								return '<a href="'+baseurl+'main/deleterole/'+data+'" class="btn btn-danger"">Delete</a>';
							}
						}
					]
				} );
			} );
		</script>
		
		<!-- Top Requested Product Table -->
		<script>
			$(document).ready( function () {
    				$('#toprequestedproduct_table').DataTable({
					"ajax": "<?php echo base_url('main/getTopReqProducts');?>", //echo base url needs to change
						 ordering: false,
						 lengthChange: false,
						 searching: false,
						 bInfo : false,
						 bPaginate: false,
						 order: [[ 1, 'asc' ]],
						 columns : [ 
						{ "data" : 'productId', visible: false,searchable: false},
						{ "data" : 'productName' },
					]
				} );
			} );
		</script>

		<!-- Top Requested Product Table -->
		<script>
			$(document).ready( function () {
    				$('#toprequestedproductcategory_table').DataTable({
					"ajax": "<?php echo base_url('main/getTopReqCategories');?>", //echo base url needs to change
						 ordering: false,
						 lengthChange: false,
						 searching: false,
						 bInfo : false,
						 bPaginate: false,
						 order: [[ 1, 'asc' ]],
						 columns : [ 
						{ "data" : 'productCategory' },
						{ "data" : 'count' },
					]
				} );
			} );
		</script>

        <!-- HighChart.js -->
        <script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/highcharts.src.js"></script>
		<script src="<?php echo base_url(); ?>application/assets/js/charts.js"></script> 	

		
		<script type="text/javascript">
			$(function () { 
				
				var dataYear = <?php echo $dataYear; ?>;
				 
				$('#yearlyTotalQuantity').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: 'Total Inbound Products per Year'
					},
					xAxis: {
						categories: 
						[
							<?php 
								$counter = 0;
								$length = count($year);
								foreach ($year as $list){
									if ($length-1===$counter) {
										echo $list->year;
									} else {
										echo $list->year.',';
									}
								}
							?>
						]

					},
					yAxis: {
						title: {
							text: 'Number of Products'
						}
					},
					series: [{
						name: 'Year',
						data: dataYear
					}]
				});
			});
  
		</script>
		
		<script type="text/javascript">
			$(function () { 
				var dataMonth = <?php echo $dataMonth; ?>;
				$('#monthTotalQuantity').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: 'Total Inbound Products per Month'
					},
					xAxis: {
						categories: 
						[
							<?php
								$counter = 0;
								$length = count($month);
								foreach ($month as $list){
									if ($length-1===$counter) {
										echo '"'.date('F', strtotime($list->DateTime)).'"'.',';
									} else {
										echo '"'.date('F', strtotime($list->DateTime)).'"'.',';
									}
								}
							?>
						]
					},

					yAxis: {
						title: {
							text: 'Number of Products'
						}
					},
					series: [{
						name: 'Month',
						data: dataMonth
					}]
				});
				responsive: {
						rules: [{
							condition: {
								maxWidth: 500
							},
							chartOptions: {
								legend: {
									align: 'center',
									verticalAlign: 'bottom',
									layout: 'horizontal'
								}
							}
						}]
					}
				});
  
		</script>
</body>
</html>