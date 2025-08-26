@extends('admin.admin_master')

@section('admin')



                    <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Gönderilen Talepler</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- kategori seçme alanı -->
                        <div class="mb-3">
                            <label class="form-label"><b>Kategori Seç:</b></label><br>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kategori" value="hepsi" id="kategoriHepsi" checked>
                                <label class="form-check-label" for="kategoriHepsi">Hepsi</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kategori" value="web" id="kategoriWeb">
                                <label class="form-check-label" for="kategoriWeb">Web</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kategori" value="firma" id="kategoriFirma">
                                <label class="form-check-label" for="kategoriFirma">Firma</label>
                            </div>

                            <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kategori" id="kategoriMusteri" value="Müşteri" required>
                                        <label class="form-check-label" for="kategoriMusteri">Müşteri</label>
                            </div>
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
                                        <p class="card-title-desc"> Gönderilen Talepler Tablosu
                                        </p>
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="max-width: 20px;">İd</th>
                                                    <th style="max-width:80px;">Kategori Adı</th>
                                                    <th  style="max-width:80px;">Talep Eden</th>
                                                    <th>Açıklama</th>
                                                    <th style="max-width: 35px;">Resim</th>
                                                    <th>Durum</th>
                                                    <th style="max-width: 55px;">Mesaj Gönder</th>
                                                        <th>İşlem</th>

                                                </tr>
                                            </thead>
        
        
                                            <tbody id="talepler-body">
                                                @php
                                                    ($s = 1);
                                                @endphp
                                                @if($kategorigonderilen && $kategorigonderilen->count() > 0)
                                                
                                                    @foreach ($kategorigonderilen as $kategoriler)
                                                        <tr data-kategori="{{ $kategoriler->kategori_adi }}">
                                                            <td style="max-width: 20px;"> {{ $s++ }}  </td>
                                                            <td style="max-width: 40px;">{{ $kategoriler->kategori_adi}}</td>
                                                            <td>{{ $kategoriler->talep_eden ?? 'Bilinmiyor' }}</td>
                                                            <td style="max-width:300px; white-space:normal; word-wrap:break-word;">
                                                                {{ $kategoriler->aciklama }}
                                                            </td>
                                                            <td style="max-width: 35px;"> <img src="{{ (!empty($kategoriler->resim)) ? url($kategoriler->resim) : url('upload/resim-yok.png') }}" style="height: 50px; width: 50px;"></td>
                                                            <td> {{ $kategoriler->durum }}</td>
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


@endsection