<header class="transparent header-light header-float">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header-inner">
                            <div class="de-flex">
                                <div class="de-flex-col">
                                    <!-- logo begin -->
                                    <div id="logo">
                                        <a href="index.html">
                                            <img class="logo-main" src="{{ image('opera.png') }}" alt="" >
                                            <img class="logo-scroll" src="{{ image('opera.png') }}" alt="" >
                                            <img class="logo-mobile" src="{{ image('opera.png') }}" alt="" >
                                        </a>
                                    </div>
                                    <!-- logo close -->
                                </div>

                                <div class="de-flex-col">
                                    <div class="de-flex-col header-col-mid">
                                        <ul id="mainmenu">
                                            @if(isset($asesor) && isset($client))
                                            <li><a class="menu-item" href="#" style="color: #bb9269 !important;">Asesor</a>{{ $asesor }}</li>
                                            <li><a class="menu-item"  href="#" style="color: #bb9269 !important;">Cliente</a>{{ $client }}</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                                <div class="de-flex-col">
                                    @if(!empty($menu))
                                    <a class="btn-main fx-slide w-100" href="{{ route('client-login') }}"><span>Cambiar Cliente</span></a>
                                    @endif
                                    <div class="menu_side_area">
                                        <span id="menu-btn"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section id="section-hero" class="text-light no-top no-bottom relative overflow-hidden z-1000">
            <div class="abs w-100 abs-centered z-2">
                <div class="container">
                    <div class="spacer-double"></div>

                    <div class="row g-4 align-items-center justify-content-between">
                        <div class="col-md-6">
                            <h1 class="mb-0">Materializamos con Armonía y Belleza Extraordinaria</h1><br>

                            <p class="wow fadeInUp" data-wow-delay=".6s"><b>ÓPERA</b> es el vertical living que representa la mejor oportunidad para quienes buscan invertir en una vida con mayor exclusividad, lujo y grandes vistas, aquellos que persiguen un estilo de vida contemporáneo viviendo en lo más alto.</p>
                            
                            <p class="wow fadeInUp" data-wow-delay=".8s">UN DESARROLLO CON GRAN CALIDAD ESPACIAL, FUNCIONALIDAD EN CADA CENTÍMETRO DENTRO DE UNA GRAN CONCEPTO ARQUITECTÓNICO.</p>
                        </div>

                        <div class="col-lg-4">
                            @if(!empty($menu) || !empty($is_open))
                            <a class="btn-main btn-line bg-blur fx-slide" href="{{ empty($is_open) ? route('disponibilidad') : route('open') }}">
                                <span>Disponibilidad</span>
                            </a>&nbsp;
                            <a class="btn-main btn-line bg-blur fx-slide" href="{{ empty($is_open) ? route('torre') : route('listado')  }}">
                                <span>Listado</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="vertical-center">
                <div class="swiper">
                  <!-- Additional required wrapper -->
                  <div class="swiper-wrapper">
                    @for($i = 1; $i <= 9; $i++)
                    <div class="swiper-slide">
                        <div class="swiper-inner" data-bgimage="url({{ image('/Carrusel/0'.$i.'.jpg') }})">
                            <div class="sw-overlay op-4"></div>
                        </div>
                    </div>
                    @endfor
                    
                      
                  </div>
                  
                </div>
            </div>
        </section>