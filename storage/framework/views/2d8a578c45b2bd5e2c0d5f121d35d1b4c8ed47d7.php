<?php $__env->startSection('title'); ?>
    <?php if(isset($invoice)): ?>
        <?php echo app('translator')->get("Edit Invoice"); ?>

    <?php else: ?>
        <?php echo app('translator')->get("Create Invoice"); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <!-- Currency Create Form  -->
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <?php if(isset($invoice)): ?>
                            <form method="post" action="<?php echo e(route('admin.updateInvoice',$invoice->id)); ?>" enctype="multipart/form-data">

                                <?php else: ?>
                                        <form method="post" action="<?php echo e(route('admin.storeInvoice')); ?>" enctype="multipart/form-data">

                                        <?php endif; ?>
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="row">

                                        <div class="form-group col-md-12 col-12" >
                                            <label>Customer</label>
                                            <select class="form-control  selectpicker currency-change"
                                                    data-live-search="true" id="customer_id" name="customer_id"
                                                    required="">
                                                <option disabled selected>Nothing Selected</option>
                                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e(@$invoice->customer_id == $customer->id ? 'selected' : ''); ?> value="<?php echo e($customer->id); ?>"><?php echo e($customer->fullname); ?></option>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select customer
                                            </div>
                                            <?php if($errors->has('customer')): ?>
                                                <span class="invalid-text">
                                                <?php echo e($errors->first('customer')); ?>

                                            </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group col-md-6 col-6">
                                            <label>Date</label>
                                            <input type="date" class="form-control "
                                                   name="issue_date"
                                                   value="<?php echo e(isset($invoice) ? $invoice->date : old('issue_date')); ?>"  required="">
                                            <div class="invalid-feedback">
                                                Please fill in the date
                                            </div>
                                            <?php if($errors->has('issue_date')): ?>
                                                <span class="invalid-text">
                                                <?php echo e($errors->first('issue_date')); ?>

                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-md-6 col-6">
                                            <label>Open Till</label>
                                            <input type="date" class="form-control "
                                                   name="open_till_date"
                                                   value="<?php echo e(isset($invoice) ? $invoice->due_date : old('open_till_date')); ?>"  required="">
                                            <div class="invalid-feedback">
                                                Please fill in the open till date
                                            </div>
                                            <?php if($errors->has('open_till_date')): ?>
                                                <span class="invalid-text">
                                                <?php echo e($errors->first('open_till_date')); ?>

                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Invoice Number</label>
                                            <input type="number" class="form-control "
                                                   name="invoice_no"
                                                   value="<?php echo e(isset($invoice) ? $invoice->invoice_no :  old('invoice_no')); ?>"  required="">
                                            <div class="invalid-feedback">
                                                Please fill in the est no
                                            </div>
                                            <?php if($errors->has('invoice_no')): ?>
                                                <span class="invalid-text">
                                                <?php echo e($errors->first('invoice_no')); ?>

                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Tags</label>
                                            <select class="form-control  tags-selectpicker currency-change"
                                                    data-live-search="true" multiple name="tags[]"
                                                    required="">
                                                <option readonly="">Nothing Selected</option>
                                                <option value="bug" <?php echo e(isset($invoice) ? (in_array('bug',$invoice->tags) ? 'selected' : '') : ''); ?>>Bug</option>
                                                <option value="follow-up" <?php echo e(isset($invoice) ? (in_array('follow-up',$invoice->tags) ? 'selected' : '') : ''); ?>>follow-up</option>
                                                <option value="important" <?php echo e(isset($invoice) ? (in_array('important',$invoice->tags) ? 'selected' : '') : ''); ?>>important</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please fill in the assigned user
                                            </div>
                                            <?php if($errors->has('tags')): ?>
                                                <span class="invalid-text">
                                                <?php echo e($errors->first('tags')); ?>

                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">

                                        <div class="row">
                                            <div class="form-group col-md-6 col-6">
                                                <label>Status</label>
                                                <select class="form-control  selectpicker currency-change"
                                                        data-live-search="true" name="status"
                                                        required="">
                                                    <option disabled selected>Nothing Selected</option>
                                                    <option <?php echo e(@$invoice->status == '1' ? 'selected' : ''); ?> value="1">Draft</option>
                                                    <option <?php echo e(@$invoice->status == '2' ? 'selected' : ''); ?> value="2">Sent</option>
                                                    <option <?php echo e(@$invoice->status == '3' ? 'selected' : ''); ?> value="3">Open</option>
                                                    <option <?php echo e(@$invoice->status == '4' ? 'selected' : ''); ?> value="4">Done</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please fill in the status
                                                </div>
                                                <?php if($errors->has('status')): ?>
                                                    <span class="invalid-text">
                                                <?php echo e($errors->first('status')); ?>

                                            </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group col-md-6 col-6">
                                                <label>Currency</label>
                                                <select class="form-control  selectpicker currency-change"
                                                        data-live-search="true" name="currency_id"
                                                        required="">
                                                    <option disabled selected>Nothing Selected</option>
                                                    <option <?php echo e(@$invoice->currency_id == '1' ? 'selected' : ''); ?> value="1">AUD</option>
                                                    <option <?php echo e(@$invoice->currency_id == '2' ? 'selected' : ''); ?> value="2">EUR</option>
                                                    <option <?php echo e(@$invoice->currency_id == '3' ? 'selected' : ''); ?> value="3">GBP</option>
                                                    <option <?php echo e(@$invoice->currency_id == '4' ? 'selected' : ''); ?> value="4">USD</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please fill in the currency
                                                </div>
                                                <?php if($errors->has('currency')): ?>
                                                    <span class="invalid-text">
                                                <?php echo e($errors->first('currency')); ?>

                                            </span>
                                                <?php endif; ?>
                                            </div>

















                                            <div class="form-group col-md-6 col-6">
                                                <label>Sales Agent</label>
                                                <select class="form-control  selectpicker currency-change"
                                                        data-live-search="true" name="sales_agent"
                                                        required="">
                                                    <option disabled selected>Nothing Selected</option>
                                                    <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php echo e(@$invoice->agent_id == $admin->id ? 'selected' : ''); ?> value="<?php echo e($admin->id); ?>"><?php echo e($admin->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please fill in the sales agent
                                                </div>
                                                <?php if($errors->has('sales_agent')): ?>
                                                    <span class="invalid-text">
                                                <?php echo e($errors->first('sales_agent')); ?>

                                            </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group col-md-6 col-6">
                                                <label>Discount Type</label>
                                                <select class="form-control  selectpicker currency-change"
                                                        data-live-search="true" name="discount_type"
                                                        required="">
                                                    <option disabled selected>Nothing Selected</option>
                                                    <option <?php echo e(@$invoice->discount_type =='Before Tax' ? 'selected' : ''); ?> value="Before Tax">Before Tax</option>
                                                    <option <?php echo e(@$invoice->discount_type == 'After Tax' ? 'selected' : ''); ?> value="After Tax">After Tax</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please fill in the discount type
                                                </div>
                                                <?php if($errors->has('discount_type')): ?>
                                                    <span class="invalid-text">
                                                <?php echo e($errors->first('discount_type')); ?>

                                            </span>
                                                <?php endif; ?>
                                            </div>


                                            <div class="form-group col-md-12 col-12">
                                                <label>Admin Note</label>
                                                <textarea type="text" class="form-control "
                                                          name="admin_note"
                                                          id="admin_note"
                                                          required=""><?php echo e(isset($invoice) ? $invoice->admin_note : old('admin_note')); ?></textarea>
                                                <div class="invalid-feedback">
                                                    Please fill in the admin note
                                                </div>
                                                <?php if($errors->has('admin_note')): ?>
                                                    <span class="invalid-text">
                                            <?php echo e($errors->first('admin_note')); ?>

                                        </span>
                                                <?php endif; ?>
                                            </div>


                                        </div>





                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive s_table">
                                        <input type="hidden" name="invoiceItems" id="invoiceItems" value="<?php echo e(json_encode(@    $invoice->items)); ?>">
                                        <div class="col-md-4 mb-4">
                                            <select class="form-control  selectpicker currency-change" id="itemsList">
                                                <option>Select Item to Add</option>
                                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <table class="table estimate-items-table items table-main-estimate-edit has-calculations no-mtop">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th width="20%" align="left"><i class="fa-solid fa-circle-exclamation tw-mr-1" aria-hidden="true" data-toggle="tooltip" data-title="New lines are not supported for item description. Use the item long description instead."></i>
                                                    Item</th>
                                                <th width="25%" align="left">Description</th>
                                                <th width="15%" align="right">Rate</th>
                                                <th width="15%" align="right">Quantity</th>
                                                <th width="20%" align="right">Tax</th>
                                                <th width="10%" align="right">Amount</th>
                                                <th align="center"><i class="fa fa-cog"></i></th>
                                            </tr>
                                            </thead>
                                            <tbody class="ui-sortable" id="itemTableBody">
                                            <tr class="main" id="addItemForm">
                                                <td></td>
                                                <td>
                                                    <textarea id="description" rows="4" class="form-control" placeholder="Description"></textarea>
                                                </td>
                                                <td>
                                                    <textarea id="long_description" rows="4" class="form-control" placeholder="Long description"></textarea>
                                                </td>

                                                <td>
                                                    <input type="number" id="rate" class="form-control" placeholder="Rate">
                                                </td>
                                                <td>
                                                    <input type="number" id="quantity" class="form-control" placeholder="Quantity">
                                                </td>
                                                <td>
                                                    <select class="form-select" id="tax">
                                                        <option value="0" >No Tax</option>
                                                        <option value="1" >5.00%</option>
                                                        <option value="2" >10.00%</option>
                                                        <option value="3" >18.00%</option>
                                                    </select>
                                                <td id="amount">

                                                </td>
                                                <td>
                                                    <button type="button" id="addItemToTable" class="btn pull-right btn-primary"><i class="fa fa-check"></i></button>
                                                </td>
                                            </tr>
                                            <?php if(isset($invoice)): ?>
                                                <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo e($item['item_name']); ?></td>
                                                        <td><?php echo e($item['item_description']); ?></td>
                                                        <td><?php echo e($item['amount']); ?></td>
                                                        <td><?php echo e($item['qty']); ?></td>
                                                        <td><?php echo e($item['tax_type']); ?></td>
                                                        <td><?php echo e($item['amount'] * $item['qty']); ?></td>
                                                        <td><a href="#" class="btn btn-primary" id="item-<?php echo e($loop->index); ?>" onclick="delete_item(<?php echo e($loop->index); ?>);return false;">Delete</a></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>

                                    </div>

                                </div>
                                <div class="col-md-8 offset-4">
                                    <table class="table text-right">
                                        <tbody>
                                        <tr>
                                            <td><span class="bold tw-text-neutral-700">Sub Total :</span>
                                            </td>
                                            <td class="subtotal" ><input type="text" value="<?php echo e(@$invoice->subtotal); ?>" name="subtotal" readonly id="subtotal"></td>
                                        </tr>
                                        <tr id="discount_area">
                                            <td>
                                                <span class="bold tw-text-neutral-700">Discount:</span>
                                            </td>
                                            <td class="discount-total">

                                                <input type="number" value="<?php echo e(@$invoice->discount); ?>" class="" min="0"  id="discount_percent" name="discount_percent">


                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="bold tw-text-neutral-700">Total :</span>
                                            </td>
                                            <td class="total" ><input readonly value="<?php echo e(@$invoice->subtotal - @$invoice->discount); ?>" type="text" id="total"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="form-group col-md-12 col-12">
                                    <label>Client Note</label>
                                    <textarea type="text" class="form-control "
                                              name="client_note"
                                              id="client_note"
                                              required=""><?php echo e(isset($invoice) ? $invoice->client_note : old('client_note')); ?></textarea>
                                    <div class="invalid-feedback">
                                        Please fill in the client note
                                    </div>
                                    <?php if($errors->has('client_note')): ?>
                                        <span class="invalid-text">
                                            <?php echo e($errors->first('client_note')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>Terms and Conditions</label>
                                    <textarea type="text" class="form-control "
                                              name="terms_conditions"
                                              id="terms_conditions"
                                              required=""><?php echo e(isset($invoice) ? $invoice->terms_conditions : old('terms_conditions')); ?></textarea>
                                    <div class="invalid-feedback">
                                        Please fill in the terms conditions
                                    </div>
                                    <?php if($errors->has('terms_conditions')): ?>
                                        <span class="invalid-text">
                                            <?php echo e($errors->first('terms_conditions')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>

                            </div>


                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('Close'); ?></span>
                                </button>
                                <button type="submit" class=" btn btn-primary "><span><?php echo app('translator')->get('Submit'); ?></span>
                                </button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---Container Fluid-->




<?php $__env->stopSection(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/summernote.min.css')); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link href="<?php echo e(asset('assets/admin/css/bootstrap-iconpicker.min.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopPush(); ?>


<?php $__env->startPush('js-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/summernote.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        function delete_item(id){
            console.log(id);
            var jsonData = document.getElementById("invoiceItems").value;

            // Convert the existing JSON data to an array, or initialize an empty array if it's the first data
            var dataArray = jsonData != 'null' ? JSON.parse(jsonData) : [];

            dataArray.splice(id,1);
            document.getElementById("invoiceItems").value = JSON.stringify(dataArray);
            $("#item-"+id).closest("tr").remove();
            return false;
        }
        'use strict'

        $(document).ready(function () {
            $('#related_to').change(function (){
                if($('#related_to').val() == 1){
                    $('#leads_div').show();
                    $('#customers_div').hide();

                }
                else{
                    $('#customers_div').show();
                    $('#leads_div').hide();

                }
                console.log($('#related_to').val())
            });
            $('#addItemToTable').click(function (){
                var item_name = $('#description').val();
                var item_description = $('#long_description').val();
                var rate = $('#rate').val();
                var qty = $('#quantity').val();
                var tax = $('#tax').val();
                var data = {
                    'item_name': item_name,
                    'item_description': item_description,
                    'rate': rate,
                    'qty': qty,
                    'tax': tax,
                }
                var jsonData = document.getElementById("invoiceItems").value;
                var dataArray = jsonData && jsonData != 'null' ? JSON.parse(jsonData) : [];

                var id = dataArray.length;
                dataArray.push(data);
                document.getElementById("invoiceItems").value = JSON.stringify(dataArray);
                var html = '<tr>' +
                    '<td></td>' +
                    '<td>'+item_name+'</td>' +
                    '<td>'+item_description+'</td>' +
                    '<td>'+rate+'</td>' +
                    '<td>'+qty+'</td>' +
                    '<td>'+tax+'</td>' +
                    '<td>'+rate*qty+'</td>' +
                    '<td><a href="#" class="btn btn-primary" id="item-'+id+'" onclick="delete_item('+id+');return false;">Delete</a></td>' +
                    '</tr>';
                $('#itemTableBody').append(html);
                var subtotal = 0;
                dataArray.forEach(function (element) {
                        console.log(element)
                        subtotal += element.qty * element.rate;
                    }

                )
                $('#subtotal').val(subtotal);
                var discount =  $('#discount_percent').val();
                $('#total').val(subtotal-discount);
            });

            $('#discount_percent').keyup(function (){
                console.log()
                var subtotal =  $('#subtotal').val();
                var discount =  $('#discount_percent').val();
                $('#total').val(subtotal-discount);
            });
            $('.summernote').summernote({
                minHeight: 200,
                callbacks: {
                    onBlurCodeview: function() {
                        let codeviewHtml = $(this).siblings('div.note-editor').find('.note-codable').val();
                        $(this).val(codeviewHtml);
                    }
                }
            });
            $('#customer_id').change(function (e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "<?php echo e(route('admin.getCustomerInfo')); ?>",
                    type: "POST",
                    data: {
                        dataid:  $('#customer_id').val(),
                    },
                    success: function (data) {
                        $('#to_name').val(data.firstname + ' ' + data.lastname)
                        $('#address').val(data.address)
                        $('#city').val(data.city)
                        $('#state').val(data.state)
                        $('#zip_code').val(data.zip_code)
                        $('#country').val(data.country_code)
                        $('#email').val(data.email)
                        $('#phone').val(data.phone)
                    },
                });
            });

            $('.iconPicker').iconpicker({
                align: 'center', // Only in div tag
                arrowClass: 'btn-danger',
                arrowPrevIconClass: 'fas fa-angle-left',
                arrowNextIconClass: 'fas fa-angle-right',
                cols: 10,
                footer: true,
                header: true,
                icon: 'fas fa-bomb',
                iconset: 'fontawesome5',
                labelHeader: '{0} of {1} pages',
                labelFooter: '{0} - {1} of {2} icons',
                placement: 'bottom', // Only in button tag
                rows: 5,
                search: true,
                searchText: 'Search icon',
                selectedClass: 'btn-success',
                unselectedClass: ''
            }).on('change', function (e) {
                $(this).parent().siblings('.icon').val(`${e.icon}`);
            });
        });
        $('.tags-selectpicker').select2({
            width: '100%',
            placeholder: '<?php echo app('translator')->get("Select Tags"); ?>',
        });
        $('#itemsList').on('change',function (){
            var id = $('#itemsList').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('admin.getItemInfo')); ?>",
                type: "POST",
                data: {
                    dataid:  id,
                },
                success: function (data) {
                    $('#description').val(data.title)
                    $('#long_description').val(data.long_description)
                    $('#rate').val(data.rate)
                    $('#quantity').val(1)

                },
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/investment-realestate/resources/views/admin/invoices/create.blade.php ENDPATH**/ ?>