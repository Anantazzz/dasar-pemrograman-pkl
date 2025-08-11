@props([
  'label' => '',
  'name',
  'options' => [],
  'selected' => null,
])

<div class="form-group">
  @if($label)
    <label for="{{ $name }}">{{ $label }}</label>
  @endif
  <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }}>
    <option value="">-- Pilih {{ $label }} --</option>
    @foreach($options as $value => $display)
      <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
        {{ $display }}
      </option>
    @endforeach
  </select>
</div>