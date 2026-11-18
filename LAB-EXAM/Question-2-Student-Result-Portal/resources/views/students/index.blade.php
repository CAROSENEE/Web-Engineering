@extends('layouts.app')
@section('title', 'Students · Result Portal')
@section('content')
<div class="page-heading"><div><p class="eyebrow">Academic records</p><h1>Students</h1><p class="muted">Manage student profiles and review their course results.</p></div><a class="button primary" href="{{ route('students.create') }}">+ Add student</a></div>
<section class="card"><div class="table-wrap"><table><thead><tr><th>Name</th><th>Roll</th><th>Department</th><th>Email</th><th>Courses</th><th>Actions</th></tr></thead><tbody>
@forelse($students as $student)<tr><td><a class="strong" href="{{ route('students.show', $student) }}">{{ $student->name }}</a></td><td>{{ $student->roll }}</td><td>{{ $student->department }}</td><td>{{ $student->email }}</td><td>{{ $student->results_count }}</td><td class="actions"><a href="{{ route('students.edit', $student) }}">Edit</a><form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('Delete this student and their results?')">@csrf @method('DELETE')<button class="text-danger">Delete</button></form></td></tr>
@empty<tr><td class="empty" colspan="6">No student records yet. Add the first student to get started.</td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $students->links() }}</div></section>
@endsection
