<!-- resources/views/attendance.blade.php -->
@extends('layouts.app')

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h1>Attendance</h1>

    <!-- Attendance Form -->
    <form id="attendance-form">
        @csrf
        <label for="status">Mark Attendance:</label>
        <select name="status" id="status">
            <option value="present">Present</option>
            <option value="absent">Absent</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <!-- Attendance Data Display -->
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendanceData as $attendance)
                <tr>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

<!-- resources/views/attendance.blade.php -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const attendanceForm = document.getElementById('attendance-form');
        const statusSelect = document.getElementById('status');

        attendanceForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const status = statusSelect.value;

            // Make an AJAX request to update attendance
            axios.post('{{ route('attendance.update') }}', {
                _token: '{{ csrf_token() }}',
                status: status,
            })
            .then(function (response) {
                // Handle success, update the attendance data display
                console.log(response.data);
            })
            .catch(function (error) {
                // Handle error
                console.error(error);
            });
        });
    });
</script>

