<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3 fs-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">VENDORLY</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Products
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Maximillian Wears</a></li>
                    <li><a class="dropdown-item" href="#">Ore's Treats</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Dave's Store</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class='bx bx-plus-circle' id="nav-icon"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./index.html">Logout</a>
            </li>
        </ul>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search for a product" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" id="caro-item">
                <img src="./img/snacks.jpg" class="w-100 object-fit-cover" alt="...">
                <div class="carousel-caption d-none d-md-block" id="caro-text">
                    <h5>Ore's Treats</h5>
                    <p>20% off on all snacks and goodies in Ore's Treats.</p>
                </div>
            </div>

            <div class="carousel-item" id="caro-item">
                <img src="./img/cereal.jpg" class="d-block w-100 object-fit-cover" alt="...">
                <div class="carousel-caption d-none d-md-block" id="caro-text">
                    <h5>Dave's Store</h5>
                    <p>New stock available in Dave's store, more cereals to your taste.</p>
                </div>
            </div>

            <div class="carousel-item" id="caro-item">
                <img src="./img/clothes2.jpg" class="d-block w-100 object-fit-cover" alt="...">
                <div class="carousel-caption d-none d-md-block" id="caro-text">
                    <h5>Maximillian's Wears</h5>
                    <p>See new incoming outfits to up your steeze game.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section class="pt-5 pb-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h3 class="mb-3">Best Sellers in Feeding Provision</h3>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-primary mb-3 mr-1" 
                       href="#carouselExampleIndicators2"
                       role="button"
                        data-slide="prev">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <a class="btn btn-primary mb-3"
                       href="#carouselExampleIndicators2"
                       role="button"
                       data-slide="next">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
                <div class="col-12">
                    <div id="carouselExampleIndicators2" 
                         class="carousel slide"
                         data-ride="carousel">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-9.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-9.jpg">
                                                 <div class="card-body">
                                                     <h4 class="card-title">
                                                       Special title treatment</h4>
                                                     <p class="card-text">With supporting text below as a natural lead-in</p>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-9.jpg">
                                                 <div class="card-body">
                                                     <h4 class="card-title">
                                                       Special title treatment</h4>
                                                     <p class="card-text">With supporting text below as a natural lead-in</p>
                                                </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-8.jpg">
                                                 <div class="card-body">
                                                     <h4 class="card-title">
                                                       Special title treatment</h4>
                                                     <p class="card-text">With supporting text below as a natural lead-in</p>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                            src="./img/farm-8.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                            src="./img/farm-8.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-6.jpg">
                                                 <div class="card-body">
                                                     <h4 class="card-title">
                                                       Special title treatment</h4>
                                                     <p class="card-text">With supporting text below as a natural lead-in</p>
                                                 </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                            src="./img/farm-6.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-6.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h3 class="mb-3">Best Sellers in Snacks and Treats</h3>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-primary mb-3 mr-1" 
                       href="#carouselExampleIndicators2"
                       role="button"
                        data-slide="prev">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <a class="btn btn-primary mb-3"
                       href="#carouselExampleIndicators2"
                       role="button"
                       data-slide="next">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
                <div class="col-12">
                    <div id="carouselExampleIndicators2" 
                         class="carousel slide"
                         data-ride="carousel">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-9.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-9.jpg">
                                                 <div class="card-body">
                                                     <h4 class="card-title">
                                                       Special title treatment</h4>
                                                     <p class="card-text">With supporting text below as a natural lead-in</p>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-9.jpg">
                                                 <div class="card-body">
                                                     <h4 class="card-title">
                                                       Special title treatment</h4>
                                                     <p class="card-text">With supporting text below as a natural lead-in</p>
                                                </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-8.jpg">
                                                 <div class="card-body">
                                                     <h4 class="card-title">
                                                       Special title treatment</h4>
                                                     <p class="card-text">With supporting text below as a natural lead-in</p>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                            src="./img/farm-8.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                            src="./img/farm-8.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-6.jpg">
                                                 <div class="card-body">
                                                     <h4 class="card-title">
                                                       Special title treatment</h4>
                                                     <p class="card-text">With supporting text below as a natural lead-in</p>
                                                 </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                            src="./img/farm-6.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-6.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h3 class="mb-3">Best Sellers in Fashion</h3>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-primary mb-3 mr-1" 
                       href="#carouselExampleIndicators2"
                       role="button"
                        data-slide="prev">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <a class="btn btn-primary mb-3"
                       href="#carouselExampleIndicators2"
                       role="button"
                       data-slide="next">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
                <div class="col-12">
                    <div id="carouselExampleIndicators2" 
                         class="carousel slide"
                         data-ride="carousel">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-9.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-9.jpg">
                                                 <div class="card-body">
                                                     <h4 class="card-title">
                                                       Special title treatment</h4>
                                                     <p class="card-text">With supporting text below as a natural lead-in</p>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-9.jpg">
                                                 <div class="card-body">
                                                     <h4 class="card-title">
                                                       Special title treatment</h4>
                                                     <p class="card-text">With supporting text below as a natural lead-in</p>
                                                </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-8.jpg">
                                                 <div class="card-body">
                                                     <h4 class="card-title">
                                                       Special title treatment</h4>
                                                     <p class="card-text">With supporting text below as a natural lead-in</p>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                            src="./img/farm-8.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                            src="./img/farm-8.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-6.jpg">
                                                 <div class="card-body">
                                                     <h4 class="card-title">
                                                       Special title treatment</h4>
                                                     <p class="card-text">With supporting text below as a natural lead-in</p>
                                                 </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                            src="./img/farm-6.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" 
                                                 alt="100%x280"
                                                 src="./img/farm-6.jpg">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                  Special title treatment</h4>
                                                <p class="card-text">With supporting text below as a natural lead-in</p>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="text-center text-lg-start bg-dark text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social networks:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
        <a href="" class="me-4 text-reset">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 text-reset">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 text-reset">
            <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 text-reset">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 text-reset">
            <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 text-reset">
            <i class="fab fa-github"></i>
        </a>
        </div>
        <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
                <i class="fas fa-gem me-3"></i>Company name
            </h6>
            <p>
                Here you can use rows and columns to organize your footer content. Lorem ipsum
                dolor sit amet, consectetur adipisicing elit.
            </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
                Products
            </h6>
            <p>
                <a href="#!" class="text-reset">Angular</a>
            </p>
            <p>
                <a href="#!" class="text-reset">React</a>
            </p>
            <p>
                <a href="#!" class="text-reset">Vue</a>
            </p>
            <p>
                <a href="#!" class="text-reset">Laravel</a>
            </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
                Useful links
            </h6>
            <p>
                <a href="#!" class="text-reset">Pricing</a>
            </p>
            <p>
                <a href="#!" class="text-reset">Settings</a>
            </p>
            <p>
                <a href="#!" class="text-reset">Orders</a>
            </p>
            <p>
                <a href="#!" class="text-reset">Help</a>
            </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
            <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
            <p>
                <i class="fas fa-envelope me-3"></i>
                info@example.com
            </p>
            <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
            <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2021 Copyright:
        <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script type="text/javascript"src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
