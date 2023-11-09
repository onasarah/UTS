<?php 
if (!isset($_GET['aksi'])){
?>
    <div class="container-fluid px-4">
                <h1 class="mt-4">Data peminjaman</h1>                      
                <div class="card mb-4">
                    <div class="card-header">
                        <a type="button" class="btn btn-primary" href="index.php?page=peminjaman&aksi=tambah">Tambah peminjaman</a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>id_peminjaman</th>
                                    <th>kode_buku</th>
                                    <th>id_anggota</th>
                                    <th>id_petugas</th>
                                    <th>tgl_pinjam</th>
                                    <th>tgl_kembali</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $peminjaman=mysqli_query($koneksi, "SELECT * FROM peminjaman");
                            $no = 1;
                            while ($data = mysqli_fetch_array($peminjaman)){
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data['id_peminjaman']; ?></td>
                                    <td><?php echo $data['kode_buku']; ?></td>
                                    <td><?php echo $data['id_anggota']; ?></td>
                                    <td><?php echo $data['id_petugas']; ?></td>
                                    <td><?php echo $data['tgl_pinjam']; ?></td>
                                    <td><?php echo $data['tgl_kembali']; ?></td>
                                    <td><?php echo $data['status']; ?></td>
                                    <td><a href="index.php?page=peminjaman&aksi=edit&id=<?php echo $data['id_peminjaman'] ?>">Edit</a> | 
                                        <a href="index.php?page=peminjaman&aksi=hapus&id=<?php echo $data['id_peminjaman'] ?>">Hapus</a></td>
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
                <h1 class="mt-4">Data peminjaman</h1>                      
                <div class="card mb-4 col-md-8">
                    <div class="card-header">
                       <h5> Tambah peminjaman </h5>
                    </div>
                    <div class="card-body">
                        <form action=''  method="POST" enctype='multipart/form-data'>                        
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="a">
                                    <label>id_peminjaman</label>                                
                                </div>                            
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="b">
                                    <label>kode_buku</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="c">
                                    <label>id_anggota</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="d">
                                    <label>id_petugas</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="file" name="e">
                                    <label>tgl_pinjam</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="file" name="e">
                                    <label>tgl_kembali</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="file" name="e">
                                    <label>status</label>
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
                mysqli_query($koneksi,"INSERT INTO peminjaman (ip_peminjamn, kode_buku, id_anggota, id_petugas, tgl_pinjam, tgl_kembali, status)           
                                VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]',");
                
                echo "<script>window.alert('Sukses Menambahkan Data peminjaman.');
                        window.location='peminjaman'</script>";
            }else{
                echo "<script>window.alert('Gagal Menambahkan Data peminjaman.');
                        window.location='index.php?page=peminjaman&aksi=tambah'</script>";
            }
        }else{
                mysqli_query($koneksi,"INSERT INTO peminjaman (id_peminjaman, kode_buku, id_anggota, id_petugas, tgl_pinjamn, tgl_kembali, status)           
                VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]')");
                               
                echo "<script>window.alert('Sukses Menambahkan Data peminjaman .');
                        window.location='peminjaman'</script>";
        }
}
}elseif ($_GET['aksi']=='edit'){
    $peminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman where id_peminjaman='$_GET[id]'");
    $data = mysqli_fetch_array($peminjaman);       
?>
<div class="container-fluid px-4">
                <h1 class="mt-4">Data peminjaman</h1>                      
                <div class="card mb-4 col-md-8">
                    <div class="card-header">
                       <h5> Update peminjaman </h5>
                    </div>
                    <div class="card-body">
                        <form action=''  method="POST" enctype='multipart/form-data'>      
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="a" value="<?php echo $data['id_peminjaman']; ?>">
                                <label>id_peminjaman</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="b" value="<?php echo $data['kode_buku']; ?>">
                                <label>kode_buku</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="c" value="<?php echo $data['id_anggota']; ?>">
                                <label>id_anggota</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="d" value="<?php echo $data['id_petugas']; ?>">
                                <label>id_petugas</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="file" name="e"> value="<?php echo $data['tgl_pinjam']; ?>">
                                <label>tgl_pinjam</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="file" name="e"> value="<?php echo $data['tgl_kembali']; ?>">
                                <label>tgl_kembali</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="file" name="e"> value="<?php echo $data['status']; ?>">
                                <label>status</label>
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
                mysqli_query($koneksi,"UPDATE peminjaman SET id_peminjaman             = '$_POST[a]',
                                                        kode_buku      = '$_POST[b]',
                                                        id_anggota   = '$_POST[c]',
                                                        id_petugas          = '$_POST[d]',
                                                        tgl_pinjam          = '$_POST[e]' 
                                                        tgl_kembali         = '$_POST[f]'  
                                                        status         = '$_POST[g]' ");          
                echo "<script>window.alert('Sukses Update Data peminjaman.');
                        window.location='peminjaman'</script>";
            }else{
                echo "<script>window.alert('Gagal Update Data peminjaman.');
                        window.location='index.php?page=peminjaman&aksi=tambah'</script>";
            }
        }else{
                mysqli_query($koneksi,"UPDATE peminjaman SET id_peminjaman            = '$_POST[a]',
                                                        kode_buku      = '$_POST[b]',
                                                        id_anggota  = '$_POST[c]',
                                                        id_petugas          = '$_POST[d]',
                                                        tgl_pinjam   = '$_POST[e]'  
                                                        tgl_kembali   = '$_POST[f]'  
                                                        status   = '$_POST[g]' ");                          
                echo "<script>window.alert('Sukses Update Data peminjaman .');
                        window.location='peminjaman'</script>";
        }
}
}elseif ($_GET['aksi']=='hapus'){ 
	mysqli_query($koneksi, "DELETE FROM peminjaman where id_peminjaman='$_GET[id]'");
	echo "<script>window.alert('Data peminjaman Berhasil Di Hapus.');
                                window.location='peminjaman'</script>";
}
?>