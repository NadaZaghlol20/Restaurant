@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">قائمة الاشتراكــات </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>نوع الاشتــراك</th>
                        <td>
                            {{ $monthly_sub->subscription ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>سعر الاشتــراك</th>
                        <td>
                            {{ $monthly_sub->price ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>فترة الاشتــراك</th>
                        <td>
                            {{ $monthly_sub->period ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th> اسم المــورد</th>
                        <td>
                            {{ $monthly_sub->supplier_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <a href="#" class="btn btn-info edit-operations-button  float-right" data-recObject="{{ json_encode($monthly_sub) }}" style="color:white;cursor: pointer">
                تعديل
            </a>
        </div>

        <!--Edit Modal-->
        <div class="modal fade" id="Editclient" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clientModal">تعديل الاشتراك</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('update_monthly_sub') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4"> نوع الاشتراك :</label>
                                <div class="col-md-8">
                                    <input id="name1" type="text" class="form-control" name="name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4">سعر الاشتراك :</label>
                                <div class="col-md-8">
                                    <input id="price1" type="text" class="form-control" name="price" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="period" class="col-md-4">المدة  :</label>
                                <div class="col-md-8">
                                    <input id="period1" type="number" class="form-control" name="period" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="supplier_name" class="col-md-4"> إسم المورد :</label>
                                <div class="col-md-8">
                                    <input id="supplier_name1" type="text" class="form-control" name="supplier_name" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="id" id="id" value="" >
                                <button type="submit" class="btn btn-primary">تعديل</button>
                            </div>
                        </form>
                    </div>
                </div>
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
            url: "{{ route('monthly_subs.massDestroy') }}",
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

        $('.edit-operations-button').click(function(e){
            e.preventDefault()
            let operation = JSON.parse($(this).attr('data-recObject'))
            $('#name1').val(operation.subscription)
            $('#price1').val(operation.price)
            $('#period1').val(operation.period)
            $('#supplier_name1').val(operation.supplier_name)
            $('#id').val(operation.id)
            $('#Editclient').modal('show');
        });
    })
</script>
@endsection
