<?php
require ("perfil_process.php");
?>
<div class="col-md-2">
    <img src="<?php echo $foto; ?>" class="img-fluid" style="border: 1px solid #000000; border-radius: 10px;">
    <hr>    
    <h2><?php echo $crb_nr; ?></h2>
    <b><?php echo $crb; ?></b>
</div>
<div class="col-md-10">
    <h1><?php echo $b_name; ?></h1>
    <?php echo $return; ?>
    <?php echo $btn_perfil_update; ?>
    <hr>
    <!------- TABS --------->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo msg('Resume');?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile1" aria-selected="false"><?php echo msg('Register');?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile2" aria-selected="false"><?php echo msg('Documments');?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile3" aria-selected="false"><?php echo msg('Personal_informations');?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile4" aria-selected="false"><?php echo msg('Financial');?></a>
        </li>
    </ul>
    <!------ TABS CONTENTS ------>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active border1 pad20" id="home" role="tabpanel" aria-labelledby="home-tab"><?php echo $resume; ?></div>
    <div class="tab-pane fade border1 pad20" id="profile1" role="tabpanel" aria-labelledby="profile1-tab"><?php echo $rp; ?><?php echo $wp; ?></div>
    <div class="tab-pane fade border1 pad20" id="profile2" role="tabpanel" aria-labelledby="profile2-tab"><?php echo $te; ?></div>
    <div class="tab-pane fade border1 pad20" id="profile3" role="tabpanel" aria-labelledby="profile3-tab"><?php echo $ip; ?></div>
    <div class="tab-pane fade border1 pad20" id="profile4" role="tabpanel" aria-labelledby="profile4-tab"><?php echo $fi; ?></div>
    </div>    
</div>

<!-------- FIM ----------->
<div class="col-md-2">
    
</div>
<div class="col-md-10">
    <?php echo $return; ?>
</div>


