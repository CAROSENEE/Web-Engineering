@extends('layouts.app')
@section('title', 'Edit student · Result Portal')
@section('content')
<div class="page-heading"><div><p class="eyebrow">Student record</p><h1>Edit student</h1><p class="muted">Update {{ $student->name }}'s details.</p></div></div>
<section class="card form-card"><form method="POST" action="{{ route('students.update', $student) }}">@method('PUT') @include('students._form', ['buttonText' => 'Save changes'])</form></section>
@endsection
