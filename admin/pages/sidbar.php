<?php include "base_url.php" ?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="<?php echo $baseURL?>index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Transactions</div>
                <a class="nav-link" href="<?php echo $pageURL?>add_transactions.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-from"></i></div>
                    Add Transactions
                </a>

                <a class="nav-link" href="<?php echo $pageURL?>transactions.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Transactions
                </a>
                <a class="nav-link" href="<?php echo $pageURL?>single_user.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Report
                </a>



                <div class="sb-sidenav-menu-heading">Reg</div>
                <a class="nav-link" href="<?php echo $pageURL?>cashier.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Cashier
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Users
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>