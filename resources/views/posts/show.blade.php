@extends('layouts.app')

@section('content')
    <a href="./">Go Back</a>
    <a href="{{route('posts.edit',$post->id)}}">Update</a>

    <form method="post" action="{{route('posts.destroy',$post->id)}}">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit">Delete</button><br/>
    </form>
    
    Title: {{$post->title}} <br/>
    Body: {{$post->body}}
@endsection
