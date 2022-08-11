<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <title>Hasil Advokasi</title>
    </head>
    <body>
        <div class="container mt-5">
            <h1 class="text-center">Data Aspirasi</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Aspirasi</th>
                            <th scope="col">Advokasi</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Bidang</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTable">
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
        <script>
            $( document ).ready(function() {
                $.ajax({
                    url  : "./wsLaporanHasilAdvokasi.php",
                    data : "JSON",
                    success : function(res){
                        let hasil = $.parseJSON(res)
                        $('#bodyTable').empty();
                        let html = '';
                        let i = 1;
                        $.each(hasil.data, function(index, value){
                            html += `<tr>
                                        <td>${i}</td>
                                        <td>${value.nama_mahasiswa}</td>
                                        <td>${value.aspirasi}</td>`
                            if(value.advokasi != null){
                                html +=     `<td>${value.advokasi}</td>`
                            }else{
                                html +=     `<td>-</td>`
                            }
                            html +=    `<td>${value.nama_kategori}</td>
                                        <td>${value.bidang}</td>
                                        <td>${value.status}</td>
                                    </tr>`
                            i++
                        })
                        $('#bodyTable').append(html)
                    }
                });
            });
        </script>
        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
        -->
    </body>
</html>