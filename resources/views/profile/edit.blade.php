@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="card p-6">

        <h1 class="text-3xl font-bold">
            My Profile
        </h1>

        <p class="text-slate-400 mt-2">
            Manage your account information, password and security settings.
        </p>

    </div>

    {{-- Profile Information --}}
    <div class="card p-6">

        @include('profile.partials.update-profile-information-form')

    </div>

    {{-- Update Password --}}
    <div class="card p-6">

        @include('profile.partials.update-password-form')

    </div>

    {{-- Delete Account --}}
    <div class="card p-6 border border-red-500/20">

        @include('profile.partials.delete-user-form')

    </div>

</div>

@endsection