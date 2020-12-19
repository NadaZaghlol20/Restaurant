@can($viewGate)
    <a class="btn btn-xs btn-primary" href="{{ route($crudRoutePart . '.show', $row->id) }}">
        @lang('global.view')
    </a>
@endcan
@can($editGate)
    <a class="btn btn-xs btn-info" href="{{ route($crudRoutePart . '.edit', $row->id) }}">
        @lang('global.edit')
    </a>
@endcan
@can($deleteGate)
    <form action="{{ route('$crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ __('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ __('global.delete') }}">
    </form>
@endcan
