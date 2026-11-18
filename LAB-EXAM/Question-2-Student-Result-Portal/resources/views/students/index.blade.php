@extends('layouts.app')
@section('title', 'Dashboard · Student Result Portal')
@section('content')
<div class="dashboard-header">
    <div><p class="eyebrow">Academic overview · Fall 2026</p><h1>Good morning, {{ auth()->user()->name }}</h1><p class="muted">Here is what is happening across your student community.</p></div>
    <a class="button primary" href="{{ route('students.create') }}"><span class="button-icon">+</span> Add student</a>
</div>

<section class="stats-grid" aria-label="Portal statistics">
    <article class="stat-card"><div class="stat-top"><span class="stat-icon teal">♧</span><span class="stat-caption">All departments</span></div><p class="stat-value">{{ number_format($dashboard['students']) }}</p><p class="stat-label">Enrolled students</p><div class="stat-foot"><span class="stat-dot"></span> Student records in portal</div></article>
    <article class="stat-card"><div class="stat-top"><span class="stat-icon purple">▤</span><span class="stat-caption">Current term</span></div><p class="stat-value">{{ number_format($dashboard['courses']) }}</p><p class="stat-label">Courses with results</p><div class="stat-foot"><span class="stat-dot purple-dot"></span> Across all departments</div></article>
    <article class="stat-card"><div class="stat-top"><span class="stat-icon blue">↗</span><span class="stat-caption">Term average</span></div><p class="stat-value">{{ number_format($dashboard['average'], 1) }}<small>/100</small></p><p class="stat-label">Average marks</p><div class="stat-foot"><span class="stat-dot blue-dot"></span> Based on recorded results</div></article>
    <article class="stat-card"><div class="stat-top"><span class="stat-icon amber">✓</span><span class="stat-caption">Passing mark 40+</span></div><p class="stat-value">{{ $dashboard['passRate'] }}<small>%</small></p><p class="stat-label">Pass rate</p><div class="stat-foot"><span class="stat-dot amber-dot"></span> Result completion overview</div></article>
</section>

<section class="overview-grid">
    <article class="card performance-card"><div class="section-heading"><div><p class="eyebrow">Grade summary</p><h2>Academic performance</h2></div><span class="term-pill">Fall 2026</span></div>
        @php($grades = ['A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'D', 'F'])
        @php($maxGradeCount = max(1, (int) $gradeDistribution->max()))
        <div class="grade-chart" role="img" aria-label="Grade distribution across recorded course results">
            @foreach($grades as $grade)
                @php($count = (int) ($gradeDistribution[$grade] ?? 0))
                <div class="grade-column"><span class="bar-value">{{ $count ?: '' }}</span><div class="bar-track"><div class="bar-fill {{ $grade === 'F' ? 'bar-fail' : '' }}" style="height: {{ $count ? max(12, round($count * 100 / $maxGradeCount)) : 4 }}%"></div></div><span class="bar-label">{{ $grade }}</span></div>
            @endforeach
        </div><div class="chart-legend"><span><i></i> Course results by grade</span><span>{{ $gradeDistribution->sum() }} results recorded</span></div>
    </article>
    <article class="card term-card"><div class="section-heading"><div><p class="eyebrow">Quick insight</p><h2>Portal activity</h2></div><span class="activity-icon">✦</span></div>
        <div class="activity-number">{{ $dashboard['students'] }} <span>students</span></div><p class="muted">Student profiles are ready for review. Add a student or open a profile to record course marks.</p>
        <div class="activity-progress"><div><span>Results entered</span><strong>{{ $gradeDistribution->sum() }}</strong></div><div class="progress-track"><span style="width: {{ $dashboard['students'] ? min(100, round($gradeDistribution->sum() * 100 / max(1, $dashboard['students'] * 4))) : 0 }}%"></span></div><small>Course records across the current sample roster</small></div>
        <a class="text-link" href="#student-directory">View student directory <span>→</span></a>
    </article>
</section>

<section class="card recent-card" id="recent-results"><div class="section-heading"><div><p class="eyebrow">Latest updates</p><h2>Recent results</h2></div><a class="text-link" href="#student-directory">All students <span>→</span></a></div>
    <div class="table-wrap"><table><thead><tr><th>Student</th><th>Course</th><th>Marks</th><th>Grade</th><th>Department</th></tr></thead><tbody>
    @forelse($latestResults as $result)<tr><td><div class="student-cell"><span class="avatar avatar-{{ $loop->index % 5 }}">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($result->student->name, 0, 1)) }}</span><div><a class="strong" href="{{ route('students.show', $result->student) }}">{{ $result->student->name }}</a><small>{{ $result->student->roll }}</small></div></div></td><td>{{ $result->course_code }}</td><td>{{ number_format($result->marks, 1) }} <span class="out-of">/ 100</span></td><td><span class="grade">{{ $result->grade }}</span></td><td>{{ $result->student->department }}</td></tr>
    @empty<tr><td class="empty" colspan="5">No results yet. Seed the demo roster or add a result from a student profile.</td></tr>@endforelse
    </tbody></table></div>
</section>

<section class="card directory-card" id="student-directory"><div class="section-heading"><div><p class="eyebrow">People</p><h2>Student directory</h2></div><a class="button secondary small-button" href="{{ route('students.create') }}">+ Add student</a></div>
    <div class="table-wrap"><table><thead><tr><th>Student</th><th>Roll number</th><th>Department</th><th>Results</th><th>Actions</th></tr></thead><tbody>
    @forelse($students as $student)<tr><td><div class="student-cell"><span class="avatar avatar-{{ $loop->index % 5 }}">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($student->name, 0, 1)) }}</span><a class="strong" href="{{ route('students.show', $student) }}">{{ $student->name }}</a></div></td><td>{{ $student->roll }}</td><td>{{ $student->department }}</td><td><span class="course-count">{{ $student->results_count }} courses</span></td><td class="actions"><a href="{{ route('students.edit', $student) }}">Edit</a><form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('Delete this student and their results?')">@csrf @method('DELETE')<button class="text-danger">Delete</button></form></td></tr>
    @empty<tr><td class="empty" colspan="5">No student records found.</td></tr>@endforelse
    </tbody></table></div><div class="pagination">{{ $students->links('pagination::bootstrap-4') }}</div>
</section>
@endsection
