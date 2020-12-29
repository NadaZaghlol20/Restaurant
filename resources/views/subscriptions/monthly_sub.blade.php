@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" style="color:white;cursor: pointer" data-toggle="modal" data-target="#client">
                اضافة نوع اشتراك
            </a>
            <a class="btn btn-info" style="color:white;cursor: pointer" data-toggle="modal" data-target="#suborder">
                اضافة طلب اشتراك
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
           قائمة طلبات الاشتراكــات
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th>الرقم التعريــفى</th>
                            <th>نوع الاشتــراك</th>
                            <th>إسم العميــل</th>
                            <th>عنوان العميــل</th>
                            <th>رقم العميــل</th>
                            <th>تاريخ الاشتــراك </th>
                            <th> ملاحظــات </th>
                            <th>تعــديل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order_subs as $order_sub)
                            <tr data-entry-id="{{ $order_sub->id }}">
                                <td>{{ $order_sub->id ?? '' }}</td>
                                <td><h5><a href="/monthly_sub/{{ $order_sub->sub_id }}" style="color:black;cursor: pointer" class="badge badge-warning">{{ $order_sub->sub_type ?? '' }}</a></h5></td>
                                <td>{{ $order_sub->name ?? '' }}</td>
                                <td>{{ $order_sub->address ?? '' }}</td>
                                <td>{{ $order_sub->phone ?? '' }}</td>
                                <td>{{ $order_sub->date ?? '' }}</td>
                                <td>{{ $order_sub->notes ?? '' }}</td>
                                <td>
                                    <a href="#" class="btn btn-xs btn-info edit-operations-button" data-recObject="{{ json_encode($order_sub) }}" style="color:white;cursor: pointer">
                                        تعديل
                                    </a>
                                    <form action="/order_sub_delete/{{ $order_sub->id }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                        <h5 class="modal-title" id="clientModal">تسجيل اشتراك شهرى</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/monthly_sub_create">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4">نوع الاشتراك :</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" required autocomplete="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4"> سعر الاشتراك :</label>
                                <div class="col-md-8">
                                    <input id="price" type="number" class="form-control" name="price" required autocomplete="type">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="period" class="col-md-4">المدة :</label>
                                <div class="col-md-8">
                                    <input id="period" type="number" class="form-control" name="period" required autocomplete="type">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="supplier_name" class="col-md-4"> إسم المورد :</label>
                                <div class="col-md-8">
                                    <input id="supplier_name" type="text" class="form-control" name="supplier_name" required autocomplete="type">
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

        <!--Create Modal-->
        <div class="modal fade" id="suborder" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="suborderModal">تسجيل طلب اشتراك </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/order_sub_create">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4"> إسم العميــل :</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" required autocomplete="type">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4"> العنــوان  :</label>
                                <div class="col-md-8">
                                    <input id="address" type="text" class="form-control" name="address" required autocomplete="type">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4">رقم العميل :</label>
                                <div class="col-md-8">
                                    <input id="phone" type="text" class="form-control" name="phone" required autocomplete="type">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="start_date" class="col-md-4">تاريخ الإشتراك :</label>
                                <div class="col-md-8">
                                    <input id="start_date" type="date" class="form-control" name="start_date" required autocomplete="type">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sub_id" class="col-md-4">نوع الإشتراك  :</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="sub_id" id="sub_id">
                                        @foreach ($subscriptions as $sub)
                                        <option value="{{$sub->id}}">{{$sub->subscription}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="notes" class="col-md-4"> ملاحظات :</label>
                                <div class="col-md-8">
                                    <input id="notes" type="text" class="form-control" name="notes" required autocomplete="type">
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
        <div class="modal fade" id="Editsuborder" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="suborderModal">تعديل طلب الاشتراك</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('update_order_sub') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4"> إسم العميــل :</label>
                                <div class="col-md-8">
                                    <input id="name1" type="text" class="form-control" name="name" required autocomplete="type">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4"> العنــوان  :</label>
                                <div class="col-md-8">
                                    <input id="address1" type="text" class="form-control" name="address" required autocomplete="type">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4">رقم العميــل :</label>
                                <div class="col-md-8">
                                    <input id="phone1" type="text" class="form-control" name="phone" required autocomplete="type">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="start_date" class="col-md-4">تاريخ الإشتــراك :</label>
                                <div class="col-md-8">
                                    <input id="start_date1" type="date" class="form-control" name="start_date" required autocomplete="type">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sub_id" class="col-md-4">نوع الإشتــراك  :</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="sub_id" id="sub_id1">
                                        @foreach ($subscriptions as $sub)
                                        <option value="{{$sub->id}}">{{$sub->subscription}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="notes" class="col-md-4"> ملاحظــات :</label>
                                <div class="col-md-8">
                                    <input id="notes1" type="text" class="form-control" name="notes" required autocomplete="type">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="id" id="id1" value="" >
                                <button type="submit" class="btn btn-primary">تعديــل</button>
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
            url: "{{ route('order_subs.massDestroy') }}",
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
            $('#name1').val(operation.name)
            $('#address1').val(operation.address)
            $('#phone1').val(operation.phone)
            $('#start_date1').val(operation.date)
            $('#sub_id1').val(operation.sub_id)
            $('#notes1').val(operation.notes)
            $('#id1').val(operation.id)
            $('#Editsuborder').modal('show');
        });
    })
</script>
@endsection
