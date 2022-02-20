@extends('layout')
@section('title')
Update Campaign
@endsection
@section('content')
<div class="row header-margin">
    <div class="col-md-6">
        <h2>Update Campaign</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('campaigns.list') }}" class="btn btn btn-primary">
            Campaign Lists</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12" data-campaign_id="{{ $campaign_id }}" id="campaign-edit"></div>
</div>
@endsection