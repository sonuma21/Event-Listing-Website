@props([
    'id',
    'name',
    'type' => 'text',
    'value' => '',
    'icon' => null,
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'autocomplete' => null,
])

<div class="relative">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        @if ($icon)
            <i class="fas fa-{{ $icon }} text-slate-600"></i>
        @endif
    </div>
    <input
        {{ $attributes->merge([
            'id' => $id,
            'name' => $name,
            'type' => $type,
            'value' => old($name, $value),
            'placeholder' => $placeholder,
            'required' => $required,
            'autofocus' => $autofocus,
            'autocomplete' => $autocomplete,
            'class' =>
                'block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm' .
                ($errors->has($name) ? ' border-red-500' : ''),
        ]) }} />
    @if ($type === 'password')
        <button type="button" class="password-toggle absolute inset-y-0 right-0 pr-3 flex items-center"
            aria-label="Toggle password visibility">
            <i class="fas fa-eye-slash text-gray-400"></i>
        </button>
    @endif
</div>
