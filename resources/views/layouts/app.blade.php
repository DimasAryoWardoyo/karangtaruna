<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Marketplace modern dan responsif" />
    <meta name="author" content="Dimas Wardoyo" />

    <title>@yield('title')</title>

    {{-- Style --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')

</head>

{{-- Navbar --}}
@include('includes.navbar')

{{-- content --}}
@yield('content')

{{-- Footer --}}
@include('includes.footer')

<!-- Bootstrap core JavaScript -->


{{-- Script --}}
@stack('prepend-script')
@include('includes.script')
@stack('addon-script')

</body>

</html>