@can('case_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.cases.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.case.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.case.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Case">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.case.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.case.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.case.fields.report_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.case.fields.cases') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cases as $key => $case)
                        <tr data-entry-id="{{ $case->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $case->id ?? '' }}
                            </td>
                            <td>
                                {{ $case->country->name ?? '' }}
                            </td>
                            <td>
                                {{ $case->report_date ?? '' }}
                            </td>
                            <td>
                                {{ $case->cases ?? '' }}
                            </td>
                            <td>
                                @can('case_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cases.show', $case->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('case_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cases.edit', $case->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('case_delete')
                                    <form action="{{ route('admin.cases.destroy', $case->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('case_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cases.massDestroy') }}",
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
  $('.datatable-Case:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection