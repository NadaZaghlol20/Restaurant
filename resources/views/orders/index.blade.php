@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" style="color:white;cursor: pointer" data-toggle="modal" data-target="#order">
                اضافة طلب طعام
            </a>
            <button class="btn btn-info" style="color:white;cursor: pointer" onClick="print()">
                طباعة
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
           قائمة الطلبات
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th>الرقم التعريفى</th>
                            <th>إسم العميل</th>
                            <th>إسم المطعم</th>
                            <th>السعر</th>
                            <th>تعديل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr data-entry-id="{{ $order->id }}">
                                <td height="5">{{ $order->id ?? '' }}</td>
                                <td>{{ $order->name ?? '' }}</td>
                                <td>{{ $order->res_name ?? '' }}</td>
                                <td>{{ $order->price ?? '' }}</td>
                                <td>
                                    <a href="#" class="btn btn-xs btn-info edit-operations-button" data-recObject="{{ json_encode($order) }}" style="color:white;cursor: pointer">
                                        تعديل
                                    </a>

                                    <form action="/orders_delete/{{ $order->id }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        <!--Create Modal Menu-->
        <div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="orderModal" aria-hidden="true">
            <div class="modal-dialog mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModal"> تسجيل بيانات قائمة الطعام
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/orders_create">
                            @csrf
                            <div class="form-group row">
                                <label for="client_id" class="col-md-4">إسم العميل :</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="client_id" id="client_id">
                                        @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="restaurant_id" class="col-md-4">إسم المطعم :</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="restaurant_id" id="restaurant_id">
                                        @foreach ($restaurants as $res)
                                        <option value="{{$res->id}}">{{$res->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4">السعر :</label>
                                <div class="col-md-8">
                                    <input id="price" type="number" class="form-control" name="price" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" onClick="print()">تسجيل</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Edit Modal Menu-->
        <div class="modal fade" id="Editorder" tabindex="-1" role="dialog" aria-labelledby="orderModal" aria-hidden="true">
            <div class="modal-dialog mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModal"> تعديل بيانات قائمة الطعام
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('update_order') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="client_id" class="col-md-4">إسم العميل :</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="client_id" id="client_id1">
                                        @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="restaurant_id" class="col-md-4">إسم المطعم :</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="restaurant_id" id="restaurant_id1">
                                        @foreach ($restaurants as $res)
                                        <option value="{{$res->id}}">{{$res->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4">السعر :</label>
                                <div class="col-md-8">
                                    <input id="price1" type="number" class="form-control" name="price" required>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <input type="hidden" name="id" id="id" value="">
                                <button type="submit" class="btn btn-primary">تعديل</button>
                            </div>
                        </form>
                    </div>
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
            url: "{{ route('orders.massDestroy') }}",
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
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

        $('.edit-operations-button').click(function(e){
            e.preventDefault()
            let operation = JSON.parse($(this).attr('data-recObject'))
            console.log(operation)
            $('#client_id1').val(operation.client_id)
            $('#restaurant_id1').val(operation.restaurant_id)
            $('#price1').val(operation.price)
            $('#id').val(operation.id)
            $('#Editorder').modal('show');
        });
    })
</script>
@endsection
