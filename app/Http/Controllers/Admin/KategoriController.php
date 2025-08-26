<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\kategoriler;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Mesaj;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Carbon;

class KategoriController extends Controller
{
    public function KategoriHepsi(){
        $kategorihepsi = kategoriler::latest()->get();
        return view('admin.kategoriler.kategoriler_hepsi',compact('kategorihepsi'));
    }//fonksyon biit

    public function KategoriGonderilen()
{
    $user = Auth::user();
    $kategorigonderilen = Kategoriler::where('talep_eden', $user->name)->get();

    return view('admin.kategoriler.kategori_gonderilen', compact('kategorigonderilen'));
}

    public function KategoriEkle(){
        return view('admin.kategoriler.kategori_ekle');
    }///bitti fonk

    public function KategoriEkleForm(Request $request){
       
        $request->validate([
            'kategori_adi' => 'required',
        ],[
            'kategori_adi.required' => 'kategori adı boş  olamaz'
        ]);

        if($request->file('resim')){
            $resim = $request->file('resim');
            $resimadi = hexdec(uniqid()).'.'.$resim->getClientOriginalExtension();

            // Image::make($resim)->resize(700,400)->save("upload/kategoriler/".$resimadi);
                   // resimi public/upload/kategoriler içine kaydet
            $resim->move(public_path('upload/kategoriler'), $resimadi);
            $resim_kaydet = "upload/kategoriler/".$resimadi;

            kategoriler::insert([
                'kategori_adi' => $request->kategori_adi,
                'kategori_url' => str()->slug($request->kategori_adi),
                'talep_eden' => $request->talep_eden,
                'anahtar' => $request->anahtar,
                'aciklama' => $request->aciklama,
                'durum' => $request->durum,
                'resim' => $resim_kaydet,
                'created_at' => Carbon::now()
            ]);

       //bildirim
            $mesaj = array(
                "bildirim" =>"resim ile yükleme başarılı",
                "alert-type " => "success"
            );
            //bildirim

            return Redirect()->route('kategori.gonderilen')->with($mesaj);
        } //endif
        else{
            kategoriler::insert([
                'kategori_adi' => $request->kategori_adi,
                'kategori_url' => str()->slug($request->kategori_adi),
                'talep_eden' => $request->talep_eden,
                'anahtar' => $request->anahtar,
                'aciklama' => $request->aciklama,
                'created_at' => Carbon::now()
                
            ]);

       //bildirim
            $mesaj = array(
                "bildirim" =>"resimsiz ile yükleme başarılı",
                "alert-type " => "success"
            );
            //bildirim

            return Redirect()->route('kategori.gonderilen')->with($mesaj);

        }//endelse
    }

    //mesaj kısmı
    public function KategoriCevap($id)
    {
        $mesajlar = Mesaj::where('alici_id', $id)
                        ->orWhere('gonderen_id', $id)
                        ->orderBy('created_at', 'asc')
                        ->get();

        return view('admin.kategoriler.kategori_cevap', compact('mesajlar', 'id'));
    }

    public function KategoriCevapGonder(Request $request)
    {
        $mesaj = new Mesaj();
        $mesaj->gonderen_id = auth()->id(); 
        $mesaj->alici_id = $request->alici_id;
        $mesaj->mesaj = $request->mesaj;
        $mesaj->kategori_id = $request->kategori_id;
        $mesaj->save();

        return response()->json([
            'mesaj' => $mesaj->mesaj,
            'gonderen_id' => $mesaj->gonderen_id,
            'gonderen_name' => auth()->user()->name, // ← burası eklendi
        ]);
    }

    public function KategoriCevapSil($id)
    {
        Mesaj::where('kategori_id', $id)->delete();
        return response()->json(['success' => true]);
    }
    





    public function KategoriDuzenle($id){
        $KategoriDuzenle = kategoriler::findOrFail($id);
        return view('admin.kategoriler.kategori_duzenle' , compact('KategoriDuzenle'));
    }

        public function KategoriGuncelleForm(Request $request){
       
        $request->validate([
            'kategori_adi' => 'required',
        ],[
            'kategori_adi.required' => 'kategori adı boş  olamaz'
        ]);

        $kategori_id = $request->id;
        $eski_resim = $request->onceki_resim;


        if($request->file('resim')){
            $resim = $request->file('resim');
            $resimadi = hexdec(uniqid()).'.'.$resim->getClientOriginalExtension();

            // Image::make($resim)->resize(700,400)->save("upload/kategoriler/".$resimadi);
                    // resimi public/upload/kategoriler içine kaydet
            $resim->move(public_path('upload/kategoriler'), $resimadi);
            $resim_kaydet = "upload/kategoriler/".$resimadi;
            
            //eski resim sil
            if(file_exists($eski_resim))
            {
                unlink($eski_resim);
            }

            //eski resim sil
            kategoriler::findOrFail($kategori_id)->update([
                'kategori_adi' => $request->kategori_adi,
                'kategori_url' => str()->slug($request->kategori_adi),
                'talep_eden' => $request->talep_eden,
                'anahtar' => $request->anahtar,
                'aciklama' => $request->aciklama,
                'resim' => $resim_kaydet,
            ]);

       //bildirim
            $mesaj = array(
                "bildirim" =>"resim ile güncelleme başarılı",
                "alert-type " => "success"
            );
            //bildirim

            return Redirect()->route('kategori.hepsi')->with($mesaj);
        } //endif
        else{
            kategoriler::findOrFail($kategori_id)->update([
                'kategori_adi' => $request->kategori_adi,
                'kategori_url' => str()->slug($request->kategori_adi),
                'talep_eden' => $request->talep_eden,
                'anahtar' => $request->anahtar,
                'aciklama' => $request->aciklama,
                'created_at' => Carbon::now()
                
            ]);

       //bildirim
            $mesaj = array(
                "bildirim" =>"resimsiz  güncelleme başarılı",
                "alert-type " => "success"
            );
            //bildirim

            return Redirect()->route('kategori.hepsi')->with($mesaj);

        }//endelse
    }

    public function KategoriSil($id) {

        $kategori_id = kategoriler::findOrFail($id);
        //klasorden resimi siler
        $resim = $kategori_id->resim;
        
    // Dosyanın var olup olmadığını kontrol ediyoruz
        if (file_exists($resim)) {
            unlink($resim);
        }
         //klasorden resimi siler
        //veri tabanından
        kategoriler::findOrFail($id)->delete();

            $mesaj = array(
                "bildirim" =>"silme başarılı",
                "alert-type " => "success"
            );
            //bildirim

            return Redirect()->back()->with($mesaj);
    }//fonk bitti

    public function durumGuncelle(Request $request, $id)
    {
        $kategori = Kategoriler::findOrFail($id);
        $kategori->durum = $request->durum;
        $kategori->save();

        return response()->json(['success' => true]);
    }
    // public function yonlendir(Request $request, $id)
    // {
    //     $talep = Kategoriler::findOrFail($id);
    //     $talep->yonlendirilen_id = $request->yonlendirilen_id;
    //     $talep->save();

    //     return response()->json(['success' => true]);
    // }
    // public function gelenTalepler()
    // {
    //     $talepler = Kategoriler::where('yonlendirilen_id', Auth::id())->get();
    //     return view('admin.kategoriler.kategori_gelen', compact('talepler'));
    // }




} // class bitti
    

