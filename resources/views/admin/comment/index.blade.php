@extends('admin.layout.base')

@section('head-title')
<title>Comment</title>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page"><span>Comment</span></li>
@endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="widget widget-content-area br-4">
            <div class="widget-one">
                
                <table id="dtable" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="no-content dt-no-sorting">No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th class="text-center">Date</th>
                            <th class="no-content dt-no-sorting text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1
                        @endphp
                        @foreach ($comment as $p)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->subject }}</td>
                            <td>{{ Str::limit($p->description, 50, $end='...') }}</td>
                            <td class="text-center">{{ $p->created_at }}</td>
                            <td class="text-center">
                                <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ Crypt::encryptString($p->id) }}"
                                    class="viewData btn btn-sm btn-primary" title="view"><i class="far fa-eye"></i></a>
                            </td>
                        </tr>
                        @php
                        $i++
                        @endphp
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="ajaxModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-12 col-md-12">
                <div class="name">
                    <h4 class="user-name" id="name"></h4>
                </div>
                <div class="email-time">
                   <p class="user-email" id="email"></p>
                </div>
                <hr>
                <p class="modal-text" id="description"></p>
               </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    .user-name{
        color:#2196f3;
        margin-bottom: 0;
        font-size: 21px;
        font-weight: 700;
    }
    .user-email{
        font-size: 14px;
        color: #3b3f5c
    }
    .modal-title {
        color:#3b3f5c;
        margin-bottom: 0;
        font-size: 24px;
        font-weight: 700;
    }
</style>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/table/datatable/dt-global_style.css') }}">
@endpush

@push('js-external')
<script src="{{ asset('admin/plugins/table/datatable/datatables.js') }}"></script>
@endpush

@push('js-internal')
<script>
    $(function () {
        $('#dtable').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5
        });

        $('body').on('click', '.viewData', function () {
                var id = $(this).data('id');
                $.get(' comment/' + id, function (data) {
                    $('#titleModal').html (data.subject);
                    $('#ajaxModal').modal('show');
                    $('#id').val(data.id);
                    $('#name').text(data.name);
                    $('#email').text(data.email);
                    $('#subject').text(data.subject);
                    $('#description').text(data.description);
                })
        });

    });
</script>
@endpush
