@extends('auth.layout')
@section('content')
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" 
class="grid grid-cols-1 gap-3">
        @csrf
        @method('PATCH')
        <!-- Avatar Actual y Input -->
        <div>
            <div>
                <label for="avatar" class="form-label">Avatar</label>
                @if (auth()->user()->profile && auth()->user()->profile->avatar)
                    <div class="mt-2 mb-4">
                        <img src="{{ asset('storage/' . auth()->user()->profile->avatar) }}" alt="Avatar"
                            class="w-20 h-20 rounded-full object-cover border">
                    </div>
                @endif
                <input id="avatar" name="avatar" type="file"/>
                @error('avatar')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- Dirección -->
        <div>
            <label for="address" class="form-label">Adress</label>
            <input id="address" name="address" type="text"
394/1300Relaciones en Laravel
                value="{{ old('address', auth()->user()->profile?->address) }}" class="form-input">
            @error('address')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
    </form>
@endsection