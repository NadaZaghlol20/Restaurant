@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <button class="btn btn-info" style="color:white;cursor: pointer" onClick="print()">
                طباعة المبيعـــات
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
           قائمة المبيعـــات
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>الرقم التعريــفى</th>
                            <th>إسم العميــل</th>
                            <th>العنــوان</th>
                            <th>رقم التليفـون</th>
                            <th>عدد الطلبــات</th>
                            <th>السعر الإجمالــى</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td>{{ $sale->id ?? '' }}</td>
                                <td>{{ $sale->name ?? '' }}</td>
                                <td>{{ $sale->address ?? '' }}</td>
                                <td>{{ $sale->phone ?? '' }}</td>
                                <td>{{ $sale->quantity ?? '' }}</td>
                                <td>{{ $sale->created_at ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('sales.massDestroy') }}",
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
                    data: { ids: ids, _method: 'DELETE' }}).done(function () { location.reload() })
                }
            }
        }
        dtButtons.push(deleteButton)

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });

        let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });

        // $('.edit-operations-button').click(function(e){
        //     e.preventDefault()
        //     let operation = JSON.parse($(this).attr('data-recObject'))
        //     $('#name1').val(operation.name)
        //     $('#address1').val(operation.address)
        //     $('#phone1').val(operation.phone)
        //     $('#start_date1').val(operation.date)
        //     $('#sub_id1').val(operation.sub_id)
        //     $('#notes1').val(operation.notes)
        //     $('#id1').val(operation.id)
        //     $('#Editsuborder').modal('show');
        // });
    })
</script>
@endsection
