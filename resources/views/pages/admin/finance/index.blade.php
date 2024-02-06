@php
    // $isNavbar = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Pembayaran SPP')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
{{-- <script src="{{asset('assets/js/dashboards-students.js')}}"></script> --}}
@endsection

@section('content')
<!-- Tabel Pembayaran SPP Siswa -->
<div class="card">
  <div class="row p-2 align-items-center">
    <h5 class="card-header w-auto">Pembayaran SPP</h5>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#finance-create-modal">
      Tambah Pembayaran SPP
    </button>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="finance-create-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="{{route('school.payment.create')}}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pembayaran SPP</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @isset($allStudent)
            <div class="row">
                <div class="col mb-3">
                  <label for="student" class="form-label">Nama Siswa</label>
                  <input class="form-control" list="student-list" id="student" name="student" placeholder="Cari Siswa...">
                  <datalist id="student-list">
                    @foreach ($allStudent as $student)
                        <option value="{{ "$student->name - $student->id" }}"></option>
                    @endforeach
                  </datalist>
                  <x-input-error :messages="$errors->get('student')" class="mt-2" />
                </div>
              </div>
            @endisset
            <div class="row">
              <div class="col mb-3">
                <label class="form-label" for="nominal">Total Bayar</label>
                <input type="number" id="nominal" name="nominal" class="form-control" value="{{old('nominal')}}" placeholder="Rp. 1.000.000">
                <x-input-error :messages="$errors->get('nominal')" class="mt-2" />
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
          <th>Total Bayar</th>
          <th>Action</th>
        </tr>
      </thead>
      @isset($students)
        <tbody class="table-border-bottom-0">
            @foreach ($students as $student)
                @foreach ($student->finances as $finance)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ 'Rp. ' . number_format($finance->nominal,0,',','.') }}</td>
                        <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                            <form action="{{route('school.payment.delete', ['finance' => $finance->id])}}" method="POST">
                                @csrf
                                @method('delete')
                                <a class="dropdown-item" href="{{route('school.payment.delete', ['finance' => $finance->id])}}" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                <i class="bx bx-trash me-2"></i> Delete
                                </a>
                            </form>
                            </div>
                        </div>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
      @endisset
    </table>
  </div>
</div>
@endsection
