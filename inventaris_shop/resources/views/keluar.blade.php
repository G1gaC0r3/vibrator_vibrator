<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Website Inventaris</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">Inv<span class="logo1">entaris</span></div>
        <ul class="side-menu">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class='bx bxs-dashboard'></i>Stok Barang</a>
            </li>
            <li class="{{ request()->routeIs('masuk') ? 'active' : '' }}">
                <a href="{{ route('masuk') }}"><i class='bx bx-arrow-to-left'></i>Input Barang</a>
            </li>
            <li class="{{ request()->routeIs('keluar') ? 'active' : '' }}">
                <a href="{{ route('keluar') }}"><i class='bx bx-arrow-to-right'></i>Edit Barang</a>
            </li>
            <li class="{{ request()->routeIs('users') ? 'active' : '' }}">
                <a href="{{ route('users') }}"><i class='bx bx-group'></i>Users</a>
            </li>
        </ul>        
        <ul class="side-menu">
            <li>
                <div class="logout-container">
                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-link">
                            <i class='bx bx-log-out-circle'></i>
                            <span class="logout-text">Logout</span>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="profile">
                <img src="{{ asset($profilePicture) }}" alt="" id="navbar-profile-picture">
            </a>
            
        </nav>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Barang Keluar</h1>
                    
                </div>
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-arrow-to-right' style="color: rgb(24, 141, 180);"></i>
                    <span class="info">
                        <h3>
                            {{ $totalJumlah }}
                        </h3>
                        <p>Total Barang Masuk</p>
                    </span>
                </li>
                <li><i class='bx bx-arrow-to-left' style="color: rgb(207, 164, 10);"></i>
                    <span class="info">
                        <h3>
                            20
                        </h3>
                        <p>Total Barang Keluar</p>
                    </span>
                </li>
            </ul>
            <!-- End of Insights -->

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Daftar Barang</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" id="openModalButton">
                        Edit Barang
                      </button>
                      <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Gambar</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangs as $barang)
                                <tr>
                                    <td>{{ $barang->id_barang }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->jenis_barang }}</td>
                                    <td><img src="{{ asset('images/' . $barang->gambar_barang) }}" alt="{{ $barang->nama_barang }}" width="100"></td>
                                    <td>{{ $barang->jumlah_barang }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

               

            </div>

        </main>

    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Barang</h4>
              <!-- <button type="button" class="btn-close" id="closeModalButton">&times;</button> -->
            </div>
    
            <!-- Modal body -->
            <form action="" method="post">
                @csrf
              <div class="modal-body">
                <select name="Nama Barang" id="nama_barang" class="form-control">
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>
                <br>
                    <select name="jenis_barang" id="jenis_barang" class="form-control" required>
                        <option value="Pack">Pack</option>
                        <option value="Botol">Botol</option>
                        <option value="Kaleng">Kaleng</option>
                        <option value="Saset">Saset</option>
                    </select>
                <br>
                    <input type="number" name="jumlah_barang" placeholder="Jumlah" class="form-control" required>
                <br>
                <label for="gambar_barang">Change Image:</label>
                <input type="file" name="gambar_barang" id="gambar_barang" class="form-control">
                <br>
                <button type="submit" class="btn btn-primary" name="addnewbarang">Edit</button>
            </div>
            </form>
    
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-close" id="closeModalButton">Close</button>
            </div>
    
          </div>
        </div>
      </div>
    
      <script src="{{asset('js/index.js')}}"></script>
</body>

</html>