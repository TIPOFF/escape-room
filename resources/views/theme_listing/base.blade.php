@extends('support::base')

@section('content')
    @include('escape-room::theme_listing.partials._identity_tag')

    {{-- Place holder content - safe to replace --}}
    @if($market)
        <h2>{{$market->name}}</h2>
    @endif
    <ul>
        @foreach($themes as $theme)
            <li>Theme: {{ $theme->name }}</li>
        @endforeach
    </ul>
@endsection
