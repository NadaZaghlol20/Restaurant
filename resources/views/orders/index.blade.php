@extends('layouts.admin')
@section('content')
    {{-- <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" style="color:white;cursor: pointer" data-toggle="modal" data-target="#order">
                اضافة طلب طعام
            </a>
            <button class="btn btn-info" style="color:white;cursor: pointer" onClick="print()">
                طباعة
            </button>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header">
            إنشـــاء طلـــب
        </div>

        <div class="card-body">
            <form method="POST" action="/orders_create" enctype="multipart/form-data">
                @csrf
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">معلومات العميــل</a>
                      <a class="nav-item nav-link" id="nav-menu-tab" data-toggle="tab" href="#nav-menu"  role="tab"  aria-controls="nav-menu" aria-selected="false">الطعــام</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="container-fluid">
                            <div class="row mt-5">
                                <div class="col-12">
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4">إسم العميل :</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="name" id="name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone" class="col-md-4">رقم العميل :</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="phone" id="phone">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="address" class="col-md-4">عنوان العميل :</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="address" id="address">
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-menu" role="tabpanel" aria-labelledby="nav-menu-tab">
                        <div class="container-fluid">
                            <div class="row mt-5">
                                <div class="col-12">
                                    <div class="card">
                                        {{-- <div class="card-header">
                                            <h5 for="restaurant" class="col-md-4">إختار مطعم :</h5>
                                            <div class="col-md-3">
                                                <select class="form-control" name="restaurant" id="filters">
                                                    <option value="-1" selected>إختــر مطعم</option>
                                                    @foreach ($restaurants as $res)
                                                    <option value="{{$res->id}}">{{$res->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="Table">
                                                    <thead>
                                                        <tr>
                                                            <th>&nbsp;</th>
                                                            <th>الرقم التعريفى</th>
                                                            <th>إسم المطعم</th>
                                                            <th>إسم الطعام</th>
                                                            <th>السعر</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($menus as $key => $menu)
                                                            <tr data-entry-id="{{ $menu->id }}">
                                                            <td><input type="checkbox" name="selctIds[]" id="select" value="{{$menu->id}}"></td>
                                                                <td>{{ $menu->id ?? '' }}</td>
                                                                <td>{{ $menu->name ?? '' }}</td>
                                                                <td>{{ $menu->food ?? '' }}</td>
                                                                <td>{{ $menu->price ?? '' }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group pt-2 ml-3 float-right">
                            <button class="btn btn-success" type="submit">إنشـــاء</button>
                        </div>
                    </div>
                </div>
            </form>

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

        $(document).ready(function() {
            $('#select').selectpicker();
        });

        $('.edit-operations-button').click(function(e){
            e.preventDefault()
            let operation = JSON.parse($(this).attr('data-recObject'))
            $('#name1').val(operation.name)
            $('#phone1').val(operation.phone)
            $('#address1').val(operation.address)
            $('#id').val(operation.id)
            $('#Editorder').modal('show');
        });

        fetch_data();

        function fetch_data(restaurant_id = ''){
            $('#Table').table({
            processing: true,
            serverSide: true,
                ajax: {
                    url:"/orders",
                    data: {restaurant_id:restaurant_id}
                },
            });
        }

        $('#filters').change(function(){
        var restaurant_id = $('#filters').val();
        $('#Table').table().destroy();
        fetch_data(restaurant_id);
    });
})
</script>
@endsection
