@csrf
<div class="form-grid">
    <div><label for="name">Full name</label><input id="name" name="name" value="{{ old('name', $student->name ?? '') }}" required>@error('name')<p class="error">{{ $message }}</p>@enderror</div>
    <div><label for="roll">Roll number</label><input id="roll" name="roll" value="{{ old('roll', $student->roll ?? '') }}" required>@error('roll')<p class="error">{{ $message }}</p>@enderror</div>
    <div><label for="department">Department</label><input id="department" name="department" value="{{ old('department', $student->department ?? '') }}" required>@error('department')<p class="error">{{ $message }}</p>@enderror</div>
    <div><label for="email">Email</label><input id="email" name="email" type="email" value="{{ old('email', $student->email ?? '') }}" required>@error('email')<p class="error">{{ $message }}</p>@enderror</div>
</div>
<div class="form-actions"><a class="button secondary" href="{{ route('students.index') }}">Cancel</a><button class="button primary">{{ $buttonText }}</button></div>
