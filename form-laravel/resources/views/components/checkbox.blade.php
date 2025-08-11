@props(['label', 'name', 'value' => 1, 'checked' => false])

<label>
    <input type="checkbox" name="{{ $name }}" value="{{ $value }}" {{ $checked ? 'checked' : '' }}>
    {{ $label }}
</label>
