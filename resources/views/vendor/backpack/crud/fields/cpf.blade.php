<!-- text input -->
@include('crud::fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>
@include('crud::fields.inc.translatable_icon')

@if(isset($field['prefix']) || isset($field['suffix']))
    <div class="input-group"> @endif
        @if(isset($field['prefix']))
            <div class="input-group-addon">{!! $field['prefix'] !!}</div> @endif
        <input
            type="text"
            name="{{ $field['name'] }}"
            id="{{ $field['name'] }}"
            value="{{ old($field['name']) ?? $field['value'] ?? $field['default'] ?? '' }}"
            @include('crud::fields.inc.attributes')
        >
        @if(isset($field['suffix']))
            <div class="input-group-addon">{!! $field['suffix'] !!}</div> @endif
        @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
    </div>

    @push('crud_fields_scripts')
        <script type="text/javascript">
            $('#{{ $field['name'] }}').mask('999.999.999-99');
        </script>
    @endpush



