@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-purple-700']) }}>
    {{ $value ?? $slot }}
</label>
