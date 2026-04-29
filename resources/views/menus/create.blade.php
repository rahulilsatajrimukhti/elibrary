@extends('layouts.app')
@section('title', 'Tambah Menu')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('menus.index') }}" class="btn btn-light btn-sm rounded-circle mr-2 shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>

            <h5 class="mb-0 font-weight-bold text-gray-800">
                Tambah Menu
            </h5>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <form action="{{ route('menus.store') }}" method="POST">
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
                        <label class="small text-muted">Route</label>
                        <input type="text" name="route" class="form-control form-control-sm rounded-pill px-3"
                            value="{{ old('route') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label class="small text-muted">Icon</label>
                        <input type="text" name="icon" class="form-control form-control-sm rounded-pill px-3"
                            value="{{ old('icon') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label class="small text-muted">Menu Utama</label>
                        <select name="parent_id" class="form-control form-control-sm rounded-pill px-3">
                            <option value="">-- Pilih --</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}">
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small text-muted">Urutan</label>
                        <input type="number" name="order" class="form-control form-control-sm rounded-pill px-3"
                            value="{{ old('order', 0) }}">
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

                        <a href="{{ route('menus.index') }}" class="btn btn-light btn-sm rounded-pill px-4">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputs = document.querySelectorAll("input, textarea, select");
        inputs.forEach(input => {
            input.addEventListener("input", function() {
                this.classList.remove("is-invalid");
                let error = this.parentElement.querySelector(".text-danger");
                if (error) {
                    error.style.transition = "0.2s";
                    error.style.opacity = "0";
                    setTimeout(() => error.remove(), 200);
                }

            });
        });

    });
</script>
