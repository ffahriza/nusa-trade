<?php
session_start();
include 'koneksi.php';
?>
<?php include 'header.php'; ?>

<div class="container-fluid page-header mb-5 p-0" style="background-image: url(assets_home/img/bg1.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">ABOUT</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center text-uppercase">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item text-white active" aria-current="page">About Nusatrade</li>
				</ol>
			</nav>
		</div>
	</div>
</div>


<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 pt-4" style="min-height: 400px;">
                <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                    <img class="position-absolute img-fluid w-100 h-100" src="assets_home/img/bg1.jpg" style="object-fit: cover;" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <h6 class="text-primary text-uppercase">About Us</h6>
                <h1 class="mb-4">PT Sri Nusantara Abadi</h1>
                <p class="text-white" style='text-align: justify'>PT Sri Nusantara Abadi is an e-commerce platform that provides high quality premium ingredients for the needs of the kitchen and culinary industry. We offer selected products such as vanilla, coffee beans, various types of spices, and processed coconut products (coconut) with guaranteed quality. Through fast and safe service, we are committed to providing a comfortable shopping experience for customers, from professional chefs to culinary lovers.

                At PT Sri Nusantara Abadi, we believe that quality raw materials will improve the results of your cooking and drinks. Welcome to our shop, where you find the best ingredients for unforgettable flavor creations
                </p>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>