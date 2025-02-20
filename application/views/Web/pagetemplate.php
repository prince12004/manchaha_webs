<?php
$page_name = $result[0]['page_name'];
$cate['CategoryDescription'] = $page_name;
?>

<?php $this->load->view('User/header',['cat'=>$cate]) ?>

       <!-- <?php include $login_Type."/menubar.php"; ?> -->


  	   <!-- <?php include  $login_Type."/page_info.php"; ?> -->


   <?php $this->load->View('User/'.$page_name,['result'=>$result]) ?>


<?php $this->load->View("User/footer.php") ?>