@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
    <main>
        <div class="container-fluid p-4">
            <div class="row">
                <!-- Card Surat Masuk -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg h-100 border-0"
                        style="background: linear-gradient(145deg, #5a9ef0, #387ab5); transition: all 0.3s; color: white;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="card-title text-white"><b>Total Surat Masuk</b></h3>
                            </div>
                            <div class="d-flex justify-content-start gap-3 align-items-center">
                                <i class="bi bi-box-arrow-in-left fs-1"></i>
                                <h4 class="card-text display-4 font-weight-bold">10</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Surat Keluar -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg h-100 border-0"
                        style="background: linear-gradient(145deg, #76c7c0, #4e9b94); transition: all 0.3s; color: white;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="card-title text-white"><b>Total Surat Keluar</b></h3>
                            </div>
                            <div class="d-flex justify-content-start gap-3 align-items-center">
                                <i class="bi bi-box-arrow-in-right fs-1"></i>
                                <h5 class="card-text display-4 font-weight-bold">12</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
