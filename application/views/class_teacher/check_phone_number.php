<?php
$digit=strlen($phone);
$this->db->where('phone1',$phone); 
$student=$this->db->get('student');
if($student->num_rows()>0){?>
<script>
alert("Phone no already exist, you really want to proceed");
</script>
<?php }?>