@extends('layout')

@section('title')
Create Campaign
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2>Create Campaign</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('campaigns.list') }}" class="btn btn-primary">
            Campaign Lists</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12" id="campaign-create"></div>
</div>
@endsection