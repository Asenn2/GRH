@extends('layout')
@section('title','Login')
@section('content')
<div class="container">
<form method="POST" action="{{ route('registration.post') }}" style="margin-bottom: 14px;">
    @csrf
    
<div class="mb-3">
    <label  for="mail" class="form-label">Email address</label>
    <input type="mail" class="form-control" id="mail" name="mail" >
  </div>
  <div class="mb-3">
    <label for="password"  class="form-label">Password</label>
    <input class="form-control" type="password" id="password" name="password" >
  </div>
  <button type="submit " class="btn btn-primary">Submit </button>
</form>
</div>
