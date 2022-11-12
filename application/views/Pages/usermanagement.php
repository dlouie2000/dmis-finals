<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- USER FORMS -->
<div class="Usermanagement-Form container-fluid" style ="width:auto; margin-top:30px;">
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
    <div class="card mx-auto">
        <div class="card-header" style="background-color:#A71C49;">
            <h3 style="color: white;">Add User </h3>
            <h7 style="color: white;">Add a new user to the system</h7>
        </div>
        <div class="card-body">
        <?php echo form_open_multipart('main/usermanagement') ?>
        <div class="form-row">
            <div class="userNameForm col-md-6" style="padding:10px;">
                <label for="userNameForm">User Name</label>
                <input name="userNameForm" type="text" class="form-control" id="userNameForm"  placeholder="">
            </div>
            <div class="emailForm col-md-6" style="padding:10px;">
                <label for="emailForm">Email</label>
                <input name="emailForm" type="email" class="form-control" id="emailForm"  placeholder="">
            </div>
            <!-- Password -->
            <div class="userpasswordForm col-md-6" style="padding:10px;">
                <label for="userpasswordForm">Password</label>
                <input name="userpasswordForm" type="password" class="form-control" id="userpasswordForm" placeholder="">
            </div>
            <div class="userpasswordconfirmForm col-md-6" style="padding:10px;">
                <label for="userpasswordconfirmForm">Confirm Password</label>
                <input name="userpasswordconfirmForm" type="password" class="form-control" id="userpasswordconfirmForm" placeholder="">
            </div>
            <!-- Pin -->
            <div class="userpinForm col-md-6" style="padding:10px;">
                <label for="userpinForm">User Pin (for deleting, editing, requesting and approving products)</label>
                <input name="userpinForm" type="password" class="form-control" id="userpinForm" placeholder="">
            </div>
            <div class="userpinconfirmForm col-md-6" style="padding:10px;">
                <label for="userpinconfirmForm">Confirm User Pin</label>
                <input name="userpinconfirmForm" type="password" class="form-control" id="userpinconfirmForm" placeholder="">
            </div> 
            <div class="userRoleForm col-12" style="padding:10px;">
                <label for="userRoleForm">Role</label>
                    <select class="form-control" id="userRoleForm" name="userRoleForm">
                        <option value="1">Admin</option>
                        <option value="2">Warehouse Personnel</option>
                    </select>
            </div>
        <!-- Create Button  -->
        <button type="submit" style="margin-top: 30px;" class="btn btn-primary">Create User</button>
        <?php echo form_close() ?>
        </div>
    </div>         
</div>

<!-- USERS TABLE -->
<div class="User-Table container-fluid" style="margin-top: 20px">
    <div class="card">
        <div class="card-header"  style="margin-bottom: 10px; background-color:#A71C49;">
            <h3 style="color:#FFFFFF">Users</h3>
            <h7 style="color:#FFFFFF"></h7>
        </div>
        <div class="card-body" style="padding: 10px;">
            <div class="table-responsive">
                <table id="users_tbl" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Date & Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>        
        </div>
    </div>
</div>

