<fieldset class="{{ $classFormGroup ?? 'mt-20' }} {{ $type == 'file' ? 'input-upload up-lg' : ' input-fill' }}">
    @isset($label)
        <label for="{{ $name }}">{{ $label }}
            @isset($required)
                <span class="ms-1 text-danger">*</span>
            @endisset
        </label>
    @endisset

    @if ($type == 'file')
        <span class="icon icon-upload2"></span>
    @endif
    <input {{ $attributes }} id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
        class="{{ $type == 'file' ? 'upload-file' : 'form-control' }} @error($name) is-invalid @enderror"
        style="padding-right : {{ $type == 'number' ? '1rem' : '2.5rem' }}">

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
