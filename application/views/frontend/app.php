<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('frontend/layout/head.php') ?>
<body class="animsition">

<?php $this->load->view('frontend/layout/header.php') ?>

<?php $this->load->view('frontend/layout/sidebar.php') ?>

<?php $this->load->view('frontend/layout/content.php') ?>

<?php $this->load->view('frontend/layout/header.php') ?>

<?php $this->load->view('frontend/layout/footer.php') ?>

<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </span>
</div>

<!-- Container Selection1 -->
<div id="dropDownSelect1"></div>


<?php $this->load->view('frontend/layout/script.php') ?>

</body>
</html>
