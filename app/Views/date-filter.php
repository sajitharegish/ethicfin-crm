<style>
    a {
        margin-left: 10px;
    }

    /* Initially hide the form */
    #formContainer,
    #formContainer3,
    #formContainer6,
    #formContainer2 {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        z-index: 3;
    }

    /* Center the form vertically and horizontally */

    /* Center the form vertically and horizontally */
    #myForm,
    #myForm1,
    #myForm6,
    #myForm2  {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        width: 400px;

    }

    .error {
        font-size: 20px;
        color: red;
        margin-top: 70px;
        font-weight: bold;
    }
    
    .btn-new{
        height: 30px;
        width: 50px;
        margin-top: 7px;
    }

    .custom-select {
            position: relative;
        }

        .custom-select select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        .custom-select::before {
            content: '\25BC'; 
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
        }

</style>
<?php include "header.php" ?>
<div class="container-fluid py-4">
    <div class="row">

        <div class="container-fluid py-4">

            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="containers">
                                    <div class="item">
                                        <div>
                                            <h6 class="text-white text-capitalize ps-3">All Lead </h6>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="item">
                                        <div><a class="btn btn-outline-white btn-sm mb-0 me-3" onclick="exportToExcel()">Export</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                            <form type="get" autocomplete="off">
                                <div class="row">

                                    <div class="col-1 col-sm-1"></div>
                                    <div class="col-1 col-sm-2 mt-1">
                                        <select id="multipleSelect" name="lead_status[]" multiple placeholder="Select lead status" data-search="true" data-silent-initial-value-set="true">
                                            <option value="0">New</option>
                                            <option value="1">Responded</option>
                                            <option value="2">Not Responded</option>
                                            <option value="3">Demo Assigned</option>
                                            <option value="4">Demo Completed</option>
                                            <option value="5">Demo Aborted</option>
                                            <option value="6">Payment Received</option>
                                            <option value="7">Delivered</option>
                                            <option value="9">Lost</option>
                                        </select>
                                    </div>
                                    <div class="col-3 col-sm-2">
                                        <div class="input-group input-group-dynamic">
                                            <input name="from" value="" class="multisteps-form__input form-control" type="date"/>
                                        </div>
                                    </div>
                                    <div class="col-3 col-sm-2">
                                        <div class="input-group input-group-dynamic">
                                            <input name="to" value="" class="multisteps-form__input form-control" type="date"/>
                                        </div>
                                        <span></span>
                                    </div>
                                    <div class="col-3 col-sm-2">
                                        <div class="input-group input-group-dynamic">
                                            <input name="search" value="" placeholder="Search" class="multisteps-form__input form-control" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-3 col-sm-1">
                                        <button class="btn bg-gradient-primary btn-sm ms-auto mb-0 btn-new" title="filter"><i class="fas fa-search" aria-hidden="true"></i></button>
                                    </div>
                                   
                                </form>
                              </div>
                              <!-- <button onclick="exportToExcel()">Export to Excel</button> -->

                                <!-- <button onclick="exportToExcel()">Export to Excel</button> -->

                            <?php if(isset($from_date) && isset($to_date)) : ?> 
                                <p style="margin-left: 10px; font-size: 15px; ">Showing <?= count($allleads) ?> results for the date range <span style="font-size: 14px; margin-left: 1px;"><?=date('d-M-Y', strtotime($from_date))?> <span style="" > to</span> <?=date('d-M-Y', strtotime($to_date))?> </span> </p>
                             <?php endif ?>      
                                <!-- <form method="get" autocomplete="off" action="viewall-leads">

                                    <div class="row">

                                        <div class="col-1 col-sm-1"> </div>
                                        <div class="col-3 col-sm-3">
                                        </div>
                                        <div class="col-3 col-sm-3">
                                        </div>

                                        <div class="col-3 col-sm-3">
                                            <div class="input-group input-group-dynamic">
                                                <input name="search" value="" placeholder="Search"
                                                    class="multisteps-form__input form-control" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-2 col-sm-2">

                                            <button class="btn bg-gradient-primary btn-sm ms-auto mb-0" title="filter"
                                                type="submit" style="width: 70px; height: 40px;"><i class="fa fa-search"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </form> -->
                                <?php if (!empty($error)) { ?>
                                    <p class="text-center error">
                                        <?= $error ?>
                                    </p>;
                                    <?php
                                } else { ?>
                                    <div class="table-responsive p-0">
                                    <table id="tablenew" class="table align-items-center  mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        SL</th>
                                                    <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                       Customer Name</th>

                                                     <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Lead Date</th>   

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                       Contact Details</th>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:left;">
                                                       Status</th>
                                                       <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:left;">
                                                       Remarks</th>

                                                    <?php 
                                                    
                                                    $role=session('user_type');
                                                    if($role== 0): ?>
                                                     <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Added By</th>   
                                                    <?php endif;?>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Operations</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                 if (isset($page)) {
                                                        $id = $page;
                                                    } else {
                                                        $id = 1;
                                                        $page = 1;
                                                    }
                                                    $currentPage = isset($page) ? $page : 1;
                                                    $itemsPerPage=100;
                                                    $serialNumber = ($currentPage - 1) * $itemsPerPage;
                                                foreach ($allleads as $alllead) {$serialNumber++;?>
                                                       
                                                    <tr id="row42" style="font-size:20px;">
                                                        <td style="text-align:center; font-size:16px;">

                                                            <?= $serialNumber?>

                                                        </td>
                                                        <td style="text-align: left; font-size: 16px;">
                                                            <span style="font-size: 13px;" data-id="<?= $alllead['id'] ?>" data-priority="<?= $alllead['priority']?>" class="showFormButton2">
                                                                <i style="color: <?php echo ($alllead['priority'] == 2) ? 'red' : (($alllead['priority'] == 1) ? '#E4A11B' : ''); ?>" 
                                                                    class="fa-solid fa-heart" data-id="<?= $alllead['id'] ?>" id="showFormButton2"></i>
                                                            </span>
                                                            <span style="margin-left: 10px;"><?= $alllead['customer_name'] ?></span><br>
                                                            <?php if(!empty($alllead['company_name'])) : ?>
                                                            <span style="margin-left: 27px;">(<?= $alllead['company_name'] ?>)</span>
                                                            <?php endif?>
                                                        </td>

                                                        <td style="text-align:center; font-size:16px;">
                                                            <?php
                                                            $formattedDate = date('d-M-Y', strtotime($alllead['date']));
                                                            echo $formattedDate;
                                                         ?>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                            <span> <?= $alllead['mobile_number'] ?></span><br>
                                                            <span> <?= $alllead['email'] ?></span>
                                                        </td>
                                                        <td style="text-align:left; font-size:16px;">
                                                            <?php
                                                            switch ($alllead['status']){
                                                                case 0:
                                                                    echo 'Lead Received on <span style="color: #1C8BEE ;">' . date('d-M-Y', strtotime($alllead['date'])) . '</span>';
                                                                    $remarks=$alllead['remarks'];
                                                                    break;
                                                                case 1:
                                                                    echo 'Responded on <span style="color: #1C8BEE ;">' . date('d-M-Y', strtotime($alllead['contact_date'])) . ' </span>';
                                                                    $remarks=$alllead['contact_remarks'];
                                                                    break;
                                                                case 2:
                                                                    echo 'Not Responded on <span style="color: #1C8BEE ;">' . date('d-M-Y', strtotime($alllead['contact_date'])) . '</span>';
                                                                    $remarks=$alllead['contact_remarks'];
                                                                    break;
                                                                case 3:
                                                                    $postponed=$alllead['postponed_date'];
                                                                    if(!empty($postponed))
                                                                    {
                                                                        echo 'Demo Assigned on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($postponed)) . '</span>';
                                                                        $remarks=$alllead['demoassigned_remark'];
                                                                    }
                                                                    else
                                                                    {
                                                                        echo 'Demo Assigned on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($alllead['demodate'])) . '</span>';
                                                                        $remarks=$alllead['demoassigned_remark'];
                                                                    }
                                                                    break;
                                                                case 4:
                                                                    echo 'Demo Completed on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($alllead['democompleteddate'])) . '</span>';
                                                                    $remarks=$alllead['democompleted_remark'];
                                                                    break;
                                                                case 5:
                                                                    echo 'Demo Aborted on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($alllead['abort_date'])) . ' </span>';
                                                                    break;
                                                                case 6:
                                                                    echo 'Payment Received on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($alllead['paymentdate'])) . ' </span>';
                                                                    $remarks=$alllead['payment_remarks'];
                                                                    break;
                                                                case 7:
                                                                    echo 'Delivered on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($alllead['project_delivery_date'])) . ' </span>';
                                                                    $remarks=$alllead['delivery_remark'];
                                                                    break;
                                                                case 9:
                                                                    echo 'Lost Lead on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($alllead['lost_date'])) . ' </span>';
                                                                    break;
                                                                default:
                                                                    echo 'Unknown Status';
                                                                    break;
                                                            }
                                                            ?>
                                                        </td>

                                                        <td style="text-align:center; font-size:16px">
                                                        <?php echo (!empty($remarks)) ? $remarks : ''; ?>
                                                        </td>

                                                        <?php 
                                                    
                                                    $role=session('user_type');
                                                    if($role == 0): ?>
                                                        <td style="text-align:center; font-size:16px">
                                                            <?= $alllead['username'] ?>
                                                        </td>
                                                        <?php endif;?>

                                                        <td class="align-middle" style="margin: left 2px; text-align:center;">
                                                            <a href="view-more/<?= $alllead['id'] ?>" title="view">
                                                                <span
                                                                    style="cursor: pointer;" ">
                                                                                                                                                                                                                                            <i class="
                                                            fa fa-eye" title="view"
                                                                    style="font-size:20px;"></i>
                                                                </span>
                                                            </a>
                                                            <?php
                                                             $uri = service('uri');
                                                             $lastSegment = $uri->getSegment($uri->getTotalSegments());
                                                            // dd($lastSegment);die;
                                                            
                                                            ?>
                                                            <a href="<?= base_url("edit-lead/{$lastSegment}/{$alllead['id']}")?>" title="Edit">
                                                                <span class="" id="edbtn_42"
                                                                    style="cursor: pointer; font-size:10px">
                                                                    <i class="fa fa-edit"
                                                                        style="font-size:20px;"></i>
                                                                    <span class="title-text" style="display: none;">Edit</span>
                                                                </span>
                                                            </a>

                                                            <a href="#" title="Delete">
                                                                <span style="cursor: pointer;"
                                                                    onclick="confirmDelete('<?= $alllead['id'] ?>');">
                                                                    <i class="fa fa-trash" title="Delete"
                                                                        style="font-size: 20px;"></i>
                                                                </span>
                                                            </a>



                                                            <a href="#" title="Update">
                                                                <span class="showFormButton" style="cursor: pointer;"
                                                                    data-id=" <?= $alllead['id'] ?> ">
                                                                    <i class="fa fa-info" id="showFormButton"
                                                                        data-id=" <?= $alllead['id'] ?> "
                                                                        style="font-size:20px;"></i>
                                                                    <span class="title-text"
                                                                        style="display: none;">Update</span>
                                                                </span>
                                                            </a>
                                                            <a href="#" title="Update">
                                                                <span class="showFormButtonabort" style="cursor: pointer;"
                                                                    data-id=" <?= $alllead['id'] ?> ">
                                                                    <i class="fa fa-ban" id="showFormButtonabort"
                                                                        data-id=" <?= $alllead['id'] ?> "
                                                                        style="font-size:20px;"></i>
                                                                    <span class="title-text"
                                                                        style="display: none;">Update</span>
                                                                </span>
                                                            </a>

                                                            <a href="#" title="Update">
                                                                <span class="showFormButton6" style="cursor: pointer;"
                                                                    data-id=" <?= $alllead['id'] ?> ">
                                                                    <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                                                    <span class="title-text"
                                                                        style="display: none;">transfer</span>
                                                                </span>
                                                            </a>


                                                        </td>
                                                        <!-- <td class="align-middle" style="margin: left 2px; text-align:center;">

                                                    
                                                </td> -->

                                                    </tr>

                                                    <?php 
                                                }
                                } ?>

                                        </tbody>
                                    </table>
                                </div>
                           
                            </div>
                           
                        </div>
                    </div>
                </div>

            </div>
            <?php if(empty($search)):?> 
            <div class="print-pri">
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                    <nav class="w-full sm:w-auto sm:mr-auto">
                        <ul class="pagination">
                            <?php if (isset($page) && $page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page-nr=<?= $page - 1 ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                    </a>
                                </li>
                                <?php if ($page > 4) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page-nr=1">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">...</a>
                                </li>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php for ($counter = $page - 3; $counter <= $page + 3; $counter++): ?>
                                <?php if ($counter >= 1 && $counter <= $totalPages) : ?>
                                    <li class="page-item <?= ($counter == $page) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page-nr=<?= $counter ?>"><?= $counter ?></a>
                                    </li>
                                    
                                <?php endif; ?>
                            <?php endfor; ?>
                            <?php if ($page < $totalPages - 3) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="#">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?page-nr=<?= $totalPages ?>"><?= $totalPages ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (!isset($page)): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page-nr=2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php elseif (isset($page) && $page < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page-nr=<?= $page + 1 ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    <select class="w-20 form-select box mt-3 sm:mt-0" onchange="window.location.href = '?page-nr=' + this.value;">
                        <?php for ($counter = 1; $counter <= $totalPages; $counter++): ?>
                            <option value="<?= $counter ?>" <?= ($counter == $page) ? 'selected' : '' ?>><?= $counter ?></option>
                        <?php endfor; ?>
                    </select>

                </div>
            </div>
            <?php endif ?>
        </div>
        <?php include "footer.php" ?>

        <div id="formContainer">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm" action="viewall-leads">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Update Lead</h5>
                    </div>
                    <div class="card-body pt-0">


                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Remarks</label>
                                    <textarea type="text" class="form-control" id="remarks" name="remark"
                                        style="border: 1px solid #333;"></textarea>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                        <button class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" id="cancel"
                            type="button">Cancel</button>

                    </div>
                </div>
            </form>
        </div>

        <div id="formContainer3">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm1" action="new_lead_abort">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Mark As Lost Lead</h5>
                    </div>
                    <div class="card-body pt-0">


                        <div class="row">

                            <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Lost Reason</label>
                                            <textarea type="text" class="form-control" id="remarks"
                                                name="losted_reason" style="border: 1px solid #333;"></textarea>
                                            <div style="color: red !important"> </div>
                                        </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Lost Date</label>
                                    <input type="date" class="form-control" id="lostdate" name="lostdate"
                                        style="border: 1px solid #333;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>



                            
                        </div>
                    </div>

                     <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                        <button onclick="cancelupdate3()" class="btn bg-danger text-white btn-sm float-end mt-6 mb-0"
                        type="button">Cancel</button>
                    </div>
                </div>
            </form>
        </div>

        <div id="formContainer6">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm6" action="<?=base_url('lead-transfer')?>">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Transfer Lead</h5>
                    </div>
                    <div class="card-body pt-0">


                        <div class="row">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">Select User</label>
                                <div class="custom-select">
                                    <select class="select2" id="" name="user_id">
                                        <option value="">--Select--</option>
                                        <?php foreach($users as $res): ?>
                                            <option value="<?=$res['id'] ?>"><?= $res['username'] ?></option>
                                         <?php endforeach ?>   
                                    </select>
                                </div>
                                <div style="color: red !important"> </div>
                            </div>
                        </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                        <button class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" onclick="canceledit()" id="cancel"
                            type="button">Cancel</button>

                    </div>
                </div>
            </form>
        </div>

        <div id="formContainer2">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm2" action="update-priority">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5> Update Priority</h5>
                    </div>
                    <div class="card-body pt-0">


                        <div class="row">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">Priority</label>
                                <div class="custom-select">
                                    <select class="select2" id="prioritySelect" name="priority">
                                        <option value="0">Low</option>
                                        <option value="1">Medium</option>
                                        <option value="2">High</option>
                                    </select>
                                </div>
                                <div style="color: red !important"> </div>
                            </div>
                        </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                        <button class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" id="cancel2"
                            type="button">Cancel</button>

                    </div>
                </div>
            </form>
        </div>
       
        
        <script>
            function confirmDelete(id) {
                var result = confirm("Want to delete this?");
                if (result) {
                    // If the user confirms, redirect to the CodeIgniter route
                    window.location.href = "<?php echo site_url('delete_all_lead/'); ?>" + id;
                }
            }
        </script>
        <script>
            function cancelupdate3() {
                const formContainer = document.getElementById('formContainer3');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }
        </script>
        <script>
            const showFormButton = document.getElementById('showFormButton');
            const formContainer = document.getElementById('formContainer');
            let lastAppendedInput = null;

            formContainer.addEventListener('click', (event) => {
                if (event.target === formContainer) {
                    formContainer.style.display = 'none';
                }
            });

            // Get a reference to the elements with the class "showFormButton"
            const showFormButtons = document.querySelectorAll('.showFormButton');

            // Add click event listeners to each button
            showFormButtons.forEach((showFormButton) => {
                showFormButton.addEventListener('click', () => {
                    // Extract the data-id attribute value
                    const leadId = showFormButton.getAttribute('data-id');

                    const inputField = document.createElement('input');
                    inputField.type = 'hidden'; // You can change the input type as needed
                    inputField.name = 'leadId'; // Set the input field name
                    inputField.value = leadId; // Set the leadId as the input field's value

                    inputField.className = 'form-control'; // Add the 'form-control' class
                    inputField.style.border = '1px solid #333';
                    inputField.style.paddingLeft = '10px';

                    // Append the input field to the form
                    const form = document.getElementById('myForm'); // Replace 'myForm' with your form's actual ID
                    if (lastAppendedInput) {
                        form.removeChild(lastAppendedInput);
                    }
                    lastAppendedInput = inputField;
                    form.appendChild(inputField);
                    formContainer.style.display = formContainer.style.display === 'block' ? 'none' : 'block';

                    // Alert the leadId value

                });
            });
        </script>

        <script>
            const showFormButton6 = document.getElementById('showFormButton6');
            const formContainer6 = document.getElementById('formContainer6');
            let lastAppendedInput1 = null;

            formContainer6.addEventListener('click', (event) => {
                if (event.target === formContainer6) {
                    formContainer6.style.display = 'none';
                }
            });

            // Get a reference to the elements with the class "showFormButton"
            const showFormButtons6 = document.querySelectorAll('.showFormButton6');

            // Add click event listeners to each button
            showFormButtons6.forEach((showFormButton6) => {
                showFormButton6.addEventListener('click', () => {
                    // Extract the data-id attribute value
                    const leadId = showFormButton6.getAttribute('data-id');

                    const inputField = document.createElement('input');
                    inputField.type = 'hidden'; // You can change the input type as needed
                    inputField.name = 'leadId'; // Set the input field name
                    inputField.value = leadId; // Set the leadId as the input field's value

                    inputField.className = 'form-control'; // Add the 'form-control' class
                    inputField.style.border = '1px solid #333';
                    inputField.style.paddingLeft = '10px';

                    // Append the input field to the form
                    const form = document.getElementById('myForm6'); // Replace 'myForm' with your form's actual ID
                    if (lastAppendedInput) {
                        form.removeChild(lastAppendedInput);
                    }
                    lastAppendedInput = inputField;
                    form.appendChild(inputField);
                    formContainer6.style.display = formContainer6.style.display === 'block' ? 'none' : 'block';

                    // Alert the leadId value

                });
            });

            function canceledit() {
                const formContainer = document.getElementById('formContainer6');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }
        </script>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var cancelButton = document.getElementById("cancel");
                var formContainer = document.getElementById("formContainer");

                cancelButton.addEventListener("click", function () {
                    formContainer.style.display = "none"; // Hide the formContainer
                });
            });

           
    
            const showFormButton2 = document.getElementById('showFormButton2');
            const formContainer2 = document.getElementById('formContainer2');
            let lastAppendedInput2 = null;

            formContainer2.addEventListener('click', (event) => {
                if (event.target === formContainer2) {
                    formContainer2.style.display = 'none';
                }
            });

            const showFormButtons2 = document.querySelectorAll('.showFormButton2');

            showFormButtons2.forEach((showFormButton2) => {
                showFormButton2.addEventListener('click', () => {
                    const leadId = showFormButton2.getAttribute('data-id');
                    const priority=showFormButton2.getAttribute('data-priority');
                    console.log(leadId)
                    const inputField = document.createElement('input');
                    inputField.type = 'hidden'; 
                    inputField.name = 'leadId'; 
                    inputField.value = leadId; 

                    inputField.className = 'form-control'; 
                    inputField.style.border = '1px solid #333';
                    inputField.style.paddingLeft = '10px';

                    const form = document.getElementById('myForm2'); 
                    if (lastAppendedInput2) {
                        form.removeChild(lastAppendedInput2);
                    }
                    const prioritySelect = document.getElementById('prioritySelect'); 
                    if (prioritySelect) {
                        Array.from(prioritySelect.options).forEach(option => {
                            option.selected = option.value === priority;
                        });
                    }
                    lastAppendedInput2 = inputField;
                    form.appendChild(inputField);
                    formContainer2.style.display = formContainer2.style.display === 'block' ? 'none' : 'block';

                    // Alert the leadId value

                });
            });

            
        </script>
   <script>
    function exportToExcel() {
        // Clone the table to avoid modifying the original table on the page
        var tableClone = document.querySelector('.table').cloneNode(true);

        // Get all rows in the cloned table
        var rows = tableClone.querySelectorAll('tbody tr');

        // Add serial numbers to each row
        for (var i = 0; i < rows.length; i++) {
            var serialNumberCell = document.createElement('td');
            serialNumberCell.textContent = i + 1;
            serialNumberCell.style.textAlign = 'center';
            serialNumberCell.style.fontSize = '16px';
            rows[i].insertBefore(serialNumberCell, rows[i].firstChild);
        }

        // Create a Blob from the cloned table
        var blob = new Blob([tableClone.outerHTML], {
            type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        });

        // Create a download link
        var a = document.createElement('a');
        a.href = window.URL.createObjectURL(blob);
        a.download = 'exported_table.xls';

        // Trigger the click event on the link to initiate the download
        a.click();
    }
</script>


        <script src="assets/js/virtual-select.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var cancelButton = document.getElementById("cancel2");
                var formContainer = document.getElementById("formContainer2");

                cancelButton.addEventListener("click", function () {
                    formContainer.style.display = "none";
                });
            });


            VirtualSelect.init({ 
            ele: '#multipleSelect' 
            });
        </script>


<script>
            const showFormButtonabort = document.getElementById('showFormButtonabort');
            const formContainer3 = document.getElementById('formContainer3');
            let lastAppendedInput3 = null;

            formContainer3.addEventListener('click', (event) => {
                if (event.target === formContainer3) {
                    formContainer3.style.display = 'none';
                }
            });

            // Get a reference to the elements with the class "showFormButton"
            const showFormButtons1 = document.querySelectorAll('.showFormButtonabort');

            // Add click event listeners to each button
            showFormButtons1.forEach((showFormButtonabort) => {
                showFormButtonabort.addEventListener('click', () => {
                    // Extract the data-id attribute value
                    const leadId = showFormButtonabort.getAttribute('data-id');

                    const inputField = document.createElement('input');
                    inputField.type = 'hidden'; // You can change the input type as needed
                    inputField.name = 'leadId'; // Set the input field name
                    inputField.value = leadId; // Set the leadId as the input field's value

                    inputField.className = 'form-control'; // Add the 'form-control' class
                    inputField.style.border = '1px solid #333';
                    inputField.style.paddingLeft = '10px';

                    // Append the input field to the form
                    const form = document.getElementById('myForm1'); // Replace 'myForm' with your form's actual ID
                    if (lastAppendedInput3) {
                        form.removeChild(lastAppendedInput3);
                    }
                    lastAppendedInput3 = inputField;
                    form.appendChild(inputField);
                    formContainer3.style.display = formContainer3.style.display === 'block' ? 'none' : 'block';

                    // Alert the leadId value

                });
            });

 </script>
 <!-- <script>
    function exportToExcel() {
        /* Get table element */
        var table = document.getElementById("tablenew");

        /* Convert table to workbook */
        var wb = XLSX.utils.table_to_book(table);

        /* Save workbook to file */
        XLSX.writeFile(wb, "table_data.xlsx");
    }
</script> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

<script>
    function exportToExcel() {
        /* Get table element */
        var table = document.getElementById("tablenew");

        /* Remove the header of the "Operations" column */
        var headerIndex = -1;
        var headers = table.querySelectorAll('thead th');
        headers.forEach(function(header, index) {
            if (header.textContent.trim() === 'Operations') {
                headerIndex = index;
            }
        });
        if (headerIndex !== -1) {
            headers[headerIndex].remove();
        }

        /* Remove the "Operations" column from all rows */
        var rows = table.querySelectorAll('tbody tr');
        rows.forEach(function(row) {
            var cells = row.querySelectorAll('td');
            if (cells.length > headerIndex && headerIndex !== -1) {
                cells[headerIndex].remove();
            }

            /* Add a line break before printing the Gmail ID */
            var emailCell = row.querySelector('td:nth-child(4)');
            if (emailCell) {
                var emailText = emailCell.textContent.trim();
                if (emailText.includes('@gmail.com')) {
                    // Replace '@gmail.com' with '\n@gmail.com'
                    emailText = emailText.replace('@gmail.com', '\n@gmail.com');
                    emailCell.textContent = emailText;
                }
            }
        });

        /* Convert table to workbook */
        var wb = XLSX.utils.table_to_book(table);

        /* Get the first sheet of the workbook */
        var ws = wb.Sheets[wb.SheetNames[0]];
       

        /* Define date format */
        var dateFormat = 'dd-mmm-yyyy';

        /* Loop through all cells in the sheet */
        for (var cell in ws) {
            /* Check if the cell contains a date value */
            if (ws[cell].t === 'd') {
                /* Format date as Excel date */
                ws[cell].z = dateFormat;
            }
        }

        /* Save workbook to file */
        XLSX.writeFile(wb, "table_data.xlsx");
    }
</script>












        



