@extends('layout')
@section('content')
 <h1>{{ $title }}</h1>
 @if ($errors->any())
 <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
 @endif

 <form method="post" action="{{ $rapper->exists ? '/rappers/patch/' . $rapper->id : '/rappers/put' }}">
    
 @csrf

 <div class="mb-3">
 <label for="rapper-name" class="form-label">Repera vārds</label>
 <input
 type="text"
 class="form-control @error('name') is-invalid @enderror"
 id="rapper-name"
 name="name"
 value="{{ old('name', $rapper->name) }}"

 >
 @error('name')
 <p class="invalid-feedback">{{ $errors->first('name') }}</p>
 @enderror
 </div>
 <button type="submit" class="btn btn-primary">Pievienot</button>
 </form>
@endsection