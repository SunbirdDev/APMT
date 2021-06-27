
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="card border-0 mb-4 no-bg">
                            <div class="card-header py-3 px-0 d-sm-flex align-items-center  justify-content-between border-bottom">
                                <h3 class=" fw-bold flex-fill mb-0 mt-sm-0">Employee</h3>
                                <button type="button" class="btn btn-dark me-1 mt-1 w-sm-100" data-bs-toggle="modal" data-bs-target="#createemp"><i class="icofont-plus-circle me-2 fs-6"></i>Add Member</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-2 row-deck py-1 pb-4">
                    <?php 
                        if(isset($employees)){
                            foreach($employees as $key => $row){
                    ?>
                    <div class="col">
                        <div class="card teacher-card">
                            <div class="card-body d-flex">
                                <div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
                                    <?php
                                        if($row->emp_profile != ''){
                                    ?>
                                    <img src="<?php echo base_url();?><?php echo $row->emp_profile;?>" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                    <?php }else{?>
                                    <img src="<?php echo base_url();?>assets/images/user.png" alt="" class="avatar xl rounded-circle im-thumbnail shadow-sm">
                                    <?php } ?>
                                </div>
                                <div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
                                    <h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo $row->emp_name;?></h6>
                                    <div class="video-setting-icon mt-3 pt-3 border-top">
                                        <p><?php echo $row->note?></p>
                                    </div>
                                    <a href="<?php echo base_url();?>employee-profile/<?php echo $row->id;?>" class="btn btn-dark btn-sm mt-1"><i class="icofont-invisible me-2 fs-6"></i>Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
        <!-- Create Employee-->
        <div class="modal fade" id="createemp" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Add Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url();?>addemployees" id="employee" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleFormControlInput877" class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="Employee Name" id="emp_name" name="emp_name">
                            </div>
                            <div class="mb-3">
                                <label for="formFileMultipleoneone" class="form-label">Profile</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <div class="deadline-form">
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-6">
                                            <label for="exampleFormControlInput1778" class="form-label">Member ID</label>
                                            <input type="text" class="form-control" id="emp_id" name="emp_id" placeholder="Employee Id">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="exampleFormControlInput2778" class="form-label">Joining Date</label>
                                            <input type="date" class="form-control" id="joining_date" name="joining_date">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                    <div class="col">
                                        <label for="exampleFormControlInput177" class="form-label">User Name</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="User Name">
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlInput277" class="form-label">Password</label>
                                        <input type="Password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                    </div> 
                                    <div class="row g-3 mb-3">
                                        <div class="col">
                                            <label for="exampleFormControlInput477" class="form-label">Email ID</label>
                                            <input type="email" class="form-control" id="emp_email" name="emp_email" placeholder="Email Address">
                                        </div>
                                        <div class="col">
                                            <label for="exampleFormControlInput777" class="form-label">Mobile</label>
                                            <input type="text" class="form-control" id="emp_phone" name="emp_phone" placeholder="Phone Number">
                                        </div>
                                    </div>
                            </div>
                            <div class="mb-3">          
                                <label for="exampleFormControlTextarea78" class="form-label">Note (optional)</label>
                                <textarea class="form-control" id="note" name="note" rows="3" placeholder="Add any extra details about the request"></textarea>
                            </div> 
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>Project Permission</th>
                                            <th class="text-center">Read</th>
                                            <th class="text-center">Create</th>
                                            <th class="text-center">Update</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">Projects</td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="1" id="project_read" name="project_read">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="1" id="project_read" name="project_create">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="1" id="project_read" name="project_update">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="1" id="project_read" name="project_delete">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="fw-bold">Tasks</td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="1" id="project_read" name="tasks_read">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="1" id="project_read" name="tasks_create">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="1" id="project_read" name="tasks_update">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="1" id="project_read" name="tasks_delete">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="fw-bold">Timing Sheets</td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="1" id="project_read" name="timesheet_read">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="1" id="project_read" name="timesheet_create">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="1" id="project_read" name="timesheet_update">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="1" id="project_read" name="timesheet_delete">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="Submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>  
            </div>
        </div>