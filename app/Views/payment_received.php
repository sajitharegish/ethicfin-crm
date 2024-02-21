<style>
    a {
        margin-left: 10px;
    }

    #editmodal,
    #editmodal1 {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0.5, 0.5);
        /* Semi-transparent background */
        z-index: 4;
        overflow-y: auto;
    }

    .fa-pencil-alt:before, .fa-pencil:before{
        font-size: 12px;
        margin-left: -8px;
    }


    #formContainer,
    #formContainer3 {
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
    #myForm,
    #myform2,
    #myForm3,
    #myForm5 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

    }

    .error {
        font-size: 20px;
        color: red;
        margin-top: 70px;
        font-weight: bold;
    }

    #myForm4 {
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

    .btn-group-sm>.btn i,
    .btn.btn-sm i {
        font-size: 20px;
        margin-bottom: 3px;
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


    /* #completed {
        display: none;
    } */
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
                                            <h6 class="text-white text-capitalize ps-3">Payment Received Leads </h6>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="item">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">

                                <form method="get" autocomplete="off" action="payment-received">

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

                                        <button class="btn bg-gradient-primary btn-sm ms-auto " title="filter"
                                                type="submit" style="width: 70px; height: 40px;"><i class="fa fa-search"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <?php if (!empty($error)) { ?>


                                    <p class="text-center error">
                                        <?= $error ?>
                                    </p>;
                                    <?php
                                } else { ?>
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center  mb-0">
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
                                                        Contact Details</th>

                                                    <!-- <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Contact Details</th> -->
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Date</th>

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Amount/Mode</th>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Payment Status</th>

                                                   <?php $role=session('user_type');
                                                    if($role== 0): ?>
                                                     <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Added By</th>   
                                                    <?php endif;?> 

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center; width: 160px;">
                                                        Operations
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $i = 1;
                                                $leadTotals = []; // Create an array to store lead_id totals
                                                foreach ($payment as $payments) {
                                                    $leadId = $payments->lead_id;
                                                    $amount = $payments->amount;
                                                    $date = strtotime($payments->payment_date); // Convert the date to a timestamp
                                            
                                                    // Store the payment date for the current lead_id, overwriting any previous values
                                                    $leadDates[$leadId] = $date;
                                                    // Check if the lead_id is already in the array, if not, initialize it to 0
                                                    if (!isset($leadTotals[$leadId])) {
                                                        $leadTotals[$leadId] = 0;
                                                    }

                                                    // Add the current amount to the total for this lead_id
                                                    $leadTotals[$leadId] += $amount;
                                                }

                                                $i = 1;
                                                foreach ($payment as $payments) {
                                                    $leadId = $payments->lead_id;

                                                    // Check if this lead_id was already processed
                                                    if (isset($leadTotals[$leadId])) {
                                                        ?>
                                                        <tr id="row42" style="font-size:20px;">
                                                            <td style="text-align:center; font-size:16px;">
                                                                <?= $i; ?>
                                                            </td>
                                                            <td style="text-align: left; font-size: 16px;">
                                                                <span style="font-size: 13px;" data-id="<?= $payments->lead_id?>" data-priority="<?= $payments->priority ?>" class="showFormButton2">
                                                                    <i style="color: <?php echo ($payments->priority == 2) ? 'red' : (($payments->priority == 1) ? '#E4A11B' : ''); ?>" 
                                                                        class="fa-solid fa-heart" data-id="<?= $payments->priority ?>" id="showFormButton2"></i>
                                                                </span>
                                                                <?php
                                                             $uri = service('uri');
                                                             $lastSegment = $uri->getSegment($uri->getTotalSegments());
                                                            // dd($lastSegment);die;
                                                                ?>
                                                                <span style="margin-left: 10px;"><?= $payments->customer_name ?> <a href="<?= base_url("edit-lead/{$lastSegment}/{$payments->lead_id}") ?>"><span class="pencil"><i class="fa fa-pencil"></i></span></a>
                                                            </span>
                                                            <br>
                                                                <?php if(!empty($payments->company_name)) : ?>
                                                                    <span style="margin-left: 28px; font-size: 12px;">(<?php echo $payments->company_name ?>)</span>
                                                                <?php endif?>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px;">
                                                                <?= $payments->email ?><br>
                                                                <?= $payments->mobile_number ?>
                                                            </td>
                                                            <!-- <td style="text-align:center; font-size:16px;">
                                                                <? //= $payments->email ?><br>
                                                                <? //= $payments->whatsapp_number ?>
                                                            </td> -->
                                                            <?php
                                                            $originalDate = $payments->payment_date;
                                                            $formattedDate = date('d-M-Y', strtotime($originalDate));
                                                            ?>
                                                            <td style="text-align:center; font-size:16px">
                                                                <?= $formattedDate ?><br>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px">
                                                                <?= $leadTotals[$leadId] ?> /
                                                                <?= $payments->payment_mode ?>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px">
                                                                <?= $payments->payment_status ?>
                                                            </td>
                                                            <?php 
                                                            $role=session('user_type');
                                                            if($role == 0): ?>
                                                            <td style="text-align:center; font-size:16px;">
                                                                <?= $payments->username ?>
                                                            </td>
                                                            <?php endif; ?>
                                                            <!-- <td style="text-align:center; font-size:16px" class="editable-cell"
                                                                data-lead-id="<? //= $leadId ?>"
                                                                data-original-value="<? //= $leadTotals[$leadId] ?>">
                                                                <? //= $leadTotals[$leadId] ?>
                                                            </td> -->

                                                            <td class="align-middle" style="margin: left 2px; text-align:center;">
                                                                <a href="view-more/<?= $payments->lead_id ?>" title="view">
                                                                    <span
                                                                        style="cursor: pointer;" ">
                                                                                                                                                                                                                                                                                                                                                                                                                            <i class="
                                                            fa fa-eye" title="view"
                                                                        style="font-size:20px;"></i>
                                                                    </span>
                                                                </a>
                                                               
                                                                <a href="#" title="Edit">
                                                                    <?php $id = $payments->lead_id;
                                                                    $name = $payments->customer_name;
                                                                    ?>
                                                                    <span class="" id="edbtn_42"
                                                                        style="cursor: pointer; font-size:10px"
                                                                        onclick="edit('<?= $id; ?>','<?= $name; ?>')">
                                                                        <i class="fa fa-edit"
                                                                            style="color: light blue;font-size:20px;"></i>
                                                                        <span class="title-text" style="display: none;">Edit</span>
                                                                    </span>
                                                                </a>

                                                                <a href="#" title="Delete">
                                                                    <span style="cursor: pointer;"
                                                                        onclick="confirmDelete('<?= $payments->lead_id ?>');">
                                                                        <i class="fa fa-trash" title="Delete"
                                                                            style=" font-size: 20px;"></i>
                                                                    </span>
                                                                </a>

                                                                <a href="#" title="Update">
                                                                    <span class="showFormButton" style="cursor: pointer;"
                                                                        data-id="<?= $payments->lead_id ?> ">
                                                                        <i class="fa fa-wrench" id="showFormButton"
                                                                            data-id="<?= $payments->lead_id ?>"
                                                                            style="font-size:20px;"></i>
                                                                        <span class="title-text"
                                                                            style="display: none;">Update</span>
                                                                    </span>
                                                                </a>

                                                                <a href="#" title="LiveUpdate">
                                                                    <span class="LiveshowFormButton" style="cursor: pointer;"
                                                                        data-id=" <?= $payments->lead_id ?> ">
                                                                        <i class="fa fa-info" id="LiveshowFormButton"
                                                                            data-id=" <?= $payments->lead_id ?>"
                                                                            style="font-size:20px;"></i>
                                                                        <span class="title-text" style="display: none;">Live
                                                                            Update</span>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                            <td class="align-middle" style="margin: left 2px; text-align:center;">

                                                            </td>

                                                        </tr>
                                                        <?php $i = $i + 1;
                                                        $leadTotals[$leadId] = null;

                                                    }
                                                }
                                     } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <div class="pagination  text-center">

                                    <div style='margin-top: 10px;'>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php include "footer.php" ?>
        <div id="editmodal1">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm3" action="editpayment">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Edit Payment</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <input id="plid" type="hidden" name="leadid">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Customer Name</label>
                                    <input type="text" class="form-control" id="pname" name="customer_name"
                                        style="border: 1px solid #333; padding-left:10px;" readonly>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-12">
                                <input type="text" class="form-control" id="amount" value="">
                            </div> -->

                            <!-- <div class="col-lg-4">
                                <div class="form-group">
                                <label class="form-control-label" for="input-username">Mode</label>
                                <select class="form-control" id="mode" name="mode" style="border: 1px solid #333;">
                                        
                                </select>
                                <div style="color: red !important"></div>
                                </div>
                            </div> -->
                            <!-- </div> -->
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                       <button onclick="cancelupdate3()" class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" type="button"
                             >Cancel</button>

                    </div>
                </div>
            </form>
        </div>
        <div id="formContainer2">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm5" action="viewall-leads">
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
                       <button onclick="cancelupdate2()" class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" type="button"
                             >Cancel</button>

                    </div>
                </div>
            </form>
        </div>

        <div id="formContainer3">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm4" action="update-priority">
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

        <div id="formContainer">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm" action="payment_received_update">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Update Project Delivery</h5>
                    </div>
                    <div class="card-body pt-0">


                        <div class="row">



                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Delivery Date</label>
                                    <input type="date" class="form-control" id="date" name="delivery_date"
                                        style="border: 1px solid #333;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Email sent-by</label>
                                    <select class="form-control" name="email_sent_by" id="country"
                                         style="border: 1px solid #333;">
                                         <option value="">--Select--</option>
                                         <?php foreach($users as $user): ?>
                                             <option value="<?= $user['username']?>"><?= $user['username']?></option>
                                           <?php endforeach; ?>  
                                    </select>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Select client to support</label>
                                    <select class="form-control" name="client_support" id="client_support"
                                         style="border: 1px solid #333;">
                                         <option value="">--Select--</option>
                                         <?php foreach($clients as $client): ?>
                                             <option value="<?= $client['id']?>"><?= $client['name']." - ". $client['mobile_number']?></option>
                                           <?php endforeach; ?>  
                                    </select>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Remarks</label>
                                    <textarea type="text" class="form-control" id="remarks" name="delivery_remark"
                                        style="border: 1px solid #333;"></textarea>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>

                            <!-- </div> -->
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                        <button onclick="cancelupdate()" class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" type="button"
                             >Cancel</button>

                    </div>
                </div>
            </form>
        </div>

        <div id="editmodal">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm2" action="addpayment">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Edit Responded Leads</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <input id="nrid" type="hidden" name="leadid">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Payment Date</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        style="border: 1px solid #333;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Payment Mode</label>
                                    <select class="form-control" name="mode" id="country" required
                                        onchange="getdesignation();" style="border: 1px solid #333;">
                                        <option value="">Select Mode</option>
                                        <option value="Cash"> Cash </option>
                                        <option value="Online Banking"> Online Banking </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Payment Status</label>
                                    <select class="form-control" name="payment_status" id="country" required
                                        onchange="getdesignation();" style="border: 1px solid #333;">
                                        <option value="">Select Status</option>
                                        <option value="Full Payment"> Full Payment </option>
                                        <option value="Partial Payment"> Partial Payment</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Amount</label>
                                    <input type="" class="form-control" id="remarks" name="ipamount"
                                        style="border: 1px solid #333;" placeholder="0.00"
                                        pattern="^\d+(\.\d{1,2})?$"></input>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Remarks</label>
                                    <textarea type="text" class="form-control" id="remarks" name="remarks"
                                        style="border: 1px solid #333;"></textarea>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                        <a href="payment-received"><button class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" type="button"
                             >Cancel</button></a>

                    </div>
                </div>
            </form>
        </div>
        <script>
            // function addmoney(id,) { //alert(id);alert(date); alert(name);alert(remark);
            //     //$('#editmodal').modal('show'); 
            //     editmodal.style.display = editmodal.style.display === 'block' ? 'none' : 'block';
            //     // var rid =$('#ba').val();

            //     $('#nrid').val(id);
            // }
            function cancel() { //alert(id);alert(date); alert(name);alert(remark);
                //$('#editmodal').modal('show'); 
                editmodal1.style.display = editmodal1.style.display === 'block' ? 'none' : 'block';
                // var rid =$('#ba').val();
            }
            function edit(id, name) { //alert(id);alert(date); alert(name);alert(remark);

                //$('#editmodal').modal('show'); 
                editmodal1.style.display = editmodal1.style.display === 'block' ? 'none' : 'block';
                $('#pname').val(name);
                // // var rid =$('#ba').val();
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>home/individual_payment",
                    data: { id: id },
                    success: function (response) {
                        // Handle the response from the PHP script here, if needed
                        //$("#pmode").val(response);
                        var parsedResponse = JSON.parse(response);
                        var methods = parsedResponse.payment_methods;
                        // Handle the parsed response from the PHP script here
                        var id = parsedResponse.id; // Access the 'id' property
                        var i_payment = parsedResponse.i_payment;
                        for (var i = 0; i < i_payment.length; i++) {
                            var paymentDate = i_payment[i].payment_date;
                            var mode = i_payment[i].payment_mode;
                            var amount = i_payment[i].amount;
                            var payment_status=i_payment[i].payment_status;
                            // console.log(payment_status);
                            // Create the input element for payment date
                            var dateElement = '<div class="col-lg-4 pt-0">' +
                                '<div class="form-group">' +
                                '<label class="form-control-label" for="input-username">Payment Date</label>' +
                                '<input type="date" class="form-control" id="date_' + i + '" name="date[]" value="' + paymentDate + '" style="border: 1px solid #333;">' +
                                '<div style="color: red !important"> </div>' +
                                '</div>' +
                                '</div>';


                            // Create the input elements for mode and amount
                            var modeElement = '<div class="col-lg-4">' +
                                '<div class="form-group">' +
                                '<label class="form-control-label" for="input-username">Mode</label>' +
                                '<select class="form-control" id="mode_' + i + '" name="mode[]" style="border: 1px solid #333;">' +
                                '<option value="">Select Mode</option>';

                            // Append options to the mode select element
                            methods.forEach(element => {
                                modeElement += '<option value="' + element.name + '" ' + (mode === element.name ? 'selected' : '') + '>' + element.name + '</option>';
                            });

                            modeElement += '</select>' +
                                '<div style="color: red !important"></div>' +
                                '</div>' +
                                '</div>';


                            var amountElement = '<div class="col-lg-4">' +
                                '<div class="form-group">' +
                                '<label class="form-control-label" for="input-username">Amount</label>' +
                                '<input type="text" class="form-control" id="amount_' + i + '" name="amount[]" value="' + amount + '" style="border: 1px solid #333;" placeholder="0.00" ' +
                                '<div style="color: red !important"> </div>' +
                                '</div>' +
                                '</div>';

                                var statusElement = '<div class="col-lg-12">' +
                                '<div class="form-group">' +
                                '<label class="form-control-label" for="input-username">Payment Status</label>' +
                                '<select class="form-control" name="payment_status[]" id="country_' + i + '" required onchange="getdesignation();" style="border: 1px solid #333;">' +
                                '<option value="">Select Status</option>' +
                                '<option value="Full Payment" ' + (payment_status === 'Full Payment' ? 'selected' : '') + '> Full Payment </option>' +
                                '<option value="Partial Payment" ' + (payment_status === 'Partial Payment' ? 'selected' : '') + '> Partial Payment</option>' +
                                '</select>' +
                                '</div>' +
                                '</div>';
                            var empty = '<div class="col-lg-12">' +
                                '<input type="text" class="form-control" id="amount_' + i + ' value="' + ' ' +
                                '</div>';

                            var newRow = '<div class="row">' + dateElement + modeElement + amountElement + statusElement + empty + '</div>';

                            // Append the new row to the card-body inside editmodal1
                            $('#editmodal1 .card-body').append(newRow);
                          
                        }
                    }
                });
                $('#plid').val(id);


            }
        </script>
        <script>
            const LiveshowFormButton = document.getElementById('LiveshowFormButton');
            const formContainer2 = document.getElementById('formContainer2');
            let LivelastAppendedInput = null;

            formContainer2.addEventListener('click', (event) => {
                if (event.target === formContainer2) {
                    formContainer2.style.display = 'none';
                }
            });

            // Get a reference to the elements with the class "showFormButton"
            const LiveshowFormButtons = document.querySelectorAll('.LiveshowFormButton');

            // Add click event listeners to each button
            LiveshowFormButtons.forEach((LiveshowFormButton) => {
                LiveshowFormButton.addEventListener('click', () => {
                    // Extract the data-id attribute value
                    const leadId = LiveshowFormButton.getAttribute('data-id');
                    const inputField = document.createElement('input');
                    inputField.type = 'hidden'; // You can change the input type as needed
                    inputField.name = 'leadId'; // Set the input field name
                    inputField.value = leadId; // Set the leadId as the input field's value

                    inputField.className = 'form-control'; // Add the 'form-control' class
                    inputField.style.border = '1px solid #333';
                    inputField.style.paddingLeft = '10px';

                    // Append the input field to the form
                    const form = document.getElementById('myForm5'); // Replace 'myForm' with your form's actual ID
                    if (LivelastAppendedInput) {
                        form.removeChild(LivelastAppendedInput);
                    }
                    LivelastAppendedInput = inputField;
                    form.appendChild(inputField);
                    formContainer2.style.display = formContainer2.style.display === 'block' ? 'none' : 'block';

                    // Alert the leadId value

                });
            });



        </script>
        <script>
            function confirmDelete(id) {
                var result = confirm("Want to delete this?");
                if (result) {
                    // If the user confirms, redirect to the CodeIgniter route
                    window.location.href = "<?php echo site_url('delete-payment-received/'); ?>" + id;
                }
            }
        </script>
        <script>
            // function delproduct(id, name) {
            //     //alert("Function called with id: " + id + " and name: " + name);

            //     if (confirm("Are you sure you want to delete " + name + "?")) {
            //         console.log("User confirmed, redirecting...");
            //         window.location.href = "<?= base_url('delete/') ?>" + id;
            //     } else {
            //         console.log("User canceled.");
            //         // Do nothing if the user cancels
            //     }
            // }
            // Get references to the button and form container
            const showFormButton = document.getElementById('showFormButton');
            const formContainer = document.getElementById('formContainer');
            let lastAppendedInput = null;
            // Add a click event listener to the button
            const showFormButtons = document.querySelectorAll('.showFormButton');
            showFormButtons.forEach((showFormButton) => {
                showFormButton.addEventListener('click', () => {
                    // Toggle the visibility of the form container
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
                });
            });
            // Close the form when clicking outside of it (optional)
            formContainer.addEventListener('click', (event) => {
                if (event.target === formContainer) {
                    formContainer.style.display = 'none';
                }
            });

        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var cancelButton = document.getElementById("cancel");
                var formContainer = document.getElementById("formContainer");

                cancelButton.addEventListener("click", function () {
                    formContainer.style.display = "none"; // Hide the formContainer
                });
            });
    
            const showFormButton2 = document.getElementById('showFormButton2');
            const formContainer3 = document.getElementById('formContainer3');
            console.log('work');
            let lastAppendedInput2 = null;

            formContainer3.addEventListener('click', (event) => {
                if (event.target === formContainer3) {
                    formContainer3.style.display = 'none';
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

                    const form = document.getElementById('myForm4'); 
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
                    formContainer3.style.display = formContainer3.style.display === 'block' ? 'none' : 'block';

                    // Alert the leadId value

                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var cancelButton = document.getElementById("cancel2");
                var formContainer = document.getElementById("formContainer3");

                cancelButton.addEventListener("click", function () {
                    formContainer.style.display = "none";
                });
            });

            function cancelupdate() {
                const formContainer = document.getElementById('formContainer');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }
            function cancelupdate2() {
                const formContainer = document.getElementById('formContainer2');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }
            function cancelupdate3() {
                const formContainer = document.getElementById('editmodal1');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }
        </script>