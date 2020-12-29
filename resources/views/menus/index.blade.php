@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" style="color:white;cursor: pointer" data-toggle="modal" data-target="#menu">
                اضافة قائمة الطعام
            </a>
            <button class="btn btn-info" style="color:white;cursor: pointer" onClick="print()">
                طباعة
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 for="restaurant_id" class="col-md-4">إختار مطعم :</h5>
            <div class="col-md-3">
                <select class="form-control" name="restaurant_id" id="filters">
                    <option value="-1" selected>إختــر مطعم</option>
                    @foreach ($restaurants as $res)
                    <option value="{{$res->id}}">{{$res->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped datatable datatable-User" id="FilterData">
                    <thead>
                        <tr>
                            <th>الرقم التعريفى</th>
                            <th>إسم المطعم</th>
                            <th>إسم الطعام</th>
                            <th>السعر</th>
                            <th>تعديل</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!--Create Modal Menu-->
        <div class="modal fade" id="menu" tabindex="-1" role="dialog" aria-labelledby="menuModal" aria-hidden="true">
            <div class="modal-dialog mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="menuModal"> تسجيل بيانات قائمة الطعام
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/menus_create">
                            @csrf
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
                                <label for="food" class="col-md-4">اسم الطعام :</label>
                                <div class="col-md-8">
                                    <input id="food" type="text" class="form-control" name="food" required autocomplete="food">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4">السعر :</label>
                                <div class="col-md-8">
                                    <input id="price" type="number" class="form-control" name="price" required>
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

        <!--Edit Modal Menu-->
        <div class="modal fade" id="Editmenu" tabindex="-1" role="dialog" aria-labelledby="menuModal" aria-hidden="true">
            <div class="modal-dialog mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="menuModal"> تعديل بيانات قائمة الطعام
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('update_menu') }}">
                            @csrf
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
                                <label for="food" class="col-md-4">اسم الطعام :</label>
                                <div class="col-md-8">
                                    <input id="food1" type="text" class="form-control" name="food" required autocomplete="food">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4">السعر :</label>
                                <div class="col-md-8">
                                    <input id="price1" type="number" class="form-control" name="price" required>
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
            url: "{{ route('menus.massDestroy') }}",
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
            $('#restaurant_id1').val(operation.restaurant_id)
            $('#food1').val(operation.food)
            $('#price1').val(operation.price)
            $('#id').val(operation.id)
            $('#Editmenu').modal('show');
        });

        fetch_data();

        function fetch_data(restaurant_id = ''){
            $('#FilterData').DataTable({
            processing: true,
            // serverSide: true,
            ajax: {
                url:"/menus",
                data: {restaurant_id:restaurant_id}
            },
            columns:[
                {
                data: 'id',
                },
                {
                data: 'name',
                name: 'name',
                orderable: false
                },
                {
                data: 'food',
                name: 'food',
                },
                {
                data:'price',
                name:'price'
                },
                {
                data:'action',
                name:'action'
                },
            ]
            });
        }

        $('#filters').change(function(){
        var restaurant_id = $('#filters').val();
        $('#FilterData').DataTable().destroy();
        fetch_data(restaurant_id);
    });

})
</script>
@endsection
