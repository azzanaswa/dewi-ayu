<!-- Start header -->
    <header class="top-header">
        <div class="header_top">
            
            <div class="container">
                <div class="row">
                    <div class="logo_section">
                        <a class="navbar-brand" href="index.html"><img src="{{asset('projek/images/logo_header.png')}}" alt="image"></a>
                    </div>
                    <div class="site_information">
                        <ul>
                           <li><a href="mailto:exchang@gmail.com"><img src="{{asset('projek/images/mail_icon.png')}}" alt="#" />pmw_unesa@gmail.com</a></li>
                            <li><a href="tel:exchang@gmail.com"><img src="{{asset('projek/images/phone_icon.png')}}" alt="#" />08123456789</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        
        </div>
        <div class="header_bottom">
          <div class="container">
            <div class="col-sm-12">
                <div class="menu_orange_section" style="background: #ff880e;">
                   <nav class="navbar header-nav navbar-expand-lg"> 
                     <div class="menu_section">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                      <li><a class="nav-link" href="{{route('home')}}">Home</a></li>
                        <li><a class="nav-link" href="#">Siskama</a></li>
                        <li><a class="nav-link" href="{{route('pengumuman')}}">Pengumuman</a></li>
                        <li><a class="nav-link" href="{{route('panduan')}}">Panduan</a></li>
                        <li><a class="nav-link" href="{{route('galeri')}}">Gallery</a></li>
                        <li><a class="nav-link" href="{{route('kontak')}}">Contact</a></li>
                    </ul>
                </div>
                     </div>
                 </nav>
                </div>
            </div>
          </div>
        </div>
        
    </header>