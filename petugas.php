<?php 
if (!isset($_GET['aksi'])){
?>
    <div class="container-fluid px-4">
                <h1 class="mt-4">Data petugas</h1>                      
                <div class="card mb-4">
                    <div class="card-header">
                        <a type="button" class="btn btn-primary" href="index.php?page=petugas&aksi=tambah">Tambah petugas</a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>id_petugas</th>
                                    <th>nama_petugas</th>
                                    <th>username</th>
                                    <th>password</th>
                                    <th>telp</th>
                                    <th>level</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $petugas=mysqli_query($koneksi, "SELECT * FROM petugas");
                            $no = 1;
                            while ($data = mysqli_fetch_array($petugas)){
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data['id_petugas']; ?></td>
                                    <td><?php echo $data['nama_petugas']; ?></td>
                                    <td><?php echo $data['username']; ?></td>
                                    <td><?php echo $data['password']; ?></td>
                                    <td><?php echo $data['telp']; ?></td>
                                    <td><?php echo $data['level']; ?></td>
                                    <td><a href="index.php?page=petugas&aksi=edit&id=<?php echo $data['id_petugas'] ?>">Edit</a> | 
                                        <a href="index.php?page=petugas&aksi=hapus&id=<?php echo $data['id_petugas'] ?>">Hapus</a></td>
                                </tr>
                            <?php
                            $no++;
                            }
                            ?>   
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>    
<?php
}elseif ($_GET['aksi']=='tambah'){     
?>
<div class="container-fluid px-4">
                <h1 class="mt-4">Data petugas</h1>                      
                <div class="card mb-4 col-md-8">
                    <div class="card-header">
                       <h5> Tambah petugas </h5>
                    </div>
                    <div class="card-body">
                        <form action=''  method="POST" enctype='multipart/form-data'>                        
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="a">
                                    <label>id_petugas</label>                                
                                </div>                            
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="b">
                                    <label>nama_petugas</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="c">
                                    <label>username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="d">
                                    <label>password</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="file" name="e">
                                    <label>telp</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="file" name="e">
                                    <label>level</label>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-block" type="submit" name="simpan">Simpan</button>
                                </div>
                        </form>
                    </div>
                </div>
</div>

<?php
if (isset($_POST['simpan'])){
    $dir_foto = 'foto/';
    $filename = basename($_FILES['e']['name']);
    $uploadfile = $dir_foto . $filename;
        if ($filename != ''){
            if (move_uploaded_file($_FILES['e']['tmp_name'], $uploadfile)) {            
                mysqli_query($koneksi,"INSERT INTO petugas (ip_petugas, nama_petugas, username, password, telp, level)           
                                VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]',");
                
                echo "<script>window.alert('Sukses Menambahkan Data petugas.');
                        window.location='petugas'</script>";
            }else{
                echo "<script>window.alert('Gagal Menambahkan Data petugas.');
                        window.location='index.php?page=petugas&aksi=tambah'</script>";
            }
        }else{
                mysqli_query($koneksi,"INSERT INTO petugas (nis, nama_petugas, jenis_kelamin, alamat)           
                VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]')");
                               
                echo "<script>window.alert('Sukses Menambahkan Data petugas .');
                        window.location='petugas'</script>";
        }
}
}elseif ($_GET['aksi']=='edit'){
    $petugas = mysqli_query($koneksi, "SELECT * FROM petugas where id_petugas='$_GET[id]'");
    $data = mysqli_fetch_array($petugas);       
?>
<div class="container-fluid px-4">
                <h1 class="mt-4">Data petugas</h1>                      
                <div class="card mb-4 col-md-8">
                    <div class="card-header">
                       <h5> Update petugas </h5>
                    </div>
                    <div class="card-body">
                        <form action=''  method="POST" enctype='multipart/form-data'>      
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="a" value="<?php echo $data['id_petugas']; ?>">
                                <label>id_petugas</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="b" value="<?php echo $data['nama']; ?>">
                                <label>nama_petugas</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="c" value="<?php echo $data['username']; ?>">
                                <label>username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="d" value="<?php echo $data['password']; ?>">
                                <label>password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="file" name="e"> value="<?php echo $data['telp']; ?>">
                                <label>telp</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="file" name="e"> value="<?php echo $data['telp']; ?>">
                                <label>level</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-block" type="submit" name="update">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
</div>
<?php
if (isset($_POST['update'])){
    $dir_foto = 'foto/';
    $filename = basename($_FILES['e']['name']);
    $uploadfile = $dir_foto . $filename;
        if ($filename != ''){
            if (move_uploaded_file($_FILES['e']['tmp_name'], $uploadfile)) {            
                mysqli_query($koneksi,"UPDATE petugas SET id_petugas             = '$_POST[a]',
                                                        nama_petugas      = '$_POST[b]',
                                                        username   = '$_POST[c]',
                                                        password          = '$_POST[d]',
                                                        telp          = '$_POST[e]' 
                                                        level          = '$_POST[f]' ");           
                echo "<script>window.alert('Sukses Update Data petugas.');
                        window.location='petugas'</script>";
            }else{
                echo "<script>window.alert('Gagal Update Data petugas.');
                        window.location='index.php?page=petugas&aksi=tambah'</script>";
            }
        }else{
                mysqli_query($koneksi,"UPDATE petugas SET id_petugas            = '$_POST[a]',
                                                        nama_petugas      = '$_POST[b]',
                                                        username   = '$_POST[c]',
                                                        password          = '$_POST[d]',
                                                        telp     = '$_POST[e]'  
                                                        level     = '$_POST[f]' ");                           
                echo "<script>window.alert('Sukses Update Data petugas .');
                        window.location='petugas'</script>";
        }
}
}elseif ($_GET['aksi']=='hapus'){ 
	mysqli_query($koneksi, "DELETE FROM petugas where id_petugas='$_GET[id]'");
	echo "<script>window.alert('Data petugas Berhasil Di Hapus.');
                                window.location='petugas'</script>";
}
?>