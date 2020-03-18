@extends('layouts.admin')
@section('content')
@can('infection_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.infections.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.infection.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.infection.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Infection">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.infection.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.infection.fields.report_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.infection.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.infection.fields.infections') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($infections as $key => $infection)
                        <tr data-entry-id="{{ $infection->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $infection->id ?? '' }}
                            </td>
                            <td>
                                {{ $infection->report_date ?? '' }}
                            </td>
                            <td>
                                {{ $infection->country->name ?? '' }}
                            </td>
                            <td>
                                {{ $infection->infections ?? '' }}
                            </td>
                            <td>
                                @can('infection_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.infections.show', $infection->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('infection_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.infections.edit', $infection->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('infection_delete')
                                    <form action="{{ route('admin.infections.destroy', $infection->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('infection_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.infections.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Infection:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection