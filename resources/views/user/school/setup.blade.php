@extends('adminlte::page')

@section('title', 'School Setup')

@section('content_header')
    <h1 class="text-success font-weight-bold">Kamilisha Taarifa za Shule</h1>
@stop

@section('content')
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card card-outline card-success">
        <div class="card-header bg-warning">
            <h3 class="card-title text-dark font-weight-bold">Taarifa za Shule</h3>
        </div>

        <form action="{{ route('user.school.setup.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Jina la Shule</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $school->name ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="registration_number">Namba ya Usajili</label>
                    <input type="text" name="registration_number" id="registration_number" class="form-control" value="{{ old('registration_number', $school->registration_number ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Barua pepe ya Shule</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $school->email ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Simu</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $school->phone ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="address">Anuani</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $school->address ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="category">Aina ya Shule</label>
                    <select name="category" id="category" class="form-control" required>
                        @php($selectedCategory = old('category', $school->category ?? 'Government'))
                        <option value="Government" {{ $selectedCategory === 'Government' ? 'selected' : '' }}>Government</option>
                        <option value="Private" {{ $selectedCategory === 'Private' ? 'selected' : '' }}>Private</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="level">Ngazi</label>
                    @php($selectedLevel = old('level', $school->level ?? 'O-Level'))
                    <select name="level" id="level" class="form-control" required>
                        <option value="Primary" {{ $selectedLevel === 'Primary' ? 'selected' : '' }}>Primary</option>
                        <option value="Secondary" {{ $selectedLevel === 'Secondary' ? 'selected' : '' }}>Secondary</option>
                        <option value="O-Level" {{ $selectedLevel === 'O-Level' ? 'selected' : '' }}>O-Level</option>
                        <option value="A-Level" {{ $selectedLevel === 'A-Level' ? 'selected' : '' }}>A-Level</option>
                        <option value="Both" {{ $selectedLevel === 'Both' ? 'selected' : '' }}>Both</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Maelezo (hiari)</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $school->description ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="logo">Logo (hiari)</label>
                    <input type="file" name="logo" id="logo" class="form-control-file">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Hifadhi na Endelea</button>
            </div>
        </form>
    </div>
@stop
