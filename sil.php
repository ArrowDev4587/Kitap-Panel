<title> Kitap Panel | Sil</title>
<?php
                include 'baglan.php';    

                $id = $_GET['id'];

                echo "Silinecek ID: " . $id;

                $sorgu = $baglan -> prepare('DELETE FROM kitap WHERE id = ?');

                $sorgu -> execute([$id]);

                if ($sorgu-> rowCount()) {
                    header('location:listele.php');
                }
                else {
                    echo '
                    <div class="alert alert-danger mt-3 text-center" role="alert">
                        Silme sırasında hata oluştu!
                    </div>';
                }
            ?>