@extends('layout')
@section('content')
<h1>{{ $title }}</h1>
@if (count($items) > 0)
 <table class="table table-sm table-hover table-striped">
 <thead class="thead-light">
 <tr>
 <th>ID</th>
 <th>Nosaukums</th>
 <th>Reperis</th>
 <th>Žanrs</th>
 <th>Gads</th>
 <th>Cena</th>
 <th>Attēlot</th>
 <th>&nbsp;</th>
 </tr>
 </thead>
 <tbody>
 @foreach($items as $album)
 <tr>
 <td>{{ $album->id }}</td>
 <td>{{ $album->name }}</td>
 <td>{{ $album->rapper->name }}</td>
 <td>{{ $album->genre->name }}</td>
 <td>{{ $album->year }}</td>
 <td>&euro; {{ number_format($album->price, 2, '.') }}</td>
 <td>{!! $album->display ? '&#x2714;' : '&#x274C;' !!}</td>
 <td>
 <a
 href="/albums/update/{{ $album->id }}"
 class="btn btn-outline-primary btn-sm"
 >Labot</a> /
 <form
 method="post"
 action="/albums/delete/{{ $album->id }}"
 class="d-inline deletion-form"
 >
 @csrf
<button
 type="submit"
 class="btn btn-outline-danger btn-sm"
 >Dzēst</button>
 </form>
 </td>
 </tr>
 @endforeach
 </tbody>
 </table>
@else
 <p>Nav atrasts neviens ieraksts</p>
@endif
<a href="/albums/create" class="btn btn-primary">Pievienot jaunu</a>
@endsection
