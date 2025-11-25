<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="dark" data-bs-theme="light">

<head>
    @include('layouts.partials/title-meta', ['title' => $title])
    @include('layouts.partials/head-css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    @include('layouts.partials/topbar')
    @include('layouts.partials/startbar')

    <div class="page-wrapper">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>

            @include('layouts.partials/endbar')
            @include('layouts.partials/footer')
        </div>
    </div>


    @include('layouts.partials/footer-scripts')
    @include('sweetalert::alert')
</body>

</html>
