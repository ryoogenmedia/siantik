<fieldset class="mt-20 input-fill">
    @isset($label)
        <label for="{{ $name }}">{{ $label }}
            @isset($required)
                <span class="ms-1 text-danger">*</span>
            @endisset
        </label>
    @endisset

    <select {{ $attributes }} id="{{ $name }}" name="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror">
        {{ $slot }}
    </select>

    @if (!isset($nonmessage))
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    @endif

    @isset($optional)
        <small style="font-size: 12px">{{ $optional ?? '' }}</small>
    @endisset
</fieldset>
