<!-- Favicon -->
<link rel="icon" href="" type="image/x-icon" />
<!-- Fonts and icons -->
<script src="{{ asset('backend/assets/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["{{ asset('backend/assets/css/fonts.min.css') }}"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>
<link rel="stylesheet" href="{{ asset('backend/assets/css/kaiadmin.min.css') }}" />

{{-- Boxicons CDN Link --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" />
{{-- FontAwesome 6 CDN LINK --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
{{-- Bootstrap Icons --}}
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />

{{-- CSS LINKS  --}}
@stack('css_links')

@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<style>
    .main-header .btn.btn-toggle.toggle-sidebar,
    .main-header .btn.btn-toggle.sidenav-toggler,
    .main-header .topbar-toggler.more {
        padding: 10px 5px !important;
    }

    .dropdown-menu .dropdown-menu {
        display: none;
        position: absolute;
        right: 100%;
        top: 0;
        margin-left: 0.1rem;
    }

    .dropdown-menu .dropdown:hover>.dropdown-menu {
        display: block;
    }

    .dropdown i.setting {
        color: #2d2d2d;
        transition: all 0.5s linear;
    }

    .dropdown i.setting:hover {
        transform: rotate(90deg) !important;
        color: #007bff;
    }
</style>

{{-- Custom CSS   --}}
@stack('css')
