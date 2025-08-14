<x-dash_layout>
    <x-slot:title>dashboard</x-slot:title>
    @push('custom-css')
        <link rel="stylesheet" href="{{ asset('panel_assets/vendors/feather/feather.css') }}">
        <link rel="stylesheet" href="{{ asset('panel_assets/vendors/ti-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('panel_assets/vendors/css/vendor.bundle.base.css') }}}">
    @endpush
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-xl-8">
            <h3 class="fw-bold">Welcome {{ Auth::user()->name }}</h3>
            <h6 class="fw-normal">All systems are running smoothly! You have <span class="text-primary">3
                    unread alerts!</span></h6>
        </div>
        <div class="col-xl-4 text-end">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuDate"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-calendar"></i> Today (10 Jan 2021)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuDate">
                    <li><a class="dropdown-item" href="#">January - March</a></li>
                    <li><a class="dropdown-item" href="#">March - June</a></li>
                    <li><a class="dropdown-item" href="#">June - August</a></li>
                    <li><a class="dropdown-item" href="#">August - November</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <p>Today’s Bookings</p>
                    <h3>4006</h3>
                    <small>10.00% (30 days)</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <p>Total Bookings</p>
                    <h3>61344</h3>
                    <small>22.00% (30 days)</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <p>Number of Meetings</p>
                    <h3>34040</h3>
                    <small>2.00% (30 days)</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <p>Number of Clients</p>
                    <h3>47033</h3>
                    <small>0.22% (30 days)</small>
                </div>
            </div>
        </div>
    </div>

    <!-- To Do List -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">To Do List</h5>
                    <ul class="list-group list-group-flush">
                    </ul>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Notifications</h5>
                    <ul class="list-group list-group-flush">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @push('custom-js')
        <!-- Plugin js for this page -->
        <script src="{{ asset('panel_assets/vendors/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('panel_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('panel_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('panel_assets/js/dataTables.select.min.js') }}"></script>
        <!-- End plugin js for this page -->
        <!-- Custom js for this page-->
        <script src="{{ asset('panel_assets/js/dashboard.js') }}"></script>
        <script src="{{ asset('panel_assets/js/Chart.roundedBarCharts.js') }}"></script>
        <!-- End custom js for this page-->
    @endpush
</x-dash_layout>
