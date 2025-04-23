{{-- Boxicons CDN Link --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" />
{{-- FontAwesome 6 CDN LINK --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

{{-- CSS Links --}}
@stack('css-links')

{{-- Vite CSS --}}
@vite(['resources/css/app.css'])

{{-- Custom CSS --}}
@stack('css')
