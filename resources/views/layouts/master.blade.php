<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
    @include('includes.css')
</head>

<body>

    {{-- @include('includes.navbar') --}}
    <div class="container-fluid">
        <div class="row flex-nowrap">

            @include('includes.sidebar')

            <div class="col py-3">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->


    {{-- @include('includes.footer') --}}


</body>
<!-- END: Body-->
@include('includes.js')

</html>
