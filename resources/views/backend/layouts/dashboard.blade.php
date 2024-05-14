@extends('backend.app')

@section('title', 'Dashboard')

@section('content')
    {{--  ========== title-wrapper start ==========  --}}
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>Dashboard</h2>
                </div>
            </div>

            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav>
                        <ol class="base-breadcrumb breadcrumb-three">
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a8 8 0 1 0 4.596 14.104A5.934 5.934 0 0 1 8 13a5.934 5.934 0 0 1-4.596-2.104A7.98 7.98 0 0 0 8 0zm-2 3a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm-1.465 5.682A3.976 3.976 0 0 0 4 9c0 1.044.324 2.01.882 2.818a6 6 0 1 1 6.236 0A3.975 3.975 0 0 0 12 9a3.976 3.976 0 0 0-.536-1.318l-1.898.633-.018-.056 2.194-.732a4 4 0 1 0-7.6 0l2.194.733-.018.056-1.898-.634z" />
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li class="active"><span><i class="lni lni-angle-double-right"></i></span>Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{--  ========== title-wrapper end ==========  --}}



    <div class="row">
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon purple">
                    <i class="lni lni-cart-full"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">New Orders</h6>
                    <h3 class="text-bold mb-10">34567</h3>
                    <p class="text-sm text-success">
                        <i class="lni lni-arrow-up"></i> +2.00%
                        <span class="text-gray">(30 days)</span>
                    </p>
                </div>
            </div>
            <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon success">
                    <i class="lni lni-dollar"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Total Income</h6>
                    <h3 class="text-bold mb-10">$74,567</h3>
                    <p class="text-sm text-success">
                        <i class="lni lni-arrow-up"></i> +5.45%
                        <span class="text-gray">Increased</span>
                    </p>
                </div>
            </div>
            <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon primary">
                    <i class="lni lni-credit-cards"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Total Expense</h6>
                    <h3 class="text-bold mb-10">$24,567</h3>
                    <p class="text-sm text-danger">
                        <i class="lni lni-arrow-down"></i> -2.00%
                        <span class="text-gray">Expense</span>
                    </p>
                </div>
            </div>
            <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon orange">
                    <i class="lni lni-user"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">New User</h6>
                    <h3 class="text-bold mb-10">34567</h3>
                    <p class="text-sm text-danger">
                        <i class="lni lni-arrow-down"></i> -25.00%
                        <span class="text-gray"> Earning</span>
                    </p>
                </div>
            </div>
            <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
    </div>
@endsection
