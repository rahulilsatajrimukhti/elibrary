@extends('layouts.app')
@section('title', 'Tambah User')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('users.index') }}" class="btn btn-light btn-sm rounded-circle mr-2 shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>

            <h5 class="mb-0 font-weight-bold text-gray-800">
                Tambah Akun
            </h5>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label class="small text-muted">Nama</label>
                        <input type="text" name="name"
                            class="form-control form-control-sm rounded-pill px-3 @error('name') is-invalid @enderror"
                            value="{{ old('name', $data->name ?? '') }}">
                        @error('name')
                            <div class="text-danger small mt-1 ml-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="small">Email</label>
                        <input type="email" name="email"
                            class="form-control form-control-sm rounded-pill @error('email') is-invalid @enderror"
                            value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger ml-2">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="small text-muted">
                            No. HP
                        </label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="form-control form-control-sm rounded-pill px-3 @error('phone') is-invalid @enderror">
                        @error('phone')
                            <div class="text-danger small mt-1 ml-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="small text-muted">
                            Alamat
                        </label>
                        <textarea name="address" rows="3"
                            class="form-control form-control-sm rounded @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="text-danger small mt-1 ml-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="small">Password</label>
                        <input type="password" name="password"
                            class="form-control form-control-sm rounded-pill @error('password') is-invalid @enderror">
                        @error('password')
                            <small class="text-danger ml-2">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="small">User Level</label>
                        <select name="user_level_id"
                            class="form-control form-control-sm rounded-pill @error('user_level_id') is-invalid @enderror">

                            <option value="">-- Pilih --</option>
                            @foreach ($levels as $lvl)
                                <option value="{{ $lvl->id }}"
                                    {{ old('user_level_id') == $lvl->id ? 'selected' : '' }}>
                                    {{ $lvl->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_level_id')
                            <small class="text-danger ml-2">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="small text-muted d-block">Status</label>
                        <input type="hidden" name="is_active" value="0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="is_active" value="1" class="custom-control-input"
                                id="statusSwitch" {{ old('is_active', 1) ? 'checked' : '' }}>
                            <label class="custom-control-label small" for="statusSwitch">
                                Aktif
                            </label>
                        </div>
                    </div>

                    <div class="d-flex">
                        <button class="btn btn-primary btn-sm rounded-pill px-4 mr-2 shadow-sm">
                            <i class="fas fa-save"></i> Simpan
                        </button>

                        <a href="{{ route('users.index') }}" class="btn btn-light btn-sm rounded-pill px-4">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
