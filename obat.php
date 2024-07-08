<?php
    // session_start();
    if(!isset($_SESSION["login"]))
    {
        header("location: index.php?page=loginUser");
        exit;
    }
?>

    <form class="form col" method="POST" action="" name="myForm" onsubmit="return(validate());">
        <?php
        $nama_obat = '';
        $kemasan = '';
        $harga = '';
        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, "SELECT * FROM obat WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $nama_obat = $row['nama_obat'];
                $kemasan = $row['kemasan'];
                $harga = $row['harga'];
            }
        ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <?php
        }
        ?>
        <div class="row mt-3">
            <label for="nama_obat" class="form-label fw-bold">
                Nama Obat
            </label>
            <input type="text" class="form-control" name="nama_obat" id="nama_obat" placeholder="Nama Obat" value="<?php echo $nama_obat ?>">
        </div>
        <div class="row mt-3">
            <label for="kemasan" class="form-label fw-bold">
                Kemasan
            </label>
            <input type="text" class="form-control" name="kemasan" id="kemasan" placeholder="Kemasan" value="<?php echo $kemasan ?>">
        </div>
        <div class="row mt-3">
            <label for="harga" class="form-label fw-bold">
                Harga
            </label>
            <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga ?>">
        </div>
        <div class="row d-flex mt-3">
            <button type="submit" class="btn btn-primary rounded-pill" style="width: 3cm;" name="simpan">Simpan</button>
        </div>
    </form>
    
    <table class="table table-hover my-3">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama obat</th>
                <th scope="col">kemasan</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM obat");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nama_obat'] ?></td>
                    <td><?php echo $data['kemasan'] ?></td>
                    <td>Rp. <?php echo $data['harga'] ?></td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3" href="index.php?page=obat&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="index.php?page=obat&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
    if (isset($_POST['simpan'])) {
        if (isset($_POST['id'])) {
            $ubah = mysqli_query($mysqli, "UPDATE obat SET 
                                            nama_obat = '" . $_POST['nama_obat'] . "',
                                            kemasan = '" . $_POST['kemasan'] . "',
                                            harga = '" . $_POST['harga'] . "'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
        } else {
            $tambah = mysqli_query($mysqli, "INSERT INTO obat(nama_obat,kemasan,harga) 
                                            VALUES ( 
                                                '" . $_POST['nama_obat'] . "',
                                                '" . $_POST['kemasan'] . "',
                                                '" . $_POST['harga'] . "'
                                            )");
        }

        echo "<script> 
                document.location='index.php?page=obat';
                </script>";
    }

    if (isset($_GET['aksi'])) {
        if ($_GET['aksi'] == 'hapus') {
            $hapus = mysqli_query($mysqli, "DELETE FROM obat WHERE id = '" . $_GET['id'] . "'");
        }
        echo "<script> 
                document.location='index.php?page=obat';
                </script>";
    }
    ?>
</body>

