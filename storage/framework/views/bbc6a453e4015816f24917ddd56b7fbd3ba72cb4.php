<?php if(isset($templates['hero'][0]) && $hero = $templates['hero'][0]): ?>
    <!-- home section -->
    <section class="home-section">
        <div class="overlay h-100">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <section class="home-section">
                        <div class="overlay h-100">
                            <div class="container h-100">
                                <div class="row h-100 align-items-center">
                                    <div class="card text-center col-xl-12">
                                        <h5 class="text-center mt-4"><span>Buy shares of rental properties, earn monthly income, and watch your money grow</span><br /></h5>
                                        <div class="card-body">
                                            <div class="col-xl-12">
                                                <div class="text-box">
                                                    <button type="button" class="btn-custom-small mt-4 btn" id="filter_buy" onclick="filterSearchTab('filter_buy')">Buy</button>
                                                    <button type="button" class="btn-custom-small-nobg mt-4 btn" id="filter_rent" onclick="filterSearchTab('filter_rent')">Rent</button>
                                                    <button type="button" class="btn-custom-small-nobg mt-4 btn" id="filter_house_land" onclick="filterSearchTab('filter_house_land')">House & Land</button>
                                                    <button type="button" class="btn-custom-small-nobg mt-4 btn" id="filter_new_homes" onclick="filterSearchTab('filter_new_homes')">New Homes</button>
                                                    <button type="button" class="btn-custom-small-nobg mt-4 btn " id="filter_sold" onclick="filterSearchTab('filter_sold')">Sold</button>
                                                    <button type="button" class="btn-custom-small-nobg mt-4 btn" id="filter_retirement" onclick="filterSearchTab('filter_retirement')">Retirement</button>
                                                    <button type="button" class="btn-custom-small-nobg mt-4 btn" id="filter_rural" onclick="filterSearchTab('filter_rural')">Rural</button>
                                                    <!-- <div class="container"> -->
                                                    <form class="d2" action="<?php echo e(route('property')); ?>" method="get">
                                                        <input type="hidden" name="search_type" id="form_search_type">
                                                        <select name="location" class="form-select">
                                                            <?php $__currentLoopData = $allAddress; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($address->id); ?>"
                                                                        <?php if(request()->location == $address->id): ?> selected <?php endif; ?>><?php echo app('translator')->get(optional($address->details)->title); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <button type="submit" class="frombutton" value=" Search"><i class="bi bi-search"></i>Search</button>
                                                    </form>
                                                    <!-- </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  <div class="col-xl-5 d-none d-xl-block">
                                         <div class="img-main-wrapper">
                                             <div class="img-wrapper">
                                                 <div class="img-box img-1">
                                                     <img src="assets/uploads/content/648449aab972e1686391210.jpg" alt="" />
                                                 </div>
                                                 <div class="img-box img-2">
                                                     <img src="assets/uploads/content/648449cfdd4a91686391247.jpg" alt="" />
                                                 </div>
                                                 <div class="img-box img-3">
                                                     <img src="assets/uploads/content/648449d196e8e1686391249.jpg" alt="" />
                                                 </div>
                                             </div>
                                         </div>
                                     </div> -->
                                </div>
                            </div>
                        </div>
                    </section>

























                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<script>
    function filterSearchTab(btn_type){
        let old_active_tab = document.getElementsByClassName('btn-custom-small mt-4 btn')[0];
        old_active_tab.className = 'btn-custom-small-nobg mt-4 btn'
        let active_tab = document.getElementById(btn_type);
        active_tab.className = 'btn-custom-small mt-4 btn';
        let form_search_field=document.getElementById('form_search_type');
        form_search_field.value=btn_type;
    }
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/investment-realestate/resources/views/themes/original/partials/heroBanner.blade.php ENDPATH**/ ?>