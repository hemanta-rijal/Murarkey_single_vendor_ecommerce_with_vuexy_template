@extends('admin.layouts.app')

@section('styles')
<style>
    dl dd {
        margin-bottom: 10px;
    }
</style>

@endsection
@section('content-header')
<h3>
    Contact Us Form Data: {{ $contact->subject }}
    &middot;
    @if($contact->status == 'unread')
    <a href="/admin/contact-us/update-status/{{ $contact->id }}?status=read">Mark as
        Read</a>
    @endif
</h3>

@endsection
@section('content')
<div class="row">
    <div class="col-sm-8">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>
                {{ $contact->name }} &nbsp;
            </dd>
            <dt>Email</dt>
            <dd>
                {{ $contact->email }} &nbsp;
            </dd>


            <dt>Website</dt>
            <dd>
                {{ $contact->website }} &nbsp;
            </dd>


            <dt>Company Name</dt>
            <dd>
                {{ $contact->company_name }} &nbsp;
            </dd>
            <dt>Subject</dt>
            <dd>
                {{ $contact->subject }}&nbsp;
            </dd>
            <dt>Message</dt>
            <dd>
                <div>{{ $contact->message }}</div>
            </dd>

            <dt>Status</dt>
            <dd>
                {!! $contact->status !!}
            </dd>
        </dl>
    </div>
</div>
@endsection
