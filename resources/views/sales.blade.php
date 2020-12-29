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
                            {{-- <th>الرقم التعريــفى</th> --}}
                            {{-- <th>رقم الطلــب</th> --}}
                            <th>عدد الطلبــات</th>
                            {{-- <th>السعر الإجمالــى</th> --}}
                            <th>إسم العميــل</th>
                            <th>العنــوان</th>
                            <th> رقم التليفـون</th>
                            {{-- <th>تعــديل</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                {{-- <td>{{ $sale->id ?? '' }}</td> --}}
                                {{-- <td>{{ $sale->order_num ?? '' }}</td> --}}
                                <td>{{ $count ?? '' }}</td>
                                {{-- <td>{{ $sale->final_price ?? '' }}</td> --}}
                                <td>{{ $sale->client_name ?? '' }}</td>
                                <td>{{ $sale->client_address ?? '' }}</td>
                                <td>{{ $sale->client_phone ?? '' }}</td>
                                {{-- <td>
                                    <a href="#" class="btn btn-xs btn-info edit-operations-button" data-recObject="{{ json_encode($sale) }}" style="color:white;cursor: pointer">
                                        تعديل
                                    </a>
                                    <form action="/sales_delete/{{ $sale->id }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        @method('delete') @csrf
                                        <input type="submit" class="btn btn-xs btn-danger" value="حذف">
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!--Create Modal-->
        {{-- <div class="modal fade" id="suborder" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
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
        </div> --}}
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
