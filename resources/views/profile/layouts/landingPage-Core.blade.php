@inject('request', 'Illuminate\Http\Request')

<!DOCTYPE html>
<html lang="zxx">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" href="{{asset('Logo UCC Transparan.png')}}">
    
        <title>UCC UNESA</title>
        
        <!-- All Plugins Css -->
        <link rel="stylesheet" href="{{asset('pmw/assets/css/plugins.css')}}">
        <link rel="stylesheet" href="{{asset('pmw/assets/css/nav.css')}}" >
        
    
        <!-- Custom CSS -->
        <link href="{{asset('pmw/assets/css/styles.css')}}" rel="stylesheet">
    
        <!-- Custom Color Option -->
        <link href="{{asset('pmw/assets/css/colors.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('pmw/css/blog.css')}}" >
         <link rel="stylesheet" href="{{asset('pmw/css/team.css')}}" >
         <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
         <link rel="stylesheet" href="{{asset('pmw/css/gallery.css')}}" >
         <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.9/css/jquery.orgchart.min.css">
         @stack('style')
    
    </head>
  
    <body class="blue2-skin">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="preloader"><div class="preloader"><span></span><span></span></div></div>
    
        <div id="main-wrapper">
    
            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
            <!-- Start Navigation -->

      <div class="header header-light nav-right-side">
        <nav class="headnavbar">
          <div class="nav-header">
            <a href="#"  class="brand normal-logo"><img style="margin-top: -7.5%" src="{{asset('Logo UCC Transparan.png')}}" alt="" /></a>
            <a href="#" class="brand brand-overlay"><img style="margin-top: -5%" src="{{asset('Logo UCC Transparan.png')}}" alt="" /></a>
            <button class="toggle-bar"><span class="ti-align-justify"></span></button>  
          </div>                
          <ul class="menu">
          
            <li >
              <a href="{{route('pmw')}}">Home</a>
            </li>
            
            <li class="dropdown">
              <a href="JavaScript:Void(0);">Tentang Kami</a>
              <ul class="dropdown-menu">
                <li>
                  <a href="{{route('visi-misi')}}">Visi Misi</a>                                
                </li>
                <li>
                  <a href="{{route('organisasi.index')}}">Struktur Organisasi</a>                                
                </li>
                <li>
                  <a href="{{route('programKerja.index')}}">Program Kerja</a>                                
                </li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="JavaScript:Void(0);">Divisi</a>
              <ul class="dropdown-menu">
                @foreach(\App\Divisi::orderBy('title', 'asc')->get() as $divisi)
                @if($divisi->orgs->count() > 0)
                <li class="dropdown">
                    <a href="JavaScript:Void(0);">{{$divisi->title}}</a>
                        <ul class="dropdown-menu">
                            @foreach($divisi->orgs as $divOrgs)
							    <li><a target="_blank" href="{{$divOrgs->link}}">{{$divOrgs->title}}</a></li>
							@endforeach
						</ul>
                </li>
                @else
                <li>
                    <a href="{{route('divisi.show', $divisi->slug)}}">{{$divisi->title}}</a>
                </li>
                @endif
                @endforeach
              </ul>
            </li>

            <li>
              <a href="{{route('gallery')}}">Dokumentasi</a>
            </li>

            <li>
              <a href="{{route('dokumen.index')}}">Dokumen</a>
            </li>
            
            <li>
              <a href="{{route('loker.index')}}">Lowongan</a>
            </li>
            
            <li>
              <a href="{{route('blog.index')}}">Event</a>
            </li>  
            
            {{-- <li><a href="#" data-toggle="modal" data-target="#signup">Sign Up</a></li>
          </ul>
            
          <ul class="attributes">
            <li class="login-attri"><a href="#" data-toggle="modal" data-target="#login">Log In</a></li>
          </ul> --}}
          
        </nav>
      </div>
      <div class="clearfix"></div>
      <!-- End Navigation -->

      <!-- ============================================================== -->
      <!-- Top header  -->
      <!-- ============================================================== -->
      
      @yield('content')
      
      <!-- ============================ Footer Start ================================== -->
      <footer class="dark-footer skin-dark-footer">
        <div>
          <div class="container">
            <div class="row">
              
              <div class="col-lg-4 col-md-6">
                <div class="footer-widget">
                  <iframe class="map" src="https://maps.google.com/maps?hl=en&amp;q=unesa job center+(Unesa Job Center)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" style="width: 95%; height: 225px;" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
              </div>    
             <div class="col-lg-4 col-md-6">
                <div class="footer-widget">
                  <h4 class="widget-title">About UCC</h4>
                  <p>Universitas Negeri Surabaya (Unesa) adalah perguruan tinggi negeri di Surabaya, Indonesia, yang berdiri pada 19 Desember 1964. Pada awal berdirinya, Unesa bernama Institut Keguruan dan Ilmu Pendidikan Surabaya (IKIP Surabaya).</p>
                  <a href="#" class="other-store-link">
                    <div class="other-store-app">
                      <div class="os-app-icon">
                        <i class="ti-android"></i>
                      </div>
                      <div class="os-app-caps">
                        Google Store
                      </div>
                    </div>
                  </a>
                </div>
              </div>    
                  
              <div class="col-lg-4 col-md-6">
                <div class="footer-widget">
                  <h4 class="widget-title">Get in Touch</h4>
                  <div class="fw-address-wrap">
                    <div class="fw fw-location">
                      Jl. Ketintang No.2, Ketintang, Gayungan, Surabaya
                    </div>
                    <div class="fw fw-mail">
                      ucc@unesa.ac.id
                    </div>
                    <div class="fw fw-call">
                      <a href="https://wa.me/628175072161?text=Tulis Pesan ke Admin UCC" target="_blank">+62 817 5072 161</a>
                    </div>
                    <div class="fw fw-instagram" >
                      <a href="#">@ucc.unesa</a>
                    </div>
                    <div class="fw fw-web">
                      <a href="http://ucc.unesa.ac.id/">ucc.unesa.ac.id</a>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        
        <div class="footer-bottom">
          <div class="container">
            <div class="row align-items-center">
              
              <div class="col-lg-12 col-md-12 text-center">
                <p class="mb-0">© 2019 UCC. Designd By <a href="#">Informatika UNESA</a> All Rights Reserved</p>
              </div>
              
            </div>
          </div>
        </div>
      </footer>
      <!-- ============================ Footer End ================================== -->
      
      <!-- Log In Modal -->
      <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
          <div class="modal-content" id="registermodal">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
              <h4 class="modal-header-title">Log In</h4>
              <div class="login-form">
                <form>
                
                  <div class="form-group">
                    <label>User Name</label>
                    <div class="input-with-icon">
                      <input type="text" class="form-control" placeholder="Username">
                      <i class="ti-user"></i>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label>Password</label>
                    <div class="input-with-icon">
                      <input type="password" class="form-control" placeholder="*******">
                      <i class="ti-unlock"></i>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-md full-width pop-login">Login</button>
                  </div>
                
                </form>
              </div>
              <div class="modal-divider"><span>Or login via</span></div>
              <div class="social-login mb-3">
                <ul>
                  <li><a href="#" class="btn connect-fb"><i class="ti-facebook"></i>Facebook</a></li>
                  <li><a href="#" class="btn connect-twitter"><i class="ti-twitter"></i>Twitter</a></li>
                </ul>
              </div>
              <div class="text-center">
                <p class="mt-5"><a href="#" class="link">Forgot password?</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal -->
      
      <!-- Sign Up Modal -->
      <div class="modal fade signup" id="signup" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
          <div class="modal-content" id="sign-up">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
              <h4 class="modal-header-title">Sign Up</h4>
              <section style="margin-top: -9%;">
                <div class="container">
                
                  <!-- row Start -->
                  <div class="row align-items-center">

                    <div class="col-lg-6 col-md-6">
                      <img src="{{ asset('pmw/assets/img/sb.png')}}" class="img-fluid" alt="" />
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <div class="story-wrap explore-content">
                        
                        <h2>Login PMW</h2>
                        
                      </div>
                    </div>
                    
                  </div>
                  <!-- /row -->         
                  
                </div>            
              </section>

      <div class="clearfix"></div>

              <section style="margin-top: -17.5%;">
                <div class="container">
                
                  <!-- row Start -->
                  <div class="row align-items-center">

                    <div class="col-lg-6 col-md-6">
                      <div class="story-wrap explore-content">
                        
                        <h2>Login PMW</h2>
                        
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <img src="{{ asset('pmw/assets/img/sb.png')}}" class="img-fluid" alt="" />
                    </div>
                    
                  </div>
                  <!-- /row -->         
                  
                </div>            
              </section>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal -->
      
      <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
      

    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('pmw/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('pmw/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('pmw/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('pmw/assets/js/rangeslider.js')}}"></script>
    <script src="{{asset('pmw/assets/js/select2.min.js')}}"></script>
    <script src="{{asset('pmw/assets/js/aos.js')}}"></script>
    <script src="{{asset('pmw/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('pmw/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('pmw/assets/js/slick.js')}}"></script>
    <script src="{{asset('pmw/assets/js/slider-bg.js')}}"></script>
    <script src="{{asset('pmw/assets/js/lightbox.js')}}"></script> 
    <script src="{{asset('pmw/assets/js/imagesloaded.js')}}"></script>
    <script src="{{asset('pmw/assets/js/isotope.min.js')}}"></script>
    <script src="{{asset('pmw/assets/js/coreNavigation.js')}}"></script>
    <script src="{{asset('pmw/assets/js/custom.js')}}"></script>

    <!-- ============================================================== -->

    <script type="text/javascript">
     $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 4,
        nav: true,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 3
          },
          1000: {
            items: 3
          }
        }
      });

      var topItem = 0,
        leftItem = 0,
        popupHeight = 600;

      $(".owl-carousel .item").on("click", function(e) {
        var $this = $(this),
          $parent = $this.parents(".owl-carousel-wrap"),
          content = $this.html(),
          $popup = $parent.find(".popup");

        topItem = $this.offset().top - $parent.offset().top + $this.height() / 2;
        leftItem = $this.offset().left - $parent.offset().left + $this.width() / 2;

        $popup.css({
          top: topItem,
          left: leftItem,
          width: 0,
          height: 0
        });

        $popup.html(content).stop().animate(
          {
            top: -((popupHeight - $this.parent().outerHeight()) / 2),
            left: 0,
            width: "100%",
            height: popupHeight,
            opacity: 1
          },
          400
        );
      });

      $(".popup").on("click", function(e) {
        $(this).stop().animate(
          {
            width: 0,
            height: 0,
            top: topItem,
            left: leftItem,
            opacity: 0
          },
          400
        );
      });

    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
      $('.owl-carousel').owlCarousel({
        loop : true
      });

      $().fancybox({
        selector : '.owl-item:not(.cloned) a',
        hash   : false,
        thumbs : {
          autoStart : true
        },
        buttons : [
          'zoom',
          'download',
          'close'
        ]
      });

      $(document).ready(function() {
        $(".fancybox").fancybox({
          openEffect  : 'none',
          closeEffect : 'none'
        });
      });
    </script>

    <script type="text/javascript">
      var demoTrigger = document.querySelector('.demo-trigger');

      new Drift(demoTrigger, {
        paneContainer: document.querySelector('.detail'),
        inlinePane: 900,
        inlineOffsetY: -85,
        containInline: true,
        sourceAttribute: 'href'
      });

      new Luminous(demoTrigger);
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gojs/2.1.9/go.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.9/js/jquery.orgchart.min.js"></script>
    @yield('javascript')

    <script type="text/javascript">
        ( function( window ) {
          if( Modernizr.touch ) {

            function classReg( className ) {
              return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
            }

            var hasClass, addClass, removeClass;

            if ( 'classList' in document.documentElement ) {
              hasClass = function( elem, c ) {
                return elem.classList.contains( c );
              };
              addClass = function( elem, c ) {
                elem.classList.add( c );
              };
              removeClass = function( elem, c ) {
                elem.classList.remove( c );
              };
            }
            else {
              hasClass = function( elem, c ) {
                return classReg( c ).test( elem.className );
              };
              addClass = function( elem, c ) {
                if ( !hasClass( elem, c ) ) {
                    elem.className = elem.className + ' ' + c;
                }
              };
              removeClass = function( elem, c ) {
                elem.className = elem.className.replace( classReg( c ), ' ' );
              };
            }

            function toggleClass( elem, c ) {
              var fn = hasClass( elem, c ) ? removeClass : addClass;
              fn( elem, c );
            }

            var classie = {
              // full names
              hasClass: hasClass,
              addClass: addClass,
              removeClass: removeClass,
              toggleClass: toggleClass,
              // short names
              has: hasClass,
              add: addClass,
              remove: removeClass,
              toggle: toggleClass
            };

            // transport
            if ( typeof define === 'function' && define.amd ) {
              // AMD
              define( classie );
            } else {
              // browser global
              window.classie = classie;
            }

            [].slice.call( document.querySelectorAll( '.team-grid__member' ) ).forEach( function( el, i ) {
              el.querySelector( '.member__info' ).addEventListener( 'touchstart', function(e) {
                e.stopPropagation();
              }, false );
              el.addEventListener( 'touchstart', function(e) {
                classie.toggle( this, 'cs-hover' );
              }, false );
            } );

          }

        })( window );

    </script>

    
    
  </body>
</html>