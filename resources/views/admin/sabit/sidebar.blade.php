<div class="vertical-menu">

                <div data-simplebar class="h-100">

                 

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menü </li>

                            <li>
                                <a href="{{ url('/dashboard') }}" class="waves-effect">
                                    <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                                    <span>Anasayfa</span>
                                </a>
                            </li>

                
                      


                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-layout-3-line"></i>
                                    <span>İstek Ve Talepler</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="true">

                                    <li>
                                            <li><a href=" {{ route('kategori.hepsi')}}">İstek Ve Talepler</a></li>
                                            <li><a href="{{ route('kategori.ekle')}}">İstek Veya Talep Ekle</a></li>
                                            <li><a href="{{ route('kategori.gonderilen')}}">Gönderdiğim Talepler</a></li>
                                            <!-- @if(Route::currentRouteName() == 'kategori.hepsi' && isset($kategoriler))
                                                <li><a href="{{ route('kategori.yonlendir', $kategoriler->id) }}">Yönlendir</a></li>
                                            @endif -->
                                            <!-- <li><a href="{{ route('kategori.gelen')}}">Gelen Talepler</a></li> -->



                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>