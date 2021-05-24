@if ($crud->hasAccess('update'))
    {{-- @if (!$crud->model->translationEnabled()) --}}
        {{-- Single edit button --}}
        <div class="btn-group">
            <button type="button"
                    class="btn btn-xs dropdown-toggle dropdown-toggle-split"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    title="{{ __('backpack::crud.more') }}"
            >
                <i class="la la-cog"></i>
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>

            <ul class="dropdown-menu dropdown-menu-right">
                <li>
                    &nbsp; <a href="/codigo/{{ $entry->getKey() }}/item">
                        <i class="la la-greater-than"></i> Itens
                    </a>
                </li>
            </ul>
        </div>
    {{--
    @else
        <!-- Edit button group -->
    @endif
    --}}
@endif

{{--
@if ($crud->hasAccess('update'))
	@if (!$crud->model->translationEnabled())
        <!-- Single edit button -->
        <a href="{{ url($crud->route . '/' . $entry->getKey() . '/more') }}"
           class="btn btn-sm btn-link dropdown-toggle dropdown-toggle-split">
            <i class="la la-cogs"></i> {{ trans('backpack::crud.preview') }} asdsad
        </a>
	@else
        <!-- Edit button group -->
        <div class="btn-group">
            <a href="{{ url($crud->route.'/'.$entry->getKey().'/show') }}" class="btn btn-sm btn-link pr-0"><i class="la la-eye"></i> {{ trans('backpack::crud.preview') }}</a>
            <a class="btn btn-sm btn-link dropdown-toggle text-primary pl-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header">{{ trans('backpack::crud.preview') }}:</li>
                @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                    <a class="dropdown-item" href="{{ url($crud->route.'/'.$entry->getKey().'/show') }}?locale={{ $key }}">{{ $locale }}</a>
                @endforeach
            </ul>
        </div>
	@endif
@endif
--}}
