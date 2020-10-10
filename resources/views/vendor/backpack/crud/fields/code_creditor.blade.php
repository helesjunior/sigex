<!-- text input -->
@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    @if(isset($field['prefix']) || isset($field['suffix'])) <div class="input-group"> @endif
        @if(isset($field['prefix'])) <div class="input-group-prepend"><span class="input-group-text">{!! $field['prefix'] !!}</span></div> @endif
        <input
            type="text"
            name="{{ $field['name'] }}"
            value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}"
            @include('crud::fields.inc.attributes')
        >
        @if(isset($field['suffix'])) <div class="input-group-append"><span class="input-group-text">{!! $field['suffix'] !!}</span></div> @endif
    @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

@push('crud_fields_scripts')
    <script type="text/javascript">
        $(window).on('load', function() {
            var value = $('#type_id').val();

            if (value == '1') {
                maskCNPJ('#{{ $field['name'] }}');
            }

            if (value == '2') {
                maskCPF('#{{ $field['name'] }}');
            }

            if (value == '3') {
                maskIDGener('#{{ $field['name'] }}');
            }

            if (value == '4') {
                maskUG('#{{ $field['name'] }}');
            }
        });

        $(document).on('change','#type_id',function(){

            var value = $(this).val();

            if (value == '1') {
                maskCNPJ('#{{ $field['name'] }}');
            }

            if (value == '2') {
                maskCPF('#{{ $field['name'] }}');
            }

            if (value == '3') {
                maskIDGener('#{{ $field['name'] }}');
            }

            if (value == '4') {
                maskUG('#{{ $field['name'] }}');
            }
        });
    </script>
@endpush
