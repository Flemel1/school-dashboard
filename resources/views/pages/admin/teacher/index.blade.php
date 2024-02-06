{{-- @php
$isNavbar = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Without navbar - Layouts')

@section('content')

<!-- Layout Demo -->
<div class="layout-demo-wrapper">
  <div class="layout-demo-placeholder">
    <img src="{{asset('assets/img/layouts/layout-without-navbar-light.png')}}" class="img-fluid" alt="Layout without navbar">
  </div>
  <div class="layout-demo-info">
    <h4>Layout without Navbar</h4>
    <p>Layout does not contain Navbar component.</p>
  </div>
</div>
<!--/ Layout Demo -->

@endsection --}}
@php
    // $isNavbar = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Siswa')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-teachers.js')}}"></script>
@endsection

@section('content')
<div class="row">
  {{-- Diagram Nilai UTS --}}
  <div class="col-lg-6 col-md-4 order-0 mb-4">
    <div class="card">
      <h5 class="card-header m-0 me-2 pb-3">Kehadiran Guru</h5>
      <div id="teacherPresenceChart"></div>
    </div>
  </div>
  {{-- Diagram Nilai UAS --}}
  <div class="col-lg-6 col-md-4 order-0  mb-4">
    <div class="card">
      <h5 class="card-header m-0 me-2 pb-3">Tingkat Kepuasan Siswa Terhadap Guru</h5>
      <div id="teacherSatisfiedChart"></div>
    </div>
  </div>
</div>
<!-- Tabel Daftar Guru -->
<div class="card">
  <div class="row p-2 align-items-center">
    <h5 class="card-header w-auto">Daftar Guru</h5>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#teacher-create-modal">
      Tambah Guru
    </button>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="teacher-create-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="{{route('school.teacher.create')}}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Guru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Masukkan Nama">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Action</th>
        </tr>
      </thead>
      @isset($teachers)
        <tbody class="table-border-bottom-0">
            @foreach ($teachers as $teacher)
            <tr>
              <td>{{ $teacher->name }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                    <form action="{{route('school.teacher.delete', ['teacher' => $teacher->id])}}" method="POST">
                      @csrf
                      @method('delete')
                      <a class="dropdown-item" href="{{route('school.teacher.delete', ['teacher' => $teacher->id])}}" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                        <i class="bx bx-trash me-2"></i> Delete
                      </a>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
        </tbody>
      @endisset
    </table>
  </div>
</div>
@endsection