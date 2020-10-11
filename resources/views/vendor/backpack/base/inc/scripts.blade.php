@if (config('backpack.base.scripts') && count(config('backpack.base.scripts')))
    @foreach (config('backpack.base.scripts') as $path)
    <script type="text/javascript" src="{{ asset($path).'?v='.config('backpack.base.cachebusting_string') }}"></script>
    @endforeach
@endif

@if (config('backpack.base.mix_scripts') && count(config('backpack.base.mix_scripts')))
    @foreach (config('backpack.base.mix_scripts') as $path => $manifest)
    <script type="text/javascript" src="{{ mix($path, $manifest) }}"></script>
    @endforeach
@endif

@include('backpack::inc.alerts')

<!-- page script -->
<script type="text/javascript">
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function() { Pace.restart(); });

    // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    {{-- Enable deep link to tab --}}
    var activeTab = $('[href="' + location.hash.replace("#", "#tab_") + '"]');
    location.hash && activeTab && activeTab.tab('show');
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        location.hash = e.target.hash.replace("#tab_", "#");
    });
</script>

<script type="text/javascript">
    function maiuscula(z){
        v = z.value.toUpperCase();
        z.value = v;
    }

    function minusculo(z){
        v = z.value.toLowerCase();
        z.value = v;
    }

    function maskCNPJ(element) {
        $(element).mask("99.999.999/9999-99");
    }

    function maskCPF(element) {
        $(element).mask("999.999.999-99");
    }

    function maskUG(element) {
        $(element).mask("999999");
    }

    function maskIDGener(element) {
        $(element).mask("EX9999999");
    }

    function maskEmpenho(element) {
        $(element).mask("9999NE999999");
    }

    function maskContrato(element) {
        $(element).mask("99999/9999");
    }

    $(document).ready(function() {
        $('.mostraCamposRelacionados').each(function(i) {
            campo = $(this).data('campo');
            dado = retornaDadosContrato(campo);

            $(this).val(dado);
        });
    });

    function retornaDadosContrato(campo) {
        dado = '';

        if($("#dados_contrato").length) {
            conteudo = $("#dados_contrato").val();
            dados = jQuery.parseJSON(conteudo);

            dado = dados[campo];
        }

        return dado;
    }
</script>
