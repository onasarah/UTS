<?php
if (!isset($_GET['aksi'])) {
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Perpustakaan</h1>
        <div class="card mb-4">
            <div class="card-header">
                <a type="button" class="btn btn-primary" href="index.php?page=buku&aksi=tambah">Tambah Buku</a>
                <a type="button" class="btn btn-success" href="index.php?page=siswa&aksi=tambah">Tambah Siswa</a>
            </div>
            <div class="card-body">
                <h2>Data Buku</h2>
                <table id="datatablesBuku">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $buku = mysqli_query($koneksi, "SELECT * FROM buku");
                        $no = 1;
                        while ($data = mysqli_fetch_array($buku)) {
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['judul_buku']; ?></td>
                                <td><?php echo $data['pengarang']; ?></td>
                                <td><?php echo $data['penerbit']; ?></td>
                                <td><?php echo $data['tahun_terbit']; ?></td>
                                <td>
                                    <a href="index.php?page=buku&aksi=edit&id=<?php echo $data['id_buku'] ?>">Edit</a> |
                                    <a href="index.php?page=buku&aksi=hapus&id=<?php echo $data['id_buku'] ?>">Hapus</a>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>

                <h2>Data Siswa</h2>
                <table id="datatablesSiswa">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $siswa = mysqli_query($koneksi, "SELECT * FROM siswa");
                        $no = 1;
                        while ($data = mysqli_fetch_array($siswa)) {
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['nis']; ?></td>
                                <td><?php echo $data['nama_siswa']; ?></td>
                                <td><?php echo $data['jenis_kelamin']; ?></td>
                                <td><?php echo $data['alamat']; ?></td>
                                <td>
                                    <a href="index.php?page=siswa&aksi=edit&id=<?php echo $data['id_siswa'] ?>">Edit</a> |
                                    <a href="index.php?page=siswa&aksi=hapus&id=<?php echo $data['id_siswa'] ?>">Hapus</a>
                                </td>
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
} elseif ($_GET['aksi'] == 'tambah') {
    if ($_GET['page'] == 'buku') {
        // Tampilkan formulir tambah buku
        ?>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Perpustakaan</h1>
            <div class="card mb-4 col-md-8">
                <div class="card-header">
                    <h5> Tambah Buku </h5>
                </div>
                <div class="card-body">
                    <form action='' method="POST">
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" name="judul_buku" required>
                            <label>Judul Buku</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" name="pengarang" required>
                            <label>Pengarang</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" name="penerbit" required>
                            <label>Penerbit</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" name="tahun_terbit" required>
                            <label>Tahun Terbit</label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-block" type="submit" name="simpanBuku">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['simpanBuku'])) {
            // Proses penyimpanan data buku ke database
            mysqli_query($koneksi, "INSERT INTO buku (judul_buku, pengarang, penerbit, tahun_terbit)
                                    VALUES ('$_POST[judul_buku]', '$_POST[pengarang]', '$_POST[penerbit]', '$_POST[tahun_terbit]')");

            echo "<script>window.alert('Sukses Menambahkan Data Buku.');
                            window.location='buku'</script>";
        }
    } elseif ($_GET['page'] == 'siswa') {
        // Tampilkan formulir tambah siswa
        ?>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Perpustakaan</h1>
            <div class="card mb-4 col-md-8">
                <div class="card-header">
                    <h5> Tambah Siswa </h5>
                </div>
                <div class="card-body">
                    <form action='' method="POST">
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" name="nis" required>
                            <label>NIS</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" name="nama_siswa" required>
                            <label>Nama Siswa</label>
                        </div>
                        <div class="form-floating mb-