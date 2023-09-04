@extends('admin.layouts.app')
@section('content')
<div id="app" style="width: 70%;">
GOOD


<chat-app-2 :user="{{ auth()->user() }}"/>
</div>
@endsection
