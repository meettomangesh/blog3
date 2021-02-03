@extends('layouts.admin')
@section('content')
@can('deliveryboy_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.deliveryboys.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.deliveryboy.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.deliveryboy.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Deliveryboy">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.deliveryboy.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.deliveryboy.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.deliveryboy.fields.email') }}
                        </th>
                       
                        <th>
                            {{ trans('cruds.deliveryboy.fields.mobile_number') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deliveryboys as $key => $deliveryboy)
                        <tr data-entry-id="{{ $deliveryboy->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $deliveryboy->id ?? '' }}
                            </td>
                            <td>
                                {{ $deliveryboy->name ?? '' }}
                            </td>
                            <td>
                                {{ $deliveryboy->email ?? '' }}
                            </td>
                            <td>
                                {{ $deliveryboy->mobile_number ?? '' }}
                            </td>
                            <!-- <td>
                                @foreach($deliveryboy->roles as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td> -->
                            <td>
                                @can('deliveryboy_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.deliveryboys.show', $deliveryboy->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('deliveryboy_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.deliveryboys.edit', $deliveryboy->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('deliveryboy_delete')
                                    <form action="{{ route('admin.deliveryboys.destroy', $deliveryboy->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('deliveryboy_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.deliveryboys.massDestroy') }}",
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
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Deliveryboy:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection