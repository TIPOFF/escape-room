@extends('support::amp')

@section('content')
    @include('escape-room::theme.partials._identity_tag')

    {{-- Place holder content - safe to replace --}}
    <ul>
        <li>Theme: {{ $theme->name }}</li>
    </ul>
@endsection
