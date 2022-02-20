@extends('layout')
@section('title')
Campaign Lists
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <h2>Campaign Lists</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('campaigns.create') }}" class="btn btn btn-primary">Create Campaign</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12" id="campaign-list"></div>
</div>
@endsection