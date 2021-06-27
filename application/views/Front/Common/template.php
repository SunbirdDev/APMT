<?php
	$this->load->view("Front/Common/header");
?>
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
<?php 
	$this->load->view($main_content);
?>
	</div>
</div>
<?php 
	$this->load->view("Front/Common/footer");
?>