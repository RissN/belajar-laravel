<div class="row align-items-end">
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="date" class="form-label fw-bold">Date <span class="text-danger">*</span></label>
            <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}" required>
        </div>
    </div>
    <div class="col-lg-8 text-end">
        <button type="submit" class="btn btn-success px-4 shadow-sm" id="btn-present-all">Mark All Present</button>
    </div>
</div>
<div class="alert alert-info border-0 shadow-sm mb-4 mt-4">
    <strong>Note:</strong>
    <p class="mb-0">You can mark attendance for all students at once by clicking the button above.</p>
</div>
<div class="table-responsive shadow-sm mb-4">
    <table class="table table-hover align-middle mb-0">
        <thead>
            <tr>
                <th width="5%" class="text-center">
                    <div class="form-check d-flex justify-content-center mb-0">
                        <input class="form-check-input" type="checkbox" name="check_all" id="check_all" title="Check All">
                    </div>
                </th>
                <th width="20%" class="text-center">Student Name</th>
                <th width="15%" class="text-center">Status In</th>
                <th width="12%" class="text-center">Check In</th>
                <th width="15%" class="text-center">Status Out</th>
                <th width="12%" class="text-center">Check Out</th>
                <th width="20%" class="text-center">Note</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $students as $index => $student )
                <tr class="student-row">
                    <td colspan="7" class="text-center">
                        <div class="form-check d-flex justify-content-center mb-0">
                            <input class="form-check-input" type="checkbox" name="attendances[{{ $index }}][student_id]" value="{{ $student->id }}" id="student_{{ $student->id }}" title="Check All">
                        </div>
                    </td>
                    <td>
                        <label for="student_{{ $student->id }}" class="mb-0 fw-semibold cursor-pointer d-block">{{ $student->name }}</label>
                    </td>
                    <td>
                        <select name="attendances[{{ $index }}][status_in]" id="" disabled>
                            <option value="">Select Status</option>
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                            <option value="alpha">Alpha</option>
                        </select>
                    </td>
                    <td>
                        <input type="time" name="attendances[{{ $index }}][check_in]" class="form-control check-in-time" disabled>
                    </td>
                    <td>
                        <select name="attendances[{{ $index }}][status_in]" id="" disabled>
                            <option value="">Select Status</option>
                            <option value="pulang">Pulang</option>
                            <option value="bolos">Bolos</option>
                            <option value="izin pulang cepat">Izin Pulang Cepat</option>
                        </select>
                    </td>
                    <td>
                        <input type="time" name="attendances[{{ $index }}][check_out]" class="form-control check-in-time" disabled>
                    </td>
                    <td>
                        <input type="text" name="attendances[{{ $index }}][note]"  class="form-control note-input" placeholder="Optional..." disabled>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" align="center">Data Not Found. <a href="{{ route('student.create') }}">Create a Student</a> First</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
