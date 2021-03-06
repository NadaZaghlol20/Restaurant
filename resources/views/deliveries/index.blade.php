@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" style="color:white;cursor: pointer" data-toggle="modal" data-target="#client">
                اضافة دليفرى
            </a>
            <button class="btn btn-info" style="color:white;cursor: pointer" onClick="print()">
                طباعة
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
           قائمة الدليفرى
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th>الرقم التعريفى</th>
                            <th>عنوان الدليفرى</th>
                            <th>سعر التوصيل</th>
                            <th>تعديل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deliveries as $delivery)
                            <tr data-entry-id="{{ $delivery->id }}">
                                <td>{{ $delivery->id ?? '' }}</td>
                                <td>{{ $delivery->address ?? '' }}</td>
                                <td>{{ $delivery->delivery_price ?? '' }}</td>
                                <td>
                                    <a href="#" class="btn btn-xs btn-info edit-operations-button" data-recObject="{{ json_encode($delivery) }}" style="color:white;cursor: pointer">
                                        تعديل
                                    </a>
                                    <form action="/deliveries_delete/{{ $delivery->id }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        @method('delete') @csrf
                                        <input type="submit" class="btn btn-xs btn-danger" value="حذف">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!--Create Modal-->
        <div class="modal fade" id="client" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clientModal"> تسجيل بيانات الدليفرى</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/deliveries_create">
                            @csrf
                            <div class="form-group row">
                                <label for="address" class="col-md-4">عنوان الدليفرى :</label>
                                <div class="col-md-8">
                                    <input id="address" type="text" class="form-control" name="address" required autocomplete="address">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4"> سعر التوصيل :</label>
                                <div class="col-md-8">
                                    <input id="delivery_price" type="number" class="form-control" name="delivery_price" required autocomplete="delivery_price">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">تسجيل</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Edit Modal-->
        <div class="modal fade" id="Editclient" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clientModal">تعديل بيانات الدليفرى</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('update_delivery') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="address" class="col-md-4">عنوان الدليفرى :</label>
                                <div class="col-md-8">
                                    <input id="address1" type="text" class="form-control" name="address" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="delivery_price1" class="col-md-4"> سعر التوصيل :</label>
                                <div class="col-md-8">
                                    <input id="delivery_price1" type="number" class="form-control" name="delivery_price" required autocomplete="delivery_price">
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
            url: "{{ route('deliveries.massDestroy') }}",
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
            $('#address1').val(operation.address)
            $('#phone1').val(operation.phone)
            $('#delivery_price1').val(operation.delivery_price)
            $('#id').val(operation.id)
            $('#Editclient').modal('show');
        });
    })
</script>
@endsection
