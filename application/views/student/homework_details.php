<?php $running_year = get_running_year(); ?>
<?php 
    $current_homework = $this->db->get_where('homework' , array(
        'homework_code' => $homework_code
    ))->result_array();
    foreach ($current_homework as $row):
?>
<div class="col-md-9">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title"><font color="white">Details</font></div> 
        </div>
        <div class="panel-body">
            <p align="justify">
            <?php echo $row['description'];?>
            </p>
            <hr/>
            <p style="font-size: 10px;">
                <span class="badge badge-info badge-roundless"><?php echo get_phrase('you-have-until'); ?>:</span> <span class="badge badge-danger badge-roundless"><?php echo $row['time_end'];?></span> <span class="badge badge-info badge-roundless"><?php echo get_phrase('to-deliver-this-task'); ?>.</span> 
                  <hr/>
                <?php echo get_phrase('File'); ?><i class="entypo-download"></i>
                    <a href="<?php echo base_url() . 'uploads/homework/' . $row['file_name']; ?>" class="">
                    <?php echo $row['file_name']; ?></a>
            </p>
        </div>
    </div>
</div>


           
<?php endforeach;?>