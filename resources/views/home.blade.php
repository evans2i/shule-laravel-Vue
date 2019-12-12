@extends('layouts.default')

@section('content')
{{-- @include('layouts.content') --}}
<div>

  {{--  {{ dd(Auth::user()->with(roles)) }}  --}}
  {{--  @php
      $roles= Auth::user()->roles;
  @endphp
  @foreach ($roles as $role)
        {{  dd($role->name)}}
  @endforeach  --}}
  {{--  {{ 
    dd($rolee) 
  }}  --}}
  {{--  Auth::user()->load('roles')  --}}
  
  <router-view></router-view>
  <vue-progress-bar></vue-progress-bar>
</div>
@endsection
