@extends ('layouts.app')
@section('title','Moje strony')
@section('content')
    @foreach ($pages as $page)
    {{ $page->title }} <br>
    @endforeach
@endsection