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

    </table>
</div>
