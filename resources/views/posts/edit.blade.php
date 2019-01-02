@extends('layouts.app')

@section('content')
    <form method="post" action="/cms/public/posts/{{$post->id}}">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PUT">

        <input type="text" name="title" placeholder="Enter title" value="{{$post->title}}">
        <input type="submit" name="Submit">
    </form>
@endsection