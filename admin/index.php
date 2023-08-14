<?php include "./pages/config.php" ?>
<!DOCTYPE html>
<html lang="en">


<?php include "./pages/header.php" ?>

<body class="sb-nav-fixed">
    <?php  include "./pages/nav.php"  ?>
    <div id="layoutSidenav">
        <?php include "./pages/sidbar.php" ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">


                    <Center>
                        <img style="height: 200px;" src="assets/img/guureTech.jpeg" alt="">
                        <h1 class="mt-50">Tanaad Master Agency</h1>

                        <h2 class="text-succuss">Soo Dhawoow <?php echo  $_SESSION['username'] ?></h2>
                    </Center>
                    <!-- <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Primary Card</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Warning Card</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Success Card</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Danger Card</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                    </div> -->


                </div>
            </main>

        </div>
    </div>
    <?php include "./pages/script.php" ?>
</body>

</html>