@extends('admin.admin_master')

@section('admin')

@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp

@if($user)
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Gelen Taleplerim</h4>

                        <table class="table table-bordered dt-responsive nowrap" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>İd</th>
                                    <th>Kategori Adı</th>
                                    <th>Talep Eden</th>
                                    <th>Açıklama</th>
                                    <th>Durum</th>
                                    <th>Resim</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @forelse($talepler as $talep)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $talep->kategori_adi }}</td>
                                    <td>{{ $talep->talep_eden }}</td>
                                    <td style="white-space:normal; word-wrap:break-word;">{{ $talep->aciklama }}</td>
                                    <td>{{ $talep->durum }}</td>
                                    <td>
                                        <img src="{{ (!empty($talep->resim)) ? url($talep->resim) : url('upload/resim-yok.png') }}" style="height:50px;width:50px;">
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Gelen talep bulunamadı</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endif

@endsection
