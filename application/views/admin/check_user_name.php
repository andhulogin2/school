<?php
$this->db->where('username',$user_name); 
$this->db->where('is_deleted','N'); 
$users=$this->db->get('tbl_users');
if($users->num_rows()>0){?>
<font color="#FF0000"><label class="col-sm-12" style="padding-left:300px;"><?php echo "already exist choose another one";?></label></font>
<?php }
else
{
?>
<font color="#00FF00"><label class="col-sm-12" style="padding-left:300px;"><?php echo "Proceed";?></label>
<?php } ?>

