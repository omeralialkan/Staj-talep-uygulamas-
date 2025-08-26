@extends('admin.admin_master')
@section('admin')



<div class="container mt-5">
    <h4>Mesajlaşma</h4>

    <!-- Mesaj kutusu -->
    <div id="chat-box" style="height:400px; overflow-y:auto; border:1px solid #ccc; padding:10px; margin-bottom:10px; background-color:#f9f9f9;">
        @foreach($mesajlar as $m)
            <div style="margin-bottom:5px; padding:5px; border-radius:5px; background:#f1f1f1;">
                <!-- <b style="color: blue;">{{ $m->gonderen_id }}:</b> {{ $m->mesaj }} -->
                   <b style="color: {{ $m->gonderen_id == auth()->id() ? 'blue' : 'green' }};" >
                        {{ $m->gonderen->name ?? 'Bilinmeyen' }}:
                    </b> {{ $m->mesaj }}
            </div>
        @endforeach
    </div>

    <!-- Mesaj yazma alanı -->
    <div class="d-flex">
        <input type="text" id="user-message" class="form-control" placeholder="Mesaj yazın">
        <button id="send-message" class="btn btn-primary ms-2">Gönder</button>
    </div>

    <!-- Tüm Mesajları Sil butonu -->
    <button id="delete-all" class="btn btn-danger">Tüm Mesajları Sil</button>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function sendMessage() {
    let mesaj = $('#user-message').val();
    if(mesaj === '') return;

    $.post("{{ route('kategori.cevap.gonder') }}", { 
        mesaj: mesaj, 
        alici_id: {{ $id }}, 
        kategori_id: {{ $id }}, 
        _token: "{{ csrf_token() }}" 
    }, function(data) {
        $('#chat-box').append('<div style="margin-bottom:5px; padding:5px; border-radius:5px; background:#f1f1f1;"><b>'+data.gonderen_id+':</b> '+data.mesaj+'</div>');
        $('#user-message').val('');
        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
    });
}

// Gönder butonuna tıkla
$('#send-message').click(sendMessage);

// Enter tuşuna basınca da gönder
$('#user-message').keypress(function(e) {
    if(e.which == 13) sendMessage();
});

// Tüm Mesajları Sil
$('#delete-all').click(function() {
    if(!confirm('Tüm mesajları silmek istediğinizden emin misiniz?')) return;

    $.post("{{ route('kategori.cevap.sil', $id) }}", { _token: "{{ csrf_token() }}" }, function() {
        $('#chat-box').empty();
    });
});
</script>

<script>$('#chat-box').append('<div><b style="color:blue;">'+data.gonderen_name+':</b> '+data.mesaj+'</div>');

</script>

@endsection
