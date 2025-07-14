      <div class="container d-flex justify-content-center" data-aos="fade-up">
        <div class="card" style="width: 20rem;">
            <div class="card-header" style="background-color: #71c55d" align="center">
                <b>{{ Auth::user()->name}}</b>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Email : {{ Auth::user()->email}}</li>
                <li class="list-group-item">Jumlah Uang : Rp. {{ number_format($jumlahUang, '0', '.', '.') }}</li>
            </ul>
        </div>
      </div>