@props([
    'icon'  => 'wallet2',
    'label' => 'Wallet',
])
<div class="text-center">
    <div class="rounded-4 d-flex align-items-center justify-content-center mb-1"
         style="width:64px;height:64px;background:rgba(0,0,0,.04)">
        <i class="bi bi-{{ $icon }} fs-3"></i>
    </div>
    <small class="d-block fw-medium">{{ $label }}</small>
</div>
