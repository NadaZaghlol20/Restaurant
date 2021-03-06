@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" style="color:white;cursor: pointer" data-toggle="modal" data-target="#restaurant">
                اضافة مطعم
            </a>
            <button class="btn btn-info" style="color:white;cursor: pointer" onClick="print()">
                طباعة
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
           قائمة المطاعم
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th>الرقم التعريفى</th>
                            <th>إسم المطعم</th>
                            <th>رقم المطعم</th>
                            <th>عنوان المطعم</th>
                            <th>تعديل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($restaurants as $key => $restaurant)
                            <tr data-entry-id="{{ $restaurant->id }}">
                                <td>{{ $restaurant->id ?? '' }}</td>
                                <td>{{ $restaurant->name ?? '' }}</td>
                                <td>{{ $restaurant->phone ?? '' }}</td>
                                <td>{{ $restaurant->address ?? '' }}</td>
                                <td>
                                    <a href="#" class="btn btn-xs btn-info edit-operations-button" data-recObject="{{ json_encode($restaurant) }}" style="color:white;cursor: pointer">
                                        تعديل
                                    </a>

                                    <form action="/restaurants_delete/{{ $restaurant->id }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        <!--Create Modal Restaurant-->
        <div class="modal fade" id="restaurant" tabindex="-1" role="dialog" aria-labelledby="restaurantModal" aria-hidden="true">
            <div class="modal-dialog mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="restaurantModal"> تسجيل بيانات المطعم
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/restaurants_create">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4">إسم المطعم :</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" required autocomplete="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4">رقم المطعم :</label>
                                <div class="col-md-8">
                                    <input id="phone" type="text" class="form-control" name="phone" required autocomplete="phone">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4">عنوان المطعم :</label>
                                <div class="col-md-8">
                                    <textarea id="address" type="text" class="form-control" name="address" cols="20" required autocomplete="address"></textarea>
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

        <!--Edit Modal Restaurant-->
        <div class="modal fade" id="Editrestaurant" tabindex="-1" role="dialog" aria-labelledby="restaurantModal" aria-hidden="true">
            <div class="modal-dialog mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="restaurantModal"> تعديل بيانات العميل</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('update_restaurant') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4">إسم المطعم :</label>
                                <div class="col-md-8">
                                    <input id="name1" type="text" class="form-control" name="name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4">رقم المطعم :</label>
                                <div class="col-md-8">
                                    <input id="phone1" type="text" class="form-control" name="phone" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4">عنوان المطعم :</label>
                                <div class="col-md-8">
                                    <input id="address1" type="text" class="form-control" name="address" required>
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
            url: "{{ route('restaurants.massDestroy') }}",
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
            $('#name1').val(operation.name)
            $('#phone1').val(operation.phone)
            $('#address1').val(operation.address)
            $('#id').val(operation.id)
            $('#Editrestaurant').modal('show');
        });
    })
</script>
@endsection
