<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

	<head>
  <title>DMIS</title>
  <link rel="icon" type="image/x-icon" href="application/assets/images//crownfolder_99342.ico">


		<meta charset="UTF-8">
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,600&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
		<!-- Bootstrap v4.6 -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
		<!-- Local CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>application/views/HeaderNFooter/style.css">
		<!-- Data Tables -->
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
        <link rel="stylesheet" href=https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css/>
        <link rel="stylesheet" href=https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css/>
		<!-- Icon Usage from FontAwesome -->
		<script src="https://kit.fontawesome.com/32c4a45da3.js" crossorigin="anonymous"></script>
	</head>

<body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>

$(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

</script>

<div class="wrapper" style="background-color: #A71C49">

<ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0 ml-0">
	<?php
	$notifs = $this->db->get_where('tbl_notif', ['is_read' => 0])->result_array();
	$notifs_count = count($notifs);

	// $content = $this->db->get_where('tbl_notif', ['is_read' => 0])->result_array();
	?>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toogle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-bell fa-fw" style="color: #FFFFFF"></i><span class="badge badge-info"><?= $notifs_count ?></span>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
	<?php foreach($notifs as $data): ?>
		<a class="dropdown-item" href="<?= base_url('notifications') ?>"><?= $data['message'] ?> </a>
	<?php endforeach; ?>


</div>
</li>
</ul>

<div id="sidebar" onmouseover="toggleSidebar()" onmouseout="toggleSidebar()">
				<img src="<?php echo base_url(); ?>application/assets/images/dmis-logo-v2-white.png" alt="profile picture"  class="img-fluid my-3 p-1 d-none d-md-block"/>
				<ul class="list-unstyled components">
					<?php if($this->session->userdata('level')==='1'):?>
						<a href="<?php echo base_url('home')?>">
							<li <?php echo (($this->uri->segment(1) == '' || $this->uri->segment(1) == 'main') ? "active" : null) ?> class="active">
								<i class="fa-solid fa-house fa-fw"></i>
								<span>Home</span>
							</li>
						</a>
						<a href="<?php echo base_url('products')?>">
							<li <?php echo (($this->uri->segment(1) == 'products' || $this->uri->segment(1) == 'main') ? "active" : null) ?>>
								<i class="fa-solid fa-boxes-stacked fa-fw"></i>
								<span>Products</span>
							</li>
						</a>
						<a href="<?php echo base_url('report')?>">
							<li <?php echo (($this->uri->segment(1) == 'report' || $this->uri->segment(1) == 'main') ? "active" : null) ?>>
								<i class="fa-solid fa-chart-pie fa-fw"></i>
								<span>Report</span>
							</li>
						</a>
						<a href="<?php echo base_url('approveproducts')?>">
							<li <?php echo (($this->uri->segment(1) == 'approveproducts' || $this->uri->segment(1) == 'main') ? "active" : null) ?>>
								<i class="fa-solid fa-thumbs-up fa-fw"></i>
								<span>Product Approval</span>
							</li>
						</a>
						<a href="<?php echo base_url('notifications')?>">
							<li <?php echo (($this->uri->segment(1) == 'notifications' || $this->uri->segment(1) == 'main') ? "active" : null) ?>>
							<i class="fa-solid fa-bell"></i>
								<span>Notifications</span>
							</li>
						</a>
						<a href="<?php echo base_url('usermanagement')?>">
							<li <?php echo (($this->uri->segment(1) == 'usermanagement' || $this->uri->segment(1) == 'main') ? "active" : null) ?>>
							<i class="fa-solid fa-users"></i>
								<span>User Management</span>
							</li>
						</a>
						

						<hr class="solid">
						
					<?php elseif($this->session->userdata('level')==='2'):?>
						<a href="<?php echo base_url('products')?>">
							<li <?php echo (($this->uri->segment(1) == 'products' || $this->uri->segment(1) == 'main') ? "active" : null) ?>>
								<i class="fa-solid fa-boxes-stacked fa-fw"></i>
								<span>Products</span>
							</li>
						</a>	
						<a href="<?php echo base_url('reqproducts')?>">
							<li <?php echo (($this->uri->segment(1) == 'reqproducts' || $this->uri->segment(1) == 'main') ? "active" : null) ?>>
								<i class="fa-solid fa-boxes-packing fa-fw"></i>
								<span>Request Product</span>
							</li>
						</a>	
						<a href="<?php echo base_url('category')?>">
							<li <?php echo (($this->uri->segment(1) == 'category' || $this->uri->segment(1) == 'main') ? "active" : null) ?>>
								<i class="fa-solid fa-list fa-fw"></i>
								<span>Category</span>
							</li>
						</a>
						<a href="<?php echo base_url('notifications')?>">
							<li <?php echo (($this->uri->segment(1) == 'notifications' || $this->uri->segment(1) == 'main') ? "active" : null) ?>>
								<i class="fa-solid fa-bell"></i>
								<span>Notifications</span>
							</li>
						</a>
						<hr class="solid">	
					<?php endif;?>
					<a href="<?php echo site_url('Login/logout');?>">
						<li>
							<i class="fa-solid fa-right-from-bracket fa-fw"></i><span>Log out</span>
						</li>
					</a>
				</ul>
			</div> <!-- sidebar -->
		</div> <!-- wrapper -->
	<div id="content">
</body>
</html>


