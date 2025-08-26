@extends('admin.admin_master')

@section('admin')

<script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 


<div class="page-content">
    <div class="container-fluid"></div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Talep Ekle</h4>




                        <form method="POST" action="{{ route('kategori.ekle.form') }}"  enctype="multipart/form-data" id="myForm">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Talep Eden</label>
                                <div class="col-sm-10 form-group">
                                    <input type="text" class="form-control" name="talep_eden" 
                                        value="{{ auth()->user()->name }}" readonly>
                                </div>
                            </div>

            
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kategori Adı</label>
                                <div class="col-sm-10 form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kategori_adi" id="kategoriWeb" value="Web" required>
                                        <label class="form-check-label" for="kategoriWeb">Web</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kategori_adi" id="kategoriFirma" value="Firma" required>
                                        <label class="form-check-label" for="kategoriFirma">Firma</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kategori_adi" id="kategoriMusteri" value="Müşteri" required>
                                        <label class="form-check-label" for="kategoriMusteri">Müşteri</label>
                                    </div>

                                    @error('kategori_adi')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Anahtar</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="text" placeholder="Anahtar" name="anahtar"  >
                                    @error('kategori_adi')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Açıklama</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="text" placeholder="Açıklama" name="aciklama"  >
                                </div>
                            </div>

                                                <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2">Resim</label>
                                <div class="col-sm-10 form-group">
                                    <input type="file" name="resim" id="resim" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" src="{{ url('upload/resim-yok.png') }}" alt="" id="resimGoster">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Kategori Ekle">

                        </form>


                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#resim').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#resimGoster').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


<!-- //boş olamaz no refresh -->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules:
            {
                kategori_adi:
                {
                    required : true,
                },
 
                anahtar:
                {
                    required : true,
                },
                

                aciklama:
                {
                    required : true,
                },
                

            },//end rules

            messages:
            {
                kategori_adi:
                {
                    required : 'kategori_adi giriniz',
                },

                anahtar:
                {
                    required : 'anahtar giriniz',
                },

                aciklama:
                {
                    required : 'aciklama giriniz',
                },

             
            },//end


            errorElement : 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },

            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },

            unhighlight : function(element, errorClass, validClass){
                $(element). removeClass('is-invalid');
            },

        });

    });
</script>
<!-- // bos olamaz nono refresh -->
@endsection