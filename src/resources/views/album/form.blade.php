@extends('layout')

@section('content')
    <h1>{{ $title }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif

    <form method="post" action="{{ $album->exists ? '/albums/patch/' . $album->id : '/albums/put' }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="album-name" class="form-label">Nosaukums</label>
            <input type="text" id="album-name" name="name" value="{{ old('name', $album->name) }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="album-rapper" class="form-label">Reperis</label>
            <select id="album-rapper" name="rapper_id" class="form-select @error('rapper_id') is-invalid @enderror">
                <option value="">Norādiet Reperi!</option>
                @foreach($rappers as $rapper)
                    <option value="{{ $rapper->id }}" {{ $rapper->id == old('rapper_id', $album->rapper_id) ? 'selected' : '' }}>{{ $rapper->name }}</option>
                @endforeach
            </select>
            @error('rapper_id')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="album-genre" class="form-label">Žanrs</label>
            <select id="album-genre" name="genre_id" class="form-select @error('genre_id') is-invalid @enderror">
                <option value="">Norādiet Žanru!</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $genre->id == old('genre_id', $album->genre_id) ? 'selected' : '' }}>{{ $genre->name }}</option>
                @endforeach
            </select>
            @error('genre_id')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

    

        <button type="submit" class="btn btn-primary">{{ $album->exists ? 'Atjaunot ierakstu' : 'Pievienot ierakstu' }}</button>
    </form>
@endsection
