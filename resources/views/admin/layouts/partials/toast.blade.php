@if (session('success') || session('error') || session('info'))
    @php
        $toastType    = session('success') ? 'success' : (session('error') ? 'error' : 'info');
        $toastMessage = session('success') ?? session('error') ?? session('info');
        $toastConfig  = [
            'success' => ['bg' => 'bg-green-50 border-green-200',  'text' => 'text-green-800',  'icon' => 'circle-check'],
            'error'   => ['bg' => 'bg-red-50 border-red-200',      'text' => 'text-red-800',    'icon' => 'circle-x'],
            'info'    => ['bg' => 'bg-blue-50 border-blue-200',    'text' => 'text-blue-800',   'icon' => 'info'],
        ];
        $cfg = $toastConfig[$toastType];
    @endphp

    <div id="toast" class="fixed top-5 right-5 z-100 flex items-center gap-3 px-4 py-3 rounded-xl border shadow-md text-sm font-medium max-w-sm {{ $cfg['bg'] }} {{ $cfg['text'] }}" role="alert">
        <i data-lucide="{{ $cfg['icon'] }}" class="w-5 h-5 shrink-0"></i>
        <span>{{ $toastMessage }}</span>
        <button type="button" onclick="document.getElementById('toast').remove()" class="ml-auto shrink-0 opacity-60 hover:opacity-100 cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
@endif