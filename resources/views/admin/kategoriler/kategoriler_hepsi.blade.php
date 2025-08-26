@extends('admin.admin_master')

@section('admin')

    @php
        use Illuminate\Support\Facades\Auth;
        $user = Auth::user(); // Login olan kullanıcı
    @endphp

                @if($user && $user->role == 'admin')
                    <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">İstek Ve Talepler Tablosu</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- kategori seçme alanı -->
                        <div class="mb-3">
                            <label class="form-label"><b>Kategori Seç:</b></label><br>
                            @if($user &&  $user->name === 'gizem...' )
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kategori" value="hepsi" id="kategoriHepsi" >
                                    <label class="form-check-label" for="kategoriHepsi">Hepsi</label>
                                </div>
                            @endif

                            @if($user && $user->name === 'ismail_kara'|| $user->name === 'gizem...' )
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kategori" value="web" id="kategoriWeb">
                                    <label class="form-check-label" for="kategoriWeb">Web</label>
                                </div>
                            @endif

                            @if($user && $user->name === 'emre' || $user->name === 'gizem...')
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kategori" value="firma" id="kategoriFirma">
                                <label class="form-check-label" for="kategoriFirma">Firma</label>
                            </div>
                            @endif

                            @if($user && $user->name === 'ahmet' || $user->name === 'gizem...')
                            <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kategori" id="kategoriMusteri" value="Müşteri" required>
                                        <label class="form-check-label" for="kategoriMusteri">Müşteri</label>
                            </div>
                            @endif
                        </div>


                        <!-- İçerik Alanları -->
                        <div id="icerik-web" style="display:none;" class="alert alert-info mt-3">
                            <h5>Web İçeriği</h5>
                            <p>Bu bölümde <b>Web</b> içeriği görmektesiniz.</p>
                        </div>

                        <div id="icerik-firma" style="display:none;" class="alert alert-success mt-3">
                            <h5>Firma İçeriği</h5>
                            <p>Bu bölümde <b>Firma</b> içeriği görmektesiniz.</p>
                        </div>

                        <div id="icerik-musteri" style="display:none;" class="alert alert-warning mt-3">
                            <h5>Müşteri İçeriği</h5>
                            <p>Bu bölümde <b>Müşteri</b> içerğini görmektesiniz.</p>
                        </div>

                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">İstek Ve Talepler </h4>
                                        <p class="card-title-desc"> Tüm Talepler Tablosu
                                        </p>
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="max-width: 20px;">İd</th>
                                                    <th style="max-width:80px;">Kategori Adı</th>
                                                    <th  style="max-width:80px;">Talep Eden</th>
                                                    <th>Açıklama</th>
                                                    <th style="max-width: 35px;">Resim</th>
                                                    <!-- <th>Yönlendir</th> -->
                                                    <th>Durum</th>
                                                    <th style="max-width: 55px;">Mesaj Gönder</th>
                                                    <th>İşlem</th>

                                                </tr>
                                            </thead>
        
        
                                            <tbody id="talepler-body">
                                                @php
                                                    ($s = 1);
                                                @endphp
                                                @if($kategorihepsi && $kategorihepsi->count() > 0)
                                                
                                                    @foreach ($kategorihepsi as $kategoriler)
                                                       
                                                            <tr data-kategori="{{ $kategoriler->kategori_adi }}">
                                                                <td style="max-width: 20px;"> {{ $s++ }}  </td>
                                                                <td style="max-width: 40px;">{{ $kategoriler->kategori_adi}}</td>
                                                                <td>{{ $kategoriler->talep_eden ?? 'Bilinmiyor' }}</td>
                                                                <td style="max-width:300px; white-space:normal; word-wrap:break-word;">
                                                                    {{ $kategoriler->aciklama }}
                                                                </td>
                                                                 <td style="max-width: 35px;"> <img src="{{ (!empty($kategoriler->resim)) ? url($kategoriler->resim) : url('upload/resim-yok.png') }}" style="height: 50px; width: 50px;"></td>
                                                            
                                                                
                                                               <!-- <td>
                                                                    <select class="form-select yonlendir" data-talep-id="{{ $kategoriler->id }}">
                                                                        <option value="">Seçiniz</option>
                                                                        @foreach(\App\Models\User::all() as $user)
                                                                            <option value="{{ $user->id }}" {{ $kategoriler->yonlendirilen_id == $user->id ? 'selected' : '' }}>
                                                                                {{ $user->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>   
                                                                </td> -->


                                                                <td> 
                                                                    <div class="d-flex align-items-center justify-content-between">
                                                                        <span id="durum-text-{{ $kategoriler->id }}">
                                                                            {!! nl2br(e($kategoriler->durum)) !!}
                                                                        </span>
                                                                        <button class="btn btn-sm btn-secondary ms-2 durum-btn" data-id="{{ $kategoriler->id }}">
                                                                            <i class="fas fa-sync-alt"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                                <td style="max-width: 55px;">
                                                                    <a href=" {{ route('kategori.cevap',$kategoriler->id)}}" class="btn btn-primary sm m-2" title="Mesaj Gönder">
                                                                        <i class="fas fa-envelope"></i>
                                                                    </a></td>
                                                                <td style="max-width: 50px;">
                                                                    <a href=" {{ route('kategori.duzenle',$kategoriler->id)}}" class="btn btn-info sm m-2" title="Düzenle">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <a href="{{ route('kategori.sil',$kategoriler->id) }}" class="btn btn-danger sm m-2" title="sil">
                                                                        <i class=" fa fa-trash-alt"></i>
                                                                    </a>
                                                                </td>

                                                            </tr>

                                                    @endforeach     
                                                @else
                                                    <tr>
                                                        <td colspan="6" style="text-align:center;">Kayıt bulunamadı</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        

                        
                    </div> <!-- container-fluid -->
                </div>
                @else
                    <div class="alert alert-danger text-center mt-5">
                        Bu sayfaya erişim yetkiniz yok!
                    </div>
                @endif


                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const rows = document.querySelectorAll('#talepler-body tr');

                    document.querySelectorAll('input[name="kategori"]').forEach(radio => {
                        radio.addEventListener('change', function() {
                            const secilenKategori = this.value.toLowerCase();

                            rows.forEach(row => {
                                const rowKategori = row.getAttribute('data-kategori').toLowerCase();

                                if(secilenKategori === 'hepsi' || rowKategori === secilenKategori){
                                    row.style.display = '';
                                } else {
                                    row.style.display = 'none';
                                }
                            });
                        });
                    });
                });
                </script>
                <!-- <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const durumlar = [
                            "İletildi 📩<br>Beklemede 🕒",
                            "İşleme Alındı ⚙️",
                            "Çözüldü ✅"
                        ];

                        document.querySelectorAll(".durum-btn").forEach(btn => {
                            btn.addEventListener("click", function () {
                                const id = this.getAttribute("data-id");
                                const textEl = document.getElementById("durum-text-" + id);

                                // mevcut indexi bul
                                let current = durumlar.findIndex(d => d === textEl.innerHTML);
                                if (current === -1) current = 0;

                                // sıradaki değeri al
                                let next = (current + 1) % durumlar.length;
                                textEl.innerHTML = durumlar[next];

                                // burada istersen Ajax ile DB'ye kaydetme de yapılır
                                // fetch("/durum-guncelle/"+id, {
                                //     method: "POST",
                                //     headers: {
                                //         "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                //         "Content-Type": "application/json"
                                //     },
                                //     body: JSON.stringify({durum: durumlar[next]})
                                // });
                            });
                        });
                    });
                </script>

 -->
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const durumlar = [
                            "İletildi 📩\nBeklemede 🕒",
                            "İşleme Alındı ⚙️",
                            "Çözüldü ✅"
                        ];

                        document.querySelectorAll(".durum-btn").forEach(btn => {
                            btn.addEventListener("click", function () {
                                const id = this.getAttribute("data-id");
                                const textEl = document.getElementById("durum-text-" + id);

                                // mevcut indexi bul
                                let current = durumlar.findIndex(d => d.replace(/\n/g, "<br>") === textEl.innerHTML.trim());
                                if (current === -1) current = 0;

                                // sıradaki değeri bul
                                let next = (current + 1) % durumlar.length;
                                let newDurum = durumlar[next];

                                // ekranda güncelle
                                textEl.innerHTML = newDurum.replace(/\n/g, "<br>");

                                // Ajax ile DB'ye kaydet
                                fetch("{{ url('/kategori/durum-guncelle') }}/" + id, {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify({ durum: newDurum })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        console.log("Durum güncellendi:", newDurum);
                                    }
                                });
                            });
                        });
                    });
                </script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <!-- <script>
                $(document).ready(function(){
                    $('.yonlendir').change(function(){
                        var talepId = $(this).data('talep-id');
                        var userId = $(this).val();

                        $.ajax({
                            url: '/kategori/yonlendir/' + talepId,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                yonlendirilen_id: userId
                            },
                            success: function(response){
                                alert('Talep başarıyla yönlendirildi!');
                            },
                            error: function(){
                                alert('Hata oluştu!');
                            }
                        });
                    });
                });
                </script> -->
                <!-- <script>
                    $(document).ready(function(){
                    $('.yonlendir').change(function(){
                        var talepId = $(this).data('talep-id'); // id'yi al
                        var userId = $(this).val();

                        if(!talepId){
                            alert('Talep ID bulunamadı!');
                            return;
                        }

                        $.ajax({
                            url: '/kategori/yonlendir/' + talepId,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                yonlendirilen_id: userId
                            },
                            success: function(response){
                                if(response.success){
                                    alert('Talep başarıyla yönlendirildi!');
                                }
                            },
                            error: function(xhr, status, error){
                                console.error(xhr.responseText);
                                alert('Hata oluştu!');
                            }
                        });
                    });
                });
                </script>



 <!-     
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                $(document).ready(function(){
                    $('.yonlendir').change(function(){
                        var talepId = $(this).data('talep-id');
                        var userId = $(this).val();

                        if(!talepId){
                            alert('Talep ID bulunamadı!');
                            return;
                        }

                        $.ajax({
                            url: '/kategori/yonlendir/' + talepId,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                yonlendirilen_id: userId
                            },
                            success: function(response){
                                if(response.success){
                                    alert('Talep başarıyla yönlendirildi!');
                                }
                            },
                            error: function(xhr, status, error){
                                console.error(xhr.responseText);
                                alert('Hata oluştu!');
                            }
                        });
                    });
                });
                </script> -->
                <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        const rows = document.querySelectorAll('#talepler-body tr');

                        // Sayfa açılır açılmaz tüm satırları gizle
                        rows.forEach(row => row.style.display = 'none');

            
                    });

                </script>


@endsection