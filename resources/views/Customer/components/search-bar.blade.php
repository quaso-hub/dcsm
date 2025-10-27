@props(['action' => '#','name' => 'q','value' => ''])
<div class="position-relative w-100" style="max-width:640px">
    <input name="{{ $name }}" value="{{ $value }}"
           class="form-control ps-5 py-2 rounded-pill border-0 shadow-sm dark:bg-dark dark:text-light"
           placeholder="Search menu or item…" autocomplete="off">
    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-4 text-muted"></i>
</div>