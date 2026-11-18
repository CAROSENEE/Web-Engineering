const form = document.querySelector('#registration-form');
const fields = ['fullName', 'email', 'phone', 'dob', 'department', 'password'];
const errorText = {
  fullName: 'Enter your full name.', email: 'Enter a valid email address.', phone: 'Enter your phone number.',
  dob: 'Choose your date of birth.', department: 'Choose a department.', password: 'Password must be at least 8 characters.'
};
document.querySelector('#year').textContent = new Date().getFullYear();

function showError(name, message = '') {
  const input = document.getElementById(name);
  const error = document.getElementById(`${name}-error`);
  error.textContent = message;
  if (input) input.setAttribute('aria-invalid', String(Boolean(message)));
  if (name === 'gender') document.querySelectorAll('[name="gender"]').forEach((radio) => radio.setAttribute('aria-invalid', String(Boolean(message))));
}

form.addEventListener('submit', (event) => {
  event.preventDefault();
  let valid = true;
  const values = Object.fromEntries(new FormData(form).entries());
  fields.forEach((name) => {
    let message = '';
    if (!String(values[name] || '').trim()) message = errorText[name];
    else if (name === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(values.email.trim())) message = errorText.email;
    else if (name === 'password' && values.password.length < 8) message = errorText.password;
    showError(name, message);
    if (message) valid = false;
  });
  const gender = document.querySelector('[name="gender"]:checked')?.value || '';
  showError('gender', gender ? '' : 'Choose a gender option.');
  if (!gender) valid = false;
  if (!valid) {
    document.querySelector('#form-status').textContent = 'Please correct the highlighted fields.';
    form.querySelector('[aria-invalid="true"]')?.focus();
    return;
  }
  const row = document.createElement('tr');
  [values.fullName, values.email, values.phone, values.dob, values.department, gender].forEach((value) => {
    const cell = document.createElement('td');
    cell.textContent = value;
    row.append(cell);
  });
  document.querySelector('#student-list').append(row);
  document.querySelector('#students').hidden = false;
  document.querySelector('#form-status').textContent = 'Registration submitted successfully.';
  form.reset();
  [...fields, 'gender'].forEach((name) => showError(name));
  document.querySelector('#students').scrollIntoView({ behavior: 'smooth', block: 'start' });
});
