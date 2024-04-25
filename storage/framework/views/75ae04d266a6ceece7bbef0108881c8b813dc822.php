<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get("Proposal List"); ?>
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
                    <a class="btn btn-sm  btn-primary btn-rounded" type="button" href="<?php echo e(route('admin.createProposal')); ?>"
                            ><?php echo app('translator')->get('Add New Proposal'); ?></a>


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
                        <th scope="col"><?php echo app('translator')->get('Proposal#'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Subject'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('To'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Total'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Date'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Open Till'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Tags'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Created'); ?></th>

                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                            <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $proposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                                <td class="text-center">
                                    <input type="checkbox" id="chk-<?php echo e($proposal->id); ?>"
                                           class="form-check-input row-tic tic-check" name="check" value="<?php echo e($proposal->id); ?>"
                                           data-id="<?php echo e($proposal->id); ?>">
                                    <label for="chk-<?php echo e($proposal->id); ?>"></label>
                                </td>
                            <?php endif; ?>
                            <td data-label="<?php echo app('translator')->get('No.'); ?>">
                                <a href="<?php echo e(route('admin.user-edit',[$proposal->id])); ?>" target="_blank">

                                Proposal-<?php echo e($proposal->id); ?>

                                </a>

                            </td>
                            <td data-label="<?php echo app('translator')->get('Subject'); ?>">
                                    <div class="d-flex no-block align-items-center">

                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium"><?php echo app('translator')->get($proposal->subject); ?></h5>
                                        </div>
                                    </div>
                            </td>
                            <td data-label="<?php echo app('translator')->get('Company'); ?>"><?php echo app('translator')->get($proposal->proposal_to); ?></td>
                            <td data-label="<?php echo app('translator')->get('Phone'); ?>"><?php echo app('translator')->get($proposal->subtotal); ?></td>
                            <td data-label="<?php echo app('translator')->get('Phone'); ?>"><?php echo app('translator')->get($proposal->date); ?></td>
                            <td data-label="<?php echo app('translator')->get('Tags'); ?>"><?php echo app('translator')->get($proposal->open_till); ?></td>
                            <td data-label="<?php echo app('translator')->get('Assigned'); ?>"><?php $__currentLoopData = $proposal->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo app('translator')->get($tg); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                                <td data-label="<?php echo app('translator')->get('Created'); ?>"><?php echo e($proposal->created_at); ?></td>

                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                <span
                                    class="custom-badge badge-pill <?php echo e($proposal->status == 0 ? 'bg-danger' : 'bg-success'); ?>"><?php echo e($proposal->status == 0 ? 'Inactive' : 'Active'); ?></span>
                            </td>

                            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                                <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="<?php echo e(route('admin.editProposal',$proposal->id)); ?>">
                                                <i class="fa fa-edit text-warning pr-2"
                                                   aria-hidden="true"></i> <?php echo app('translator')->get('Edit'); ?>
                                            </a>
                                            <a class="dropdown-item" href="<?php echo e(route('admin.deleteProposal',$proposal->id)); ?>">
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
                <?php echo e($proposals->appends(@$search)->links('partials.pagination')); ?>


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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/investment-realestate/resources/views/admin/proposals/list.blade.php ENDPATH**/ ?>