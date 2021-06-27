            <?php foreach($employeedetail as $key => $row){?>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="card border-0 mb-4 no-bg">
                            <div class="card-header py-3 px-0 d-flex align-items-center  justify-content-between border-bottom">
                                <h3 class=" fw-bold flex-fill mb-0">Employee Profile</h3>
                            </div>
                        </div>
                    </div>
                </div><!-- Row End -->
                <div class="row g-3">
                    <div class="col-xl-8 col-lg-12 col-md-12">
                        <div class="card teacher-card  mb-3">
                            <div class="card-body  d-flex teacher-fulldeatil">
                                <div class="profile-teacher pe-xl-4 pe-md-2 pe-sm-4 pe-0 text-center w220 mx-sm-0 mx-auto">
                                    <a href="#">
                                        <?php
                                            if($row->emp_profile != ''){
                                        ?>
                                        <img src="<?php echo base_url();?><?php echo $row->emp_profile;?>" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                        <?php }else{?>
                                        <img src="<?php echo base_url();?>assets/images/user.png" alt="" class="avatar xl rounded-circle im-thumbnail shadow-sm">
                                        <?php } ?>
                                    </a>
                                    <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                        <span class="text-muted small">Employee Id : <?php echo $row->emp_id;?></span>
                                    </div>
                                </div>
                                <div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
                                    <h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo $row->emp_name;?></h6>
                                    <!-- <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">Web Designer</span> -->
                                    <p class="mt-2 small"><?php echo $row->note;?></p>
                                    <div class="row g-2 pt-2">
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-ui-touch-phone"></i>
                                                <span class="ms-2 small"><?php echo $row->emp_phone;?> </span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-email"></i>
                                                <span class="ms-2 small"><?php echo $row->emp_email;?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="fw-bold  py-3 mb-3">Current Work Project</h6>
                        <div class="teachercourse-list">
                            <div class="row g-3 gy-5 py-3 row-deck">
                                <?php 
                                    foreach($project_assigned as $key => $pa){
                                        $date1 = $pa->project_start_date;
                                        $date2 = $pa->project_end_date;

                                        $ts1 = strtotime($date1);
                                        $ts2 = strtotime($date2);

                                        $year1 = date('Y', $ts1);
                                        $year2 = date('Y', $ts2);

                                        $month1 = date('m', $ts1);
                                        $month2 = date('m', $ts2);

                                        $months = (($year2 - $year1) * 12) + ($month2 - $month1);

                                        $from = strtotime($date2);
                                        $today = time();
                                        $difference = $from - $today;
                                        $days = floor($difference / 86400);
                                ?>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mt-5">
                                                <div class="lesson_name">
                                                    <div class="project-block light-info-bg">
                                                        <i class="icofont-paint"></i>
                                                    </div>
                                                    <span class="small text-muted project_name fw-bold"> <?php echo $pa->project_name;?></span>
                                                    <h6 class="mb-0 fw-bold  fs-6  mb-2"><?php echo $pa->project_category;?></h6>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-list avatar-list-stacked pt-2">
                                                        <img class="avatar rounded-circle sm" src="<?php echo base_url();?>assets/images/user.png" alt="">
                                                </div>
                                            </div>
                                            <div class="row g-2 pt-4">
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-sand-clock"></i>
                                                        <span class="ms-2"><?php echo $months;?> Month</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-group-students "></i>
                                                        <span class="ms-2"><?php echo $pa->members;?> Members</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dividers-block"></div>
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h4 class="small fw-bold mb-0">Progress</h4>
                                                <span class="small light-danger-bg  p-1 rounded"><i class="icofont-ui-clock"></i> <?php echo $days;?> Days Left</span>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary ms-1" role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary ms-1" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12">
                        <div class="card mb-3">
                            <div class="card-header py-3">
                                <h6 class="mb-0 fw-bold ">Current Task</h6>
                            </div>
                            <div class="card-body">
                                <div class="planned_task client_task">
                                    <div class="dd" data-plugin="nestable">
                                        <ol class="dd-list">
                                            <li class="dd-item mb-3">
                                                <div class="dd-handle">
                                                    <div class="task-info d-flex align-items-center justify-content-between">
                                                        <h6 class="light-info-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">UI/UX Design</h6>
                                                        <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                            <div class="avatar-list avatar-list-stacked m-0">
                                                                <img class="avatar rounded-circle small-avt sm" src="assets/images/xs/avatar2.jpg" alt="">
                                                                <img class="avatar rounded-circle small-avt sm" src="assets/images/xs/avatar1.jpg" alt="">
                                                            </div>
                                                            <span class="badge bg-warning text-end mt-1">Inprogress</span>
                                                        </div>
                                                    </div>
                                                    <p class="py-2 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id
                                                        nec scelerisque massa.</p>
                                                    <div class="tikit-info row g-3 align-items-center">
                                                        <div class="col-sm">
                                                        </div>
                                                        <div class="col-sm text-end">
                                                            <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small"> Social Geek Made </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </li>
                                            <li class="dd-item">
                                                <div class="dd-handle">
                                                    <div class="task-info d-flex align-items-center justify-content-between">
                                                        <h6 class="bg-lightgreen py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">Website Design
                                                        </h6>
                                                        <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                            <div class="avatar-list avatar-list-stacked m-0">
                                                                <img class="avatar rounded-circle small-avt sm" src="assets/images/xs/avatar7.jpg" alt="">
                                                            </div>
                                                            <span class="badge bg-danger text-end mt-1">Review</span>
                                                        </div>
                                                    </div>
                                                    <p class="py-2 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id
                                                        nec scelerisque massa.</p>
                                                    <div class="tikit-info row g-3 align-items-center">
                                                        <div class="col-sm">
                                                        </div>
                                                        <div class="col-sm text-end">
                                                            <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small"> Practice to Perfect </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header py-3">
                                <h6 class="mb-0 fw-bold ">Experience</h6>
                            </div>
                            <div class="card-body">
                                <div class="timeline-item ti-danger border-bottom ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">PW</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Pixel Wibes</strong></div>
                                            <span class="d-flex text-muted">Jan 2016 - Present (5 years 2 months)</span>
                                        </div>
                                    </div>
                                </div> <!-- timeline item end  -->
                                <div class="timeline-item ti-info border-bottom ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink">CC</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Crest Coder</strong></div>
                                            <span class="d-flex text-muted">Dec 2015 - 2016 (1 years)</span>
                                        </div>
                                    </div>
                                </div> <!-- timeline item end  -->
                                <div class="timeline-item ti-success  ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-lavender-purple">MW</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Morning Wibe</strong></div>
                                            <span class="d-flex text-muted">Nov 2014 - 2015 (1 years)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item ti-danger border-bottom ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">FF</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>FebiFlue</strong></div>
                                            <span class="d-flex text-muted">Jan 2010 - 2009 (1 years)</span>
                                        </div>
                                    </div>
                                </div> <!-- timeline item end  -->
                            </div>
                        </div>
                    </div>
                </div><!-- Row End -->
                <?php } ?>