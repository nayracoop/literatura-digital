@extends('layouts.main')
@section('title') Inicio @endsection
@section('content')
	@foreach( $users as $user )
			<br>{{$user->getName() }} => {{$user->role}}

	@endforeach
@endsection