<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Kitap Panel | Anasayfa</title>
</head>
<body class="bg-dark">
    <?php include "navbar.php"; ?>
    <div class="row w-100">
        <div class="container col-md-12">
            <form action="index.php" enctype="multipart/form-data" method="post" class="w-75 bg-dark-subtle rounded mx-auto ms-auto p-3 fw-bold">
                <h1 class="text-center text-dark">Kitap ekle</h1>
                <div class="form-group p-2 float-start w-50 w-sm-100">
                    <label class="mb-2" for="kitapAdi">Kitap Adı</label>
                    <input type="text" required class="fw-bold form-control mb-3 border border-1 border-dark" id="kitapAdi" name="kitapAdi" placeholder="Kitap Adı">
                </div>
                <div class="form-group p-2 float-start w-50 w-sm-100">
                    <label class="mb-2" for="yazarAdi">Yazar Adı</label>
                    <input type="text" class="fw-bold form-control mb-3 border border-1 border-dark" id="yazarAdi" name="yazarAdi" placeholder="Yazar Adı">
                </div>
                <div class="form-group p-2 float-start w-50 w-sm-100">
                    <label class="mb-2" for="basimYili">Basım Yılı</label>
                    <input type="text" class="fw-bold form-control mb-3 border border-1 border-dark" id="basimYili" name="basimYili" placeholder="Basım Yılı">
                </div>
                <div class="form-group p-2 float-start w-50 w-sm-100">
                    <label class="mb-2" for="basimYili">Sayfa Sayısı</label>
                    <input type="text" class="fw-bold form-control mb-3 border border-1 border-dark" id="basimYili" name="sayfaSayisi" placeholder="Sayfa Sayısı">
                </div>
                <div class="form-group p-2 float-start w-50 w-sm-100">
                    <label class="mb-2" for="kitapAdeti">Kitap Adeti</label>
                    <input type="text" class="fw-bold form-control mb-3 border border-1 border-dark" id="kitapAdeti" name="kitapAdeti" placeholder="Kitap Adeti">
                </div>
                <div class="form-group p-2 float-start w-50 w-sm-100">
                    <label class="mb-2" for="fotoBoyut">Fotoğraf Boyutu (MB)</label>
                    <input type="number" class="fw-bold form-control mb-3 border border-1 border-dark" id="fotoBoyut" name="fotoBoyut" placeholder="Fotoğraf Boyutu (MB)">
                </div>
                <div class="form-group p-2 float-start w-100 ">
                    <label class="mb-2" for="kapakFotografi">Kapak Fotoğrafı</label><br>
                    <input type="file" class="fw-bold form-control mb-3 border border-1 border-dark" id="kapakFotografi" name="kapakFotografi">
                </div>
                <button type="submit" name="gonder" class="btn btn-outline-dark fw-bold border-3 mt-3 w-100">Kaydet</button>
            </form>
        </div>
        <div class="container col-md-4">
            <?php
                include 'baglan.php';
         
                if (isset($_POST['gonder'])) {
                    if (!empty($_POST['kitapAdi']) && !empty($_POST['yazarAdi']) && !empty($_POST['basimYili']) && !empty($_POST['sayfaSayisi']) && !empty($_POST['kitapAdeti']) && !empty($_FILES['kapakFotografi']['name']) && !empty($_POST['fotoBoyut'])) {
                        $kitapAdi = $_POST['kitapAdi'];
                        $yazarAdi = $_POST['yazarAdi'];
                        $basimYili = $_POST['basimYili'];
                        $sayfaSayisi = $_POST['sayfaSayisi'];
                        $kitapAdeti = $_POST['kitapAdeti'];
                        $fotoBoyut= $_POST['fotoBoyut'];

                        $eklenmeTarihi = date('Y/m/d'); 

                        if ($_FILES['kapakFotografi']['size'] <= (1024*1024) * $fotoBoyut) {
                            if ($_FILES['kapakFotografi']['type'] == 'image/jpeg' || $_FILES['kapakFotografi']['type'] == 'image/png') {
                                $dosya_adi = $_FILES['kapakFotografi']['name'];

                                $uret = array("bjk", "ksk" , "mp", "q7", "ad", "krb", "ace" ,"jitem");
        
                                $uzanti = explode(".", $dosya_adi);
                                $dosya_uzantisi = "." . end($uzanti);
        
                                $sayi_tut = rand(1,1912);
        
                                $yeni_ad = "images/" . $uret[rand(0,8)] . $sayi_tut . $dosya_uzantisi;
        
                                if (move_uploaded_file($_FILES['kapakFotografi']['tmp_name'], $yeni_ad)) {

                                    $sorgu = $baglan -> prepare("INSERT INTO kitap SET 
                                        kitap_adi = ?,
                                        yazar = ?,
                                        basim_yili = ?,
                                        sayfa_sayisi = ?,
                                        kitap_adet = ?,
                                        eklenme_tarihi = ?,
                                        kapak_yolu = ? 
                                    ");

                                    $kaydet = $sorgu -> execute([$kitapAdi,$yazarAdi,$basimYili,$sayfaSayisi,$kitapAdeti,$eklenmeTarihi,$yeni_ad]);
                                    
                                    if ($kaydet == 1) {
                                        echo '<div class="alert alert-success w-50 m-5" role="alert">Kitap eklendi!</div>';
                                    } else {
                                        echo '<div class="alert alert-danger w-50 m-5" role="alert">Kitap eklenirken sorun oluştu!</div>';
                                    }
                                     
                                } else {
                                    echo '<div class="alert alert-danger w-50 m-5" role="alert">Kapak fotoğrafı kaydedilirken sorun oluştu!</div>';
                                }
                            }
                        }
                        else {
                            echo '<div class="alert alert-danger w-50 m-5" role="alert">Fotoğraf boyutu en fazla ' . $fotoBoyut . ' MB olabilir</div>';
                        }
                    }
                        else {
                            echo '<div class="alert alert-danger w-50 m-5" role="alert">Girilmemiş kitap bilgileri var!</div>';
                        }
                    }
            ?>
        </div>
    </div>
    <h6 class="text-success m-3">Made by Arrow 🏹 ⚡</h6>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>