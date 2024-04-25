<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get("Contract List"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                <div class="dropdown mb-2 text-right">
                    <button class="btn btn-sm  btn-primary btn-rounded dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span><i class="fas fa-bars pr-2"></i> <?php echo app('translator')->get('Action'); ?></span>
                    </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_active"><?php echo app('translator')->get('Active'); ?></button>
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_inactive"><?php echo app('translator')->get('Inactive'); ?></button>
                    </div>
                    <a class="btn btn-sm  btn-primary btn-rounded" type="button" href="<?php echo e(route('admin.createContract')); ?>"
                    ><?php echo app('translator')->get('Add New Contract'); ?></a>



                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                            <th scope="col" class="text-center">
                                <input type="checkbox" class="form-check-input check-all tic-check" name="check-all"
                                       id="check-all">
                                <label for="check-all"></label>
                            </th>
                        <?php endif; ?>
                        <th scope="col"><?php echo app('translator')->get('No.'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Subject'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Customer'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Contract Type'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Contract Value'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Start Date'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('End Date'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                            <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                                <td class="text-center">
                                    <input type="checkbox" id="chk-<?php echo e($contract->id); ?>"
                                           class="form-check-input row-tic tic-check" name="check" value="<?php echo e($contract->id); ?>"
                                           data-id="<?php echo e($contract->id); ?>">
                                    <label for="chk-<?php echo e($contract->id); ?>"></label>
                                </td>
                            <?php endif; ?>
                            <td data-label="<?php echo app('translator')->get('No.'); ?>">
                                <a href="<?php echo e(route('admin.user-edit',[$contract->id])); ?>" target="_blank">
                                    <div class="d-flex no-block align-items-center">

                                        <div class="">
                                <?php echo e(loopIndex($contracts) + $loop->index); ?>

                                        </div>
                                    </div>
                                </a>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Company'); ?>"><?php echo app('translator')->get($contract->subject); ?></td>
                            <td data-label="<?php echo app('translator')->get('Phone'); ?>"><?php echo app('translator')->get($contract->customer_id); ?></td>
                            <td data-label="<?php echo app('translator')->get('Phone'); ?>"><?php echo app('translator')->get($contract->type); ?></td>
                            <td data-label="<?php echo app('translator')->get('Tags'); ?>"><?php echo app('translator')->get($contract->contract_value); ?></td>
                            <td data-label="<?php echo app('translator')->get('Assigned'); ?>"><?php echo app('translator')->get($contract->start_date); ?></td>
                            <td data-label="<?php echo app('translator')->get('Assigned'); ?>"><?php echo app('translator')->get($contract->end_date); ?></td>

                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                <span
                                    class="custom-badge badge-pill <?php echo e($contract->status == 0 ? 'bg-danger' : 'bg-success'); ?>"><?php echo e($contract->status == 0 ? 'Inactive' : 'Active'); ?></span>
                            </td>

                            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                                <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="<?php echo e(route('admin.editContract',$contract->id)); ?>">
                                                <i class="fa fa-edit text-warning pr-2"
                                                   aria-hidden="true"></i> <?php echo app('translator')->get('Edit'); ?>
                                            </a>
                                            <a class="dropdown-item" href="<?php echo e(route('admin.deleteContract',$contract->id)); ?>">
                                                <i class="fa fa-trash text-danger pr-2"
                                                   aria-hidden="true"></i> <?php echo app('translator')->get('Delete'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-center text-na" colspan="100%"><?php echo app('translator')->get('No User Data'); ?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($contracts->appends(@$search)->links('partials.pagination')); ?>


            </div>
        </div>
    </div>


    <div class="modal fade" id="addNewLead">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="<?php echo e(route('admin.createLead')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title"><?php echo app('translator')->get('Add New Lead'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-4 col-4">
                                <label>Status</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" name="status"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <option value="1">New</option>
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
                            <div class="form-group col-md-4 col-4">
                                <label>Source</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" name="source"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <option value="1">New</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the source
                                </div>
                                <?php if($errors->has('source')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('source')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-4 col-4">
                                <label>Assigned User</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" name="assigned_user"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <option value="1">New</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the assigned user
                                </div>
                                <?php if($errors->has('assigned_user')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('assigned_user')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Tags</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" name="tags"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <option value="1">New</option>
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
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Name</label>
                                <input type="text" class="form-control "
                                       name="name"
                                       value="<?php echo e(old('name')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the payment method name
                                </div>
                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('name')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Address</label>
                                <input type="text" class="form-control "
                                       name="address"
                                       value="<?php echo e(old('address')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the address
                                </div>
                                <?php if($errors->has('address')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('address')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Position</label>
                                <input type="text" class="form-control "
                                       name="position"
                                       value="<?php echo e(old('position')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the payment method name
                                </div>
                                <?php if($errors->has('position')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('position')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>City</label>
                                <input type="text" class="form-control "
                                       name="city"
                                       value="<?php echo e(old('city')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the address
                                </div>
                                <?php if($errors->has('city')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('city')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Email Address</label>
                                <input type="text" class="form-control "
                                       name="email_address"
                                       value="<?php echo e(old('email_address')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the email address
                                </div>
                                <?php if($errors->has('email_address')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('email_address')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>State</label>
                                <input type="text" class="form-control "
                                       name="state"
                                       value="<?php echo e(old('state')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the address
                                </div>
                                <?php if($errors->has('state')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('state')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Website</label>
                                <input type="text" class="form-control "
                                       name="website"
                                       value="<?php echo e(old('website')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the website
                                </div>
                                <?php if($errors->has('website')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('website')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Country</label>
                                <input type="text" class="form-control "
                                       name="country"
                                       value="<?php echo e(old('country')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the country
                                </div>
                                <?php if($errors->has('country')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('country')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Phone</label>
                                <input type="text" class="form-control "
                                       name="phone"
                                       value="<?php echo e(old('phone')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the phone
                                </div>
                                <?php if($errors->has('phone')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('phone')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Zip Code</label>
                                <input type="text" class="form-control "
                                       name="zip_code"
                                       value="<?php echo e(old('zip_code')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the zip code
                                </div>
                                <?php if($errors->has('zip_code')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('zip_code')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Lead Value</label>
                                <input type="text" class="form-control "
                                       name="lead_value"
                                       value="<?php echo e(old('lead_value')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the lead value
                                </div>
                                <?php if($errors->has('lead_value')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('lead_value')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Default Language</label>
                                <input type="text" class="form-control "
                                       name="language"
                                       value="<?php echo e(old('language')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the language
                                </div>
                                <?php if($errors->has('language')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('language')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Company</label>
                                <input type="text" class="form-control "
                                       name="company"
                                       value="<?php echo e(old('company')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the company
                                </div>
                                <?php if($errors->has('company')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('company')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Description</label>
                                <input type="text" class="form-control "
                                       name="description"
                                       value="<?php echo e(old('description')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the description
                                </div>
                                <?php if($errors->has('description')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('description')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('Close'); ?></span>
                        </button>
                        <button type="submit" class=" btn btn-primary "><span><?php echo app('translator')->get('Yes'); ?></span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="all_active" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title"><?php echo app('translator')->get('Active User Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <p><?php echo app('translator')->get("Are you really want to active the User's"); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('No'); ?></span></button>
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <a href="" class="btn btn-primary active-yes"><span><?php echo app('translator')->get('Yes'); ?></span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="all_inactive" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title"><?php echo app('translator')->get('DeActive User Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <p><?php echo app('translator')->get("Are you really want to Inactive the User's"); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('No'); ?></span></button>
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <a href="" class="btn btn-primary inactive-yes"><span><?php echo app('translator')->get('Yes'); ?></span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Login as a User Modal -->
    <div class="modal fade" id="signIn">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="" class="loginAccountAction" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title"><?php echo app('translator')->get('Sing In Confirmation'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to sign in this account?'); ?></p>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('Close'); ?></span>
                        </button>
                        <button type="submit" class=" btn btn-primary "><span><?php echo app('translator')->get('Yes'); ?></span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
    <script>
        "use strict";

        $(document).on('click', '#check-all', function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $(document).on('change', ".row-tic", function () {
            let length = $(".row-tic").length;
            let checkedLength = $(".row-tic:checked").length;
            if (length == checkedLength) {
                $('#check-all').prop('checked', true);
            } else {
                $('#check-all').prop('checked', false);
            }
        });

        //dropdown menu is not working
        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });

        //multiple active
        $(document).on('click', '.active-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
            });

            var strIds = allVals;

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "<?php echo e(route('admin.user-multiple-active')); ?>",
                data: {strIds: strIds},
                datatType: 'json',
                type: "post",
                success: function (data) {
                    location.reload();

                },
            });
        });

        //multiple deactive
        $(document).on('click', '.inactive-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
            });

            var strIds = allVals;
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "<?php echo e(route('admin.user-multiple-inactive')); ?>",
                data: {strIds: strIds},
                datatType: 'json',
                type: "post",
                success: function (data) {
                    location.reload();

                }
            });
        });

        $(document).on('click', '.loginAccount', function () {
            var route = $(this).data('route');
            $('.loginAccountAction').attr('action', route)
        });

        $('select').select2({
            selectOnClose: true,
            width: '100%'
        });

        $('.from_date').on('change', function (){
            $('.to_date').removeAttr('disabled');
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/investment-realestate/resources/views/admin/contracts/list.blade.php ENDPATH**/ ?>