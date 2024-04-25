<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get("Items List"); ?>
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
                    <button class="btn btn-sm  btn-primary btn-rounded" type="button" data-toggle="modal"
                            data-target="#addNewItem"><?php echo app('translator')->get('Add New Item'); ?></button>


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
                        <th scope="col"><?php echo app('translator')->get('Description'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Long Description'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Rate'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Unit'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Group Name'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                            <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                                <td class="text-center">
                                    <input type="checkbox" id="chk-<?php echo e($item->id); ?>"
                                           class="form-check-input row-tic tic-check" name="check" value="<?php echo e($item->id); ?>"
                                           data-id="<?php echo e($item->id); ?>">
                                    <label for="chk-<?php echo e($item->id); ?>"></label>
                                </td>
                            <?php endif; ?>
                            <td data-label="<?php echo app('translator')->get('No.'); ?>">
                                <a href="<?php echo e(route('admin.user-edit',[$item->id])); ?>" target="_blank">
                                    <div class="d-flex no-block align-items-center">

                                        <div class="">
                                <?php echo e(loopIndex($items) + $loop->index); ?>

                                        </div>
                                    </div>
                                </a>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Company'); ?>"><?php echo app('translator')->get($item->title); ?></td>
                            <td data-label="<?php echo app('translator')->get('Phone'); ?>"><?php echo app('translator')->get($item->long_description); ?></td>
                            <td data-label="<?php echo app('translator')->get('Phone'); ?>"><?php echo app('translator')->get($item->rate); ?></td>
                            <td data-label="<?php echo app('translator')->get('Tags'); ?>"><?php echo app('translator')->get($item->unit); ?></td>
                            <td data-label="<?php echo app('translator')->get('Assigned'); ?>"><?php echo app('translator')->get($item->item_group); ?></td>

                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                <span
                                    class="custom-badge badge-pill <?php echo e($item->status == 0 ? 'bg-danger' : 'bg-success'); ?>"><?php echo e($item->status == 0 ? 'Inactive' : 'Active'); ?></span>
                            </td>

                            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                                <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" onclick="editItem(<?php echo e($item->id); ?>)">
                                                <i class="fa fa-edit text-warning pr-2"
                                                   aria-hidden="true"></i> <?php echo app('translator')->get('Edit'); ?>
                                            </a>
                                            <a class="dropdown-item" href="<?php echo e(route('admin.deleteItem',$item->id)); ?>">
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
                <?php echo e($items->appends(@$search)->links('partials.pagination')); ?>


            </div>
        </div>
    </div>


    <div class="modal fade" id="addNewItem">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="<?php echo e(route('admin.createItem')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title"><?php echo app('translator')->get('Add New Item'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="row">
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
                            <div class="form-group col-md-12 col-12">
                                <label>Long Description</label>
                                <textarea type="text" class="form-control "
                                       name="long_description"
                                          required=""><?php echo e(old('long_description')); ?></textarea>
                                <div class="invalid-feedback">
                                    Please fill in the long description
                                </div>
                                <?php if($errors->has('long_description')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('long_description')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Rate</label>
                                <input type="text" class="form-control "
                                       name="rate"
                                       value="<?php echo e(old('rate')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the rate
                                </div>
                                <?php if($errors->has('rate')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('rate')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Unit</label>
                                <input type="text" class="form-control "
                                       name="unit"
                                       value="<?php echo e(old('unit')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the unit
                                </div>
                                <?php if($errors->has('unit')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('unit')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Item Group</label>
                                <select name="item_group" class="form-control">
                                    <option value="1" >Product</option>
                                    <option value="2" >Service</option>

                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the unit
                                </div>
                                <?php if($errors->has('unit')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('unit')); ?>

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
    <div class="modal fade" id="editItem">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" id="editItemForm" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title"><?php echo app('translator')->get('Edit Item'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Description</label>
                                <input type="text" class="form-control "
                                       name="description"
                                       id="editDescription"
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
                            <div class="form-group col-md-12 col-12">
                                <label>Long Description</label>
                                <textarea type="text" class="form-control "
                                       name="long_description"
                                       id="editLongDescription"
                                          required=""><?php echo e(old('long_description')); ?></textarea>
                                <div class="invalid-feedback">
                                    Please fill in the long description
                                </div>
                                <?php if($errors->has('long_description')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('long_description')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Rate</label>
                                <input type="text" class="form-control "
                                       name="rate"
                                       id="editRate"
                                       value="<?php echo e(old('rate')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the rate
                                </div>
                                <?php if($errors->has('rate')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('rate')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Unit</label>
                                <input type="text" class="form-control "
                                       name="unit"
                                       id="editUnit"
                                       value="<?php echo e(old('unit')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the unit
                                </div>
                                <?php if($errors->has('unit')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('unit')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Item Group</label>
                                <select id="editItemGroup" name="item_group" class="form-control">
                                    <option value="1" >Product</option>
                                    <option value="2" >Service</option>

                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the unit
                                </div>
                                <?php if($errors->has('unit')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('unit')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>


                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('Close'); ?></span>
                        </button>
                        <button type="submit" class=" btn btn-primary "><span><?php echo app('translator')->get('Update'); ?></span>
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
        function editItem(id) {

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
                        $('#editDescription').val(data.title)
                        $('#editLongDescription').val(data.long_description)
                        $('#editRate').val(data.rate)
                        $('#editUnit').val(data.unit)
                        $('#editItemGroup').val(data.item_group).trigger('change')
                        $('#editItemForm').attr('action','update-item/'+id);

                    },
                });
            $('#editItem').modal('show');
        }

        $('select').select2({
            selectOnClose: true,
            width: '100%'
        });

        $('.from_date').on('change', function (){
            $('.to_date').removeAttr('disabled');
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/investment-realestate/resources/views/admin/items/list.blade.php ENDPATH**/ ?>