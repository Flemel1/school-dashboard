{{-- @php
$isMenu = false;
$navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Without menu - Layouts')

@section('content')

<!-- Layout Demo -->
<div class="layout-demo-wrapper">
  <div class="layout-demo-placeholder">
    <img src="{{asset('assets/img/layouts/layout-without-menu-light.png')}}" class="img-fluid" alt="Layout without menu">
  </div>
  <div class="layout-demo-info">
    <h4>Layout without Menu (Navigation)</h4>
    <button class="btn btn-primary" type="button" onclick="history.back()">Go Back</button>
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
<script src="{{asset('assets/js/dashboards-students.js')}}"></script>
@endsection

@section('content')
<div class="row">
  {{-- Diagram Nilai UTS --}}
  <div class="col-lg-6 col-md-4 order-0 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="row row-bordered g-0">
              <div class="col-md-12">
                <h5 class="card-header m-0 me-2 pb-3">Perbandingan Nilai UTS Siswa</h5>
                <div id="midExamStudentChart" class="px-2"></div>
              </div>
            </div>
      </div>
    </div>
  </div>
  {{-- Diagram Nilai UAS --}}
  <div class="col-lg-6 col-md-4 order-0  mb-4">
        <div class="card">
          <div class="card-body">
            <div class="row row-bordered g-0">
              <div class="col-md-12">
                <h5 class="card-header m-0 me-2 pb-3">Perbandingan Nilai UAS Siswa</h5>
                <div id="lastExamStudentChart" class="px-2"></div>
              </div>
            </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-md-6 order-1 mb-4">
    <div class="card">
      <h5 class="card-header m-0 me-2 pb-3">Kehadiran Siswa</h5>
      <div id="presenceChart"></div>
    </div>
  </div>
</div>
<!-- Tabel Daftar Siswa -->
<div class="card">
  <div class="row p-2 align-items-center">
    <h5 class="card-header w-auto">Daftar Siswa</h5>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#student-create-modal">
      Tambah Siswa
    </button>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="student-create-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="{{route('student.create')}}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Siswa</h5>
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
            <div class="row">
              <div class="col mb-3">
                <label class="form-label" for="grade">Kelas</label>
                <select id="grade" name="grade" class="form-select color-dropdown">
                  <option value="10" selected>10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}" placeholder="xxxx@xxx.xx">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
              </div>
            </div>
            <div class="row">
              <label for="password" class="form-label">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
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
          <th>Kelas</th>
          <th>Action</th>
        </tr>
      </thead>
      @isset($students)
        <tbody class="table-border-bottom-0">
            @foreach ($students as $student)
            <tr>
              <td>{{ $student->name }}</td>
              <td>{{ $student->grade }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                    <form action="{{route('student.delete', ['student' => $student->id])}}" method="POST">
                      @csrf
                      @method('delete')
                      <a class="dropdown-item" href="{{route('student.delete', ['student' => $student->id])}}" onclick="event.preventDefault();
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
