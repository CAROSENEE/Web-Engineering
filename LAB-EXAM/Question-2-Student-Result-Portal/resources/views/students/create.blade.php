@extends('layouts.app')
@section('title', 'Add student · Result Portal')
@section('content')
<div class="page-heading"><div><p class="eyebrow">Student record</p><h1>Add student</h1><p class="muted">Enter the student's details below.</p></div></div>
<section class="card form-card"><form method="POST" action="{{ route('students.store') }}">@include('students._form', ['buttonText' => 'Create student'])</form></section>
@endsection
