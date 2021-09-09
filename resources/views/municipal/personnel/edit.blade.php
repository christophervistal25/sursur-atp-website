@extends('municipal.layouts.app')
@section('page-small-title','Personnel')
@section('page-title','Edit ' .  $person->firstname . ' Record')
@section('content')
@include('templates.error')
@if(Session::has('success'))
    <div class="card bg-success text-white shadow mb-1">
        <div class="card-body">
                {{ Session::get('success') }} <a target="_blank" href="{{ asset('/storage/qr_images/' . session()->pull('edit_qr_name')) }}" class="font-weight-bold text-white">Click to preview QR Code.</a>
        </div>
    </div>
@endif
<div class="card shadow">
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data" action="{{ route('municipal-personnel.update', $person->id) }}" >
          @csrf
          @method('PUT')
        <div class="form-group">
          <label for="firstname">Firstname</label>
          <input type="text" class="form-control {{ $errors->has('firstname')  ? 'is-invalid' : ''}}" id="firstname" name="firstname" placeholder="Enter Firstname" value="{{ $person->firstname ?? old('firstname') }}">
          @if($errors->has('firstname'))
            <small  class="form-text text-danger">
                {{ $errors->first('firstname') }} </small>
         @endif
         
        </div>

        <div class="form-group">
            <label for="middlename">Middlename</label>
            <input type="text" class="form-control {{ $errors->has('middlename')  ? 'is-invalid' : ''}} " id="middlename" name="middlename" placeholder="Enter Middlename" value="{{ $person->middlename ?? old('middlename') }}">
            @if($errors->has('middlename'))
            <small  class="form-text text-danger">
                {{ $errors->first('middlename') }} </small>
         @endif
        </div>

        <div class="form-group">
            <label for="lastname">Lastname</label>
            <input type="text" class="form-control {{ $errors->has('lastname')  ? 'is-invalid' : ''}}" id="lastname" name="lastname" placeholder="Enter Lastname" value="{{ $person->lastname ?? old('lastname') }}">

            @if($errors->has('lastname'))
                <small  class="form-text text-danger">
                {{ $errors->first('lastname') }} </small>
            @endif
        </div>

        <div class="form-group">
            <label for="suffix">Suffix</label>
            <input type="text" class="form-control {{ $errors->has('suffix')  ? 'is-invalid' : ''}}" id="suffix" name="suffix" placeholder="e.g Jr." value="{{ $person->suffix ?? old('suffix') }}">
            @if($errors->has('suffix'))
                <small  class="form-text text-danger">
                {{ $errors->first('suffix') }} </small>
            @endif
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control {{ $errors->has('address')  ? 'is-invalid' : ''}}" rows="3">{{ $person->address ?? old('address') }}</textarea>
            @if($errors->has('address'))
                <small  class="form-text text-danger">
                {{ $errors->first('address') }} </small>
            @endif
        </div>

        <hr>

        <div class="form-group">
            <div class="row">
                <div class="col-lg-12">
                    <label for="barangay">Barangay</label>
                    <select  name="barangay" id="barangays" class="form-control">
                        @foreach($barangays as $barangay)
                            @if(old('barangay'))
                                <option {{ old('barangay') == $barangay->id ? 'selected' : '' }} value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                            @else
                                <option {{ $person->barangay_id == $barangay->id ? 'selected' : '' }} value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                            @endif
                            
                        @endforeach
                    </select>
                </div>
            </div>
            
         
        </div>

        <hr>

        <div class="form-group">
            <div class="row">
                <div class="col-lg-6">
                    <label for="date_of_birth">Date of birth</label>
                    <input type="date" class="form-control  {{ $errors->has('date_of_birth')  ? 'is-invalid' : ''}}" id="date_of_birth" name="date_of_birth" value="{{ $person->date_of_birth ?? old('date_of_birth') }}">
                    @if($errors->has('date_of_birth'))
                        <small  class="form-text text-danger">
                        {{ $errors->first('date_of_birth') }} </small>
                    @endif
                </div>

                <div class="col-lg-6">
                    <label for="rapid_test_issued">Rapid test issued</label>
                    <input type="date" class="form-control {{ $errors->has('rapid_test_issued')  ? 'is-invalid' : ''}}" id="rapid_test_issued" name="rapid_test_issued"  value="{{ $person->rapid_test_issued ?? old('rapid_test_issued') }}">
                    @if($errors->has('rapid_test_issued'))
                        <small  class="form-text text-danger">
                        {{ $errors->first('rapid_test_issued') }} </small>
                    @endif
                </div>
            </div>
        </div>

        <hr>

        <div class="float-right">
            <button type="submit" class="btn btn-success">Update Record</button>
        </div>

        <div class="clearfix"></div>
      </form>
    </div>
  </div>
@endsection