<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<div class="container-fluid p-0 mb-5">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" style="height: 900px;object-fit:cover;" src="assets_home/img/bg1.jpg" alt="Image">
                <div class="carousel-caption d-flex align-items-center">
                    <div class="container">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <div class="col-10 col-lg-7 text-center text-lg-start">
                                <h6 class="text-white text-uppercase mb-3 animated slideInDown">NUSATRADE</h6>
                                <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Premium Quality Spices</h1>
                            </div>
                            <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                <img class="img-fluid" src="assets_home/img/bg11.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
            <img class="w-100" style="height: 900px;object-fit:cover;" src="assets_home/img/bg1.jpg" alt="Image">
            <div class="carousel-caption d-flex align-items-center">
                    <div class="container">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <div class="col-10 col-lg-7 text-center text-lg-start">
                                <h6 class="text-white text-uppercase mb-3 animated slideInDown">NUSATRADE</h6>
                                <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Premium Quality Vanilla</h1>
                            </div>
                            <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                <img class="img-fluid" src="assets_home/img/bg2.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
            <img class="w-100" style="height: 900px;object-fit:cover;" src="assets_home/img/bg1.jpg" alt="Image">
            <div class="carousel-caption d-flex align-items-center">
                    <div class="container">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <div class="col-10 col-lg-7 text-center text-lg-start">
                                <h6 class="text-white text-uppercase mb-3 animated slideInDown">NUSATRADE</h6>
                                <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Fresh Coconut</h1>
                            </div>
                            <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                <img class="img-fluid" src="assets_home/img/bg3.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
            <img class="w-100" style="height: 900px;object-fit:cover;" src="assets_home/img/bg1.jpg" alt="Image">
            <div class="carousel-caption d-flex align-items-center">
                    <div class="container">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <div class="col-10 col-lg-7 text-center text-lg-start">
                                <h6 class="text-white text-uppercase mb-3 animated slideInDown">NUSATRADE</h6>
                                <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">International Top Quality Coffe Beans</h1>
                            </div>
                            <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                <img class="img-fluid" src="assets_home/img/bg4.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->


<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="d-flex py-5 px-4">
                    <i class="fa fa-certificate fa-3x text-primary flex-shrink-0"></i>
                    <div class="ps-4">
                        <h5 class="mb-3">Procurement of Quality Raw Materials</h5>
                        <p style="text-align: justify;">We provide various high quality raw materials</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="d-flex bg-light py-5 px-4">
                    <i class="fa fa-users-cog fa-3x text-primary flex-shrink-0"></i>
                    <div class="ps-4">
                        <h5 class="mb-3 text-dark">Product and Usage Consultation</h5>
                        <p style="text-align: justify;">Our expert team is ready to provide consultation regarding the most suitable products</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="d-flex py-5 px-4">
                    <i class="fa fa-truck fa-3x text-primary flex-shrink-0"></i>
                    <div class="ps-4">
                        <h5 class="mb-3">Fast and Safe Delivery</h5>
                        <p style="text-align: justify;">We ensure your product is packaged well and sent quickly and safely</p>
                    </div>
                </div>
            </div>
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
                <h1 class="mb-4">NUSATRADE</h1>
                <p class="mb-4" style="text-align:justify">Nusatrade is a leading e-commerce platform that provides a variety of high quality ingredients for culinary and industrial needs. We offer superior products such as selected spices, premium vanilla, fresh coconut and the best quality coffee beans. </p>
                <a href="tentangkami.php" class="btn btn-primary py-3 px-5">See More<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Service Start -->
<div class="container-xxl service py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">// Our Services //</h6>
            <h1 class="mb-5">Explore Our Products and Services</h1>
        </div>
        <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
            <div class="col-lg-4">
                <div class="nav w-100 nav-pills me-4">
                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 active" data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                        <i class="fa fa-seedling fa-2x me-3"></i>
                        <h4 class="m-0">Top Quality Coffe Beans</h4>
                    </button>
                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                        <i class="fa fa-leaf fa-2x me-3"></i>
                        <h4 class="m-0">Natural Vanilla Extract</h4>
                    </button>
                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                        <i class="fa fa-pepper-hot fa-2x me-3"></i>
                        <h4 class="m-0">Quality Qualified Spiced and Herbs</h4>
                    </button>
                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-0" data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                    <i class="fa fa-leaf fa-2x me-3"></i>
                        <h4 class="m-0">Premium Coconut Product</h4>
                    </button>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="tab-content w-100">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <div class="row g-4">
                            <div class="col-md-6" style="min-height: 350px;">
                                <div class="position-relative h-100">
                                    <img class="position-absolute img-fluid w-100 h-100" src="assets_home/img/gl1.jpg"
                                        style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="mb-3">Authentic Taste Coffer Beans</h3>
                                <p class="mb-4" style="text-align:justify">We provide selected coffee beans from the best plantations, producing a distinctive taste and attractive aroma for the perfect coffee experience.</p>
                                <p><i class="fa fa-check text-success me-3"></i>100% Organic</p>
                                <p><i class="fa fa-check text-success me-3"></i>Aroma Segar</p>
                                <p><i class="fa fa-check text-success me-3"></i>Kualitas Premium</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <div class="row g-4">
                            <div class="col-md-6" style="min-height: 350px;">
                                <div class="position-relative h-100">
                                   <img class="position-absolute img-fluid w-100 h-100" src="assets_home/img/gl2.jpg"
                                        style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="mb-3">Pure Vanila Extract</h3>
                                <p class="mb-4">The natural vanilla we offer has a rich and fragrant taste, ideal for a variety of culinary and beverage applications.</p>
                                <p><i class="fa fa-check text-success me-3"></i>Ekstrak Alami</p>
                                <p><i class="fa fa-check text-success me-3"></i>Rasa Autentik</p>
                                <p><i class="fa fa-check text-success me-3"></i>Kualitas Terbaik</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row g-4">
                            <div class="col-md-6" style="min-height: 350px;">
                                <div class="position-relative h-100">
                                   <img class="position-absolute img-fluid w-100 h-100" src="assets_home/img/bg1.jpg"
                                        style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="mb-3">Top Quality Spices</h3>
                                <p class="mb-4">We provides a variety of fresh and high quality spices that add authentic taste to your cooking.</p>
                                <p><i class="fa fa-check text-success me-3"></i>Aroma Tajam</p>
                                <p><i class="fa fa-check text-success me-3"></i>Rasa Khas</p>
                                <p><i class="fa fa-check text-success me-3"></i>Segar dan Murni</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-4">
                        <div class="row g-4">
                            <div class="col-md-6" style="min-height: 350px;">
                                <div class="position-relative h-100">
                                     <img class="position-absolute img-fluid w-100 h-100" src="assets_home/img/gl3.jpg"
                                        style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="mb-3">Premium Coconut Product</h3>
                                <p class="mb-4">Guaranteed fresh coconuts, perfect for a variety of needs, from coconut oil to coconut milk.</p>
                                <p><i class="fa fa-check text-success me-3"></i>100% Alami</p>
                                <p><i class="fa fa-check text-success me-3"></i>Segar dan Sehat</p>
                                <p><i class="fa fa-check text-success me-3"></i>Berkualitas Tinggi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">Our Product</h6>
            <h1 class="mb-5">Product</h1>
        </div>
        <div class="row g-4">
        <?php $ambil = $koneksi->query("SELECT *FROM barang LEFT JOIN kategori ON barang.id_kategori=kategori.id_kategori order by idbarang desc limit 6"); ?>
        <?php while ($perbarang = $ambil->fetch_assoc()) { ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" width="100%" src="foto/<?php echo $perbarang['fotobarang'] ?>" alt="">
                    </div>
                    <div class="bg-light text-center  p-4">
                        <h5 class="fw-bold mb-0 text-dark"><?php echo $perbarang['namabarang'] ?></h5>
                        <small>IDR <?php echo number_format($perbarang['hargabarang']) ?></small>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>