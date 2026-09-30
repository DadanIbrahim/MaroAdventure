@extends('layouts.app')

@section('title', 'Maro Adventure Indonesia | GO BEYOND THE TRIP')

@section('content')

    @include('layouts.partials.sections.hero')
    @include('layouts.partials.sections.tentang')
    @include('layouts.partials.sections.layanan')
    @include('layouts.partials.sections.paket')
    @include('layouts.partials.sections.kenapa')
    @include('layouts.partials.sections.galeri')
    @include('layouts.partials.sections.cta')
    @include('layouts.partials.sections.kontak')

@endsection
