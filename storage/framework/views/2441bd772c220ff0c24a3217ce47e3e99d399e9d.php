<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get("Task List"); ?>
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
                            data-target="#addNewLead"><?php echo app('translator')->get('Add New Task'); ?></button>


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
                        <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Start Date'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Due Date'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Assigned'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Tags'); ?></th>

                        <th scope="col"><?php echo app('translator')->get('Priority'); ?></th>
                        <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                            <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                                <td class="text-center">
                                    <input type="checkbox" id="chk-<?php echo e($task->id); ?>"
                                           class="form-check-input row-tic tic-check" name="check" value="<?php echo e($task->id); ?>"
                                           data-id="<?php echo e($task->id); ?>">
                                    <label for="chk-<?php echo e($task->id); ?>"></label>
                                </td>
                            <?php endif; ?>
                            <td data-label="<?php echo app('translator')->get('No.'); ?>">
                                <a href="<?php echo e(route('admin.user-edit',[$task->id])); ?>" target="_blank">
                                    <div class="d-flex no-block align-items-center">

                                        <div class="">
                                            <?php echo e(loopIndex($tasks) + $loop->index); ?>

                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td data-label="<?php echo app('translator')->get('Company'); ?>"><?php echo app('translator')->get($task->subject); ?></td>
                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                            <span
                                class="custom-badge badge-pill <?php echo e($task->status == 0 ? 'bg-danger' : 'bg-success'); ?>"><?php echo e($task->status == 0 ? 'Inactive' : 'Active'); ?></span>
                            </td>
                            <td data-label="<?php echo app('translator')->get('Phone'); ?>"><?php echo app('translator')->get($task->start_date); ?></td>
                            <td data-label="<?php echo app('translator')->get('Phone'); ?>"><?php echo app('translator')->get($task->due_date); ?></td>
                                <td data-label="<?php echo app('translator')->get('Assigned'); ?>"><?php echo app('translator')->get($task->assigned_users); ?></td>

                            <td data-label="<?php echo app('translator')->get('Tags'); ?>"><?php echo app('translator')->get($task->tags); ?></td>
                            <td data-label="<?php echo app('translator')->get('Tags'); ?>"><?php echo app('translator')->get($task->priority); ?></td>



                            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                                <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" onclick="editTask(<?php echo e($task->id); ?>)">
                                                <i class="fa fa-edit text-warning pr-2"
                                                   aria-hidden="true"></i> <?php echo app('translator')->get('Edit'); ?>
                                            </a>
                                            <a class="dropdown-item" href="<?php echo e(route('admin.deleteTask',$task->id)); ?>">
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
                <?php echo e($tasks->appends(@$search)->links('partials.pagination')); ?>


            </div>
        </div>
    </div>


    <div class="modal fade" id="addNewLead">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="<?php echo e(route('admin.storeTask')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title"><?php echo app('translator')->get('Add New Task'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Subject</label>
                                <input type="text" class="form-control "
                                       name="subject"
                                       value="<?php echo e(old('subject')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the subject
                                </div>
                                <?php if($errors->has('subject')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('subject')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Hourly Rate</label>
                                <input type="text" class="form-control "
                                       name="hourly_rate"
                                       value="<?php echo e(old('hourly_rate')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the hourly rate
                                </div>
                                <?php if($errors->has('hourly_rate')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('hourly_rate')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Date</label>
                                <input type="date" class="form-control "
                                       name="issue_date"
                                       value="<?php echo e(old('issue_date')); ?>"  required="">
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
                                       value="<?php echo e(old('open_till_date')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the open till date
                                </div>
                                <?php if($errors->has('open_till_date')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('open_till_date')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 col-6" >
                                <label>Priority</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" id="priority" name="priority"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->fullname); ?></option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the contract type
                                </div>
                                <?php if($errors->has('contract_type')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('contract_type')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 col-6" >
                                <label>Assigned To</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" id="assigned_to" name="assigned_to"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->fullname); ?></option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the contract type
                                </div>
                                <?php if($errors->has('contract_type')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('contract_type')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Tags</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" name="tags"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <option value="bug">Bug</option>
                                    <option value="follow-up">follow-up</option>
                                    <option value="important">important</option>
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
                            <div class="form-group col-md-12 col-12">
                                <label>Description</label>
                                <textarea id="description" name="description" rows="4" class="form-control" placeholder="Description"></textarea>

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
    <div class="modal fade" id="editLead">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" id="updateTaskForm" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title"><?php echo app('translator')->get('Update Task'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Subject</label>
                                <input type="text" class="form-control "
                                       name="subject"
                                       id="editSubject"
                                       value="<?php echo e(old('subject')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the subject
                                </div>
                                <?php if($errors->has('subject')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('subject')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Hourly Rate</label>
                                <input type="text" class="form-control "
                                       name="hourly_rate"
                                       id="editHourlyRate"
                                       value="<?php echo e(old('hourly_rate')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the hourly rate
                                </div>
                                <?php if($errors->has('hourly_rate')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('hourly_rate')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Date</label>
                                <input type="date" class="form-control "
                                       name="issue_date"
                                       id="editStartDate"
                                       value="<?php echo e(old('issue_date')); ?>"  required="">
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
                                       id="editDueDate"

                                       value="<?php echo e(old('open_till_date')); ?>"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the open till date
                                </div>
                                <?php if($errors->has('open_till_date')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('open_till_date')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 col-6" >
                                <label>Priority</label>
                                <select id="editPriority" class="form-control  selectpicker currency-change"
                                        data-live-search="true" id="priority" name="priority"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->fullname); ?></option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the contract type
                                </div>
                                <?php if($errors->has('contract_type')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('contract_type')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 col-6" >
                                <label>Assigned To</label>
                                <select id="editAssignedTo" class="form-control  selectpicker currency-change"
                                        data-live-search="true" id="assigned_to" name="assigned_to"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->fullname); ?></option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the contract type
                                </div>
                                <?php if($errors->has('contract_type')): ?>
                                    <span class="invalid-text">
                                                <?php echo e($errors->first('contract_type')); ?>

                                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Tags</label>
                                <select id="editTags" class="form-control  selectpicker currency-change"
                                        data-live-search="true" name="tags"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <option value="bug">Bug</option>
                                    <option value="follow-up">follow-up</option>
                                    <option value="important">important</option>
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
                            <div class="form-group col-md-12 col-12">
                                <label>Description</label>
                                <textarea id="editDescription" name="description" rows="4" class="form-control" placeholder="Description"></textarea>

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
        function editTask(id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('admin.getTaskInfo')); ?>",
                type: "POST",
                data: {
                    dataid:  id,
                },
                success: function (data) {
                    $('#editSubject').val(data.subject)
                    $('#editHourlyRate').val(data.hourly_rate)
                    $('#editStartDate').val(data.start_date)
                    $('#editDueDate').val(data.due_date)
                    $('#editPriority').val(data.priority).trigger('change')
                    $('#editAssignedTo').val(data.assigned_users).trigger('change')
                    $('#editTags').val(data.tags).trigger('change')
                    $('#editDescription').val(data.task_description)
                    $('#updateTaskForm').attr('action','update-task/'+id);

                },
            });
            $('#editLead').modal('show');
        }
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/investment-realestate/resources/views/admin/tasks/list.blade.php ENDPATH**/ ?>