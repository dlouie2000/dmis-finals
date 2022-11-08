<div class="container-fluid">
    <h1 class="mt-4" style="padding: 10px;">Notifications</h1>
    
    <div class="container-fluid" style="margin-bottom: 10px; padding: 10px;">
        <a href="<?= base_url('main/markreadall') ?>" onclick="return confirm('Mark Read All?');" class="btn btn-primary">Mark All as Read</a>
        <a href="<?= base_url('main/removeall') ?>" onclick="return confirm('Delete All Notifications?');" class="btn btn-danger">Delete All</a>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <?= $this->session->flashdata('msg') ?>


            <div class="card shadow">
                <div class="card-body">

                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php $index = 1 ?>
                        <?php foreach($notifs as $data): ?>
                            <tr>
                                    <td><?= $index++ ?></td>
                                    <td><?= $data['title'] ?></td>
                                    <td><?= $data['message'] ?></td>
                                    <td>
                                        <?php if($data['is_read'] == 0): ?> 
                                            <a href="<?= base_url('main/markasread/' . $data['id']) ?>" class="btn btn-danger">Read</a> 
                                            <?php else: ?>

                                            <?php endif; ?>
                                    </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>          
                </div>
             </div>
         </div>
     </div>
 </div>
