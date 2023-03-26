<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Kitap Panel | Listele</title>
</head>
<body class="bg-dark">
    <div class="row container-fluid w-100">
        <nav class="navbar navbar-expand-lg bg-body-dark navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Kitap Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Anasayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="listele.php">Listele</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Sıralama</a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <form class="d-flex w-100" action="listele.php" method="POST">
                                <li>
                                    <button class="dropdown-item" type="submit" name="kitap_adi_btn">Kitap Adına Göre Sırala</button>
                                </li>
                                <li>
                                    <button class="dropdown-item" type="submit" name="eklenme_tarihi_btn">Eklenme Tarihine Göre Sırala</button>
                                </li>
                            </form>    
                        </ul>
                    </li>
                    <li class="nav-item">
                        <form action="listele.php" method="POST" class="d-flex w-100 ms-3" role="search">
                            <input class="form-control me-2 w-100 rounded-pill" type="search" name="kitap_ara" placeholder="Kitap ara" aria-label="Kitap ara">
                            <button class="btn btn-outline-light fw-bold border-2 rounded-pill" type="submit" name="ara_btn">Ara</button>
                        </form>
                    </li>
                </ul>
            </div> 
        </nav>
    </div>
        

    
    <div class="row w-100">
            <?php
                include 'baglan.php';

                if(isset($_POST['kitap_adi_btn'])){
                    $sorgu = $baglan -> prepare("SELECT * FROM kitap ORDER BY kitap_adi ASC");
                    $sorgu -> execute();
                }else if(isset($_POST['eklenme_tarihi_btn'])){
                    $sorgu = $baglan -> prepare("SELECT * FROM kitap ORDER BY eklenme_tarihi DESC");
                    $sorgu -> execute();
                }else{
                    $sorgu = $baglan -> query("SELECT * FROM kitap");
                    $sorgu -> execute();
                }
                

                if (isset($_POST['ara_btn'])) {
                    
                        if ($sorgu -> rowCount()) {
                            foreach ($sorgu as $getir) {
                                if (strpos(strtolower($getir['kitap_adi']),strtolower($_POST['kitap_ara'])) !== false) {
                                    echo '
                                    <div class="col-12 col-md-3"> 
                                        <div class="card flip-card kitap-card w-md-50 w-75 mx-auto ms-auto"> 
                                            <div class="flip-card-inner ">
                                                <div class="flip-card-back">
                                                    <img src="' . $getir['kapak_yolu'] . '" class="kitap-img">
                                                </div>
                                                <div class="flip-card-front">
                                                    <img src="' . $getir['kapak_yolu'] . '" class="card-img-top" style="height: 250px;">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold">Kitap Adı: ' . $getir['kitap_adi']  .  '</h5>
                                                            <p class="card-text fs-6">Yazar Adı: ' . $getir['yazar']  .  '</p>
                                                            <p class="card-text fs-6">Basım Yılı: ' . $getir['basim_yili']  . '</p>
                                                            <p class="card-text fs-6">Sayfa Sayısı: ' . $getir['sayfa_sayisi']  . '</p>
                                                            <p class="card-text fs-6">Kitap Adeti: ' . $getir['kitap_adet']  . '</p>
                                                            <p class="card-text fs-6">Eklenme Tarihi: ' . $getir['eklenme_tarihi'] ;
                                                            if($getir['guncelleme_tarihi'] !== ""){ 
                                                                if ($getir['guncelleme_tarihi'] !==  $getir['eklenme_tarihi']) {
                                                                echo '<span class="badge bg-secondary">Güncellenme Tarihi: ' . $getir['guncelleme_tarihi'] . '</span>';
                
                                                            }
                                                        }
        
                                                        echo '</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-group mt-1 w-100" role="group">
                                                <a href="guncelle.php?id=' . $getir['id'] . '" class="btn btn-outline-primary w-50 fw-bold border-2">Güncelle</a>
                                                <button type="button" class="btn btn-outline-danger w-50 fw-bold border-2" data-bs-toggle="modal" data-bs-target="#exampleModal' . $getir['id'] . '">
                                                Sil
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    </div> ';   
                                    echo '
                                    <div class="modal fade" id="exampleModal' . $getir['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-dark-subtle">
                                                <h5 class="modal-title text-dark fs-3 fw-bold" id="exampleModalLabel">Silmek istediğinize emin misiniz?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer bg-dark-subtle">
                                                <button type="button" class="btn btn-outline-primary fs-4 fw-bold" data-bs-dismiss="modal">Vazgeç</button>
                                                <a class="btn btn-outline-danger fs-4 fw-bold" href="sil.php?id=' . $getir['id'] . '"> Sil </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                    ';
                                
                            }
                        }
                    }
                }
                else {
                    
                    if ($sorgu -> rowCount()) {
                        foreach ($sorgu as $getir) {
                            echo '
                            <div class="col-12 col-md-3"> 
                                <div class="card flip-card seffaf rounded kitap-card w-md-50 w-75 m-5"> 
                                    <div class="flip-card-inner ">
                                        <div class="flip-card-back">
                                            <img src="' . $getir['kapak_yolu'] . '" class="kitap-img">
                                        </div>
                                        <div class="flip-card-front">
                                            <img src="' . $getir['kapak_yolu'] . '" class="card-img-top rounded" style="height: 250px;">
                                                <div class="card-body bg-light rounded">
                                                    <h5 class="card-title fw-bold">Kitap Adı: ' . $getir['kitap_adi']  .  '</h5>
                                                    <p class="card-text fs-6">Yazar Adı: ' . $getir['yazar']  .  '</p>
                                                    <p class="card-text fs-6">Basım Yılı: ' . $getir['basim_yili']  . '</p>
                                                    <p class="card-text fs-6">Sayfa Sayısı: ' . $getir['sayfa_sayisi']  . '</p>
                                                    <p class="card-text fs-6">Kitap Adeti: ' . $getir['kitap_adet']  . '</p>
                                                    <p class="card-text fs-6">Eklenme Tarihi: ' . $getir['eklenme_tarihi'] ;
                                                    if($getir['guncelleme_tarihi'] !== ""){ 
                                                        if ($getir['guncelleme_tarihi'] !==  $getir['eklenme_tarihi']) {
                                                        echo '<span class="badge bg-secondary">Güncellenme Tarihi: ' . $getir['guncelleme_tarihi'] . '</span>';
        
                                                    }
                                                }

                                                echo '</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group mt-1 w-100" role="group">
                                        <a href="guncelle.php?id=' . $getir['id'] . '" class="btn btn-outline-primary w-50 fw-bold border-2">Güncelle</a>
                                        <button type="button" class="btn btn-outline-danger w-50 fw-bold border-2" data-bs-toggle="modal" data-bs-target="#exampleModal' . $getir['id'] . '">
                                        Sil
                                        </button>
                                    </div>
                                </div>
                                
                            </div> ';   
                            echo '
                            <div class="modal fade" id="exampleModal' . $getir['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered ">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark-subtle">
                                        <h5 class="modal-title text-dark fs-3 fw-bold" id="exampleModalLabel">Silmek istediğinize emin misiniz?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer bg-dark-subtle">
                                        <button type="button" class="btn btn-outline-primary fs-4 fw-bold" data-bs-dismiss="modal">Vazgeç</button>
                                        <a class="btn btn-outline-danger fs-4 fw-bold" href="sil.php?id=' . $getir['id'] . '"> Sil </a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            ';
                            
                        }
                    }
                }
                
                



            ?>
        
    </div>
    <h6 class="text-success m-3">Made by Arrow 🏹 ⚡</h6>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>