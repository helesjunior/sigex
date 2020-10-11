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
            maskUpdate($('#type_id').val());
        });

        $(document).on('change','#type_id',function(){
            maskUpdate($(this).val());
        });

        function maskUpdate(value){

            if (value == '{{ \App\Models\CodeItem::TYPE_CREDITOR_LEGAL_ENTITY }}') {
                maskCNPJ('#{{ $field['name'] }}');
            }

            if (value == '{{ \App\Models\CodeItem::TYPE_CREDITOR_NATURAL_PERSON}}') {
                maskCPF('#{{ $field['name'] }}');
            }

            if (value == '{{ \App\Models\CodeItem::TYPE_CREDITOR_GENERIC_ID }}') {
                maskIDGener('#{{ $field['name'] }}');
            }

            if (value == '{{ \App\Models\CodeItem::TYPE_CREDITOR_MANAGING_UNIT }}') {
                maskUG('#{{ $field['name'] }}');
            }
        }

    </script>
@endpush
