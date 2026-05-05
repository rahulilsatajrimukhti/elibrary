@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show py-2 px-3 small shadow-sm">
            <i class="fas fa-check-circle mr-1"></i>
            {{ session('success') }}

            <button type="button" class="close p-1" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
@endsection
