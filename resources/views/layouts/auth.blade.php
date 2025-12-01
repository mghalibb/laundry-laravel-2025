<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="dark" data-bs-theme="light">

<head>
    @include('layouts.partials/title-meta', ['title' => $title])
    @include('layouts.partials/head-css')
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container-xxl">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mx-auto">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials/footer-scripts')
    @yield('script-bottom')
</body>

</html>
