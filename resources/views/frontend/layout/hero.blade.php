<!-- Hero Start -->

@if (request()->routeIs('home*'))

<div class="container-fluid py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-7">
                        <h4 class="mb-3 text-secondary">Timeless Watches</h4>
                        <h1 class="mb-5 display-3 text-primary">Precision & Style on Your Wrist</h1>
                    </div>
                </div>
            </div>
        </div>

    @else

        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">@yield('title')</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active text-white">@yield('title')</li>
            </ol>
        </div>

    @endif



<!-- Hero End -->
