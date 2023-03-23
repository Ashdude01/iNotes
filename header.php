<header>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid text-white">
                <a class="navbar-brand" href="/"><strong>iNotes</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="contact.php">Contact</a>
                        </li>

                    </ul>
                    <?php
                    if(isset($_SESSION['user'])){
                        echo "<a href='dashboard.php' class='btn btn-success' ><i class='bi bi-person'></i> {$_SESSION['user']}</a>
                        <a href='logout.php' class='btn btn-danger mx-2' ><i class='bi bi-power'></i></a>
                        ";
                    }else{
                        echo "<a href='register.php' class='btn btn-success' ><i class='bi bi-person'></i> Register</a>
                        <a href='login.php' class='btn btn-primary mx-2' ><i class='bi bi-box-arrow-right'></i> Login</a>";
                    }
                    ?>
                    </div>
            </div>
        </nav>
    </header>