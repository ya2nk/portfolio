@if ($errors->any())
<div class="alert alert-arrow-right alert-icon-right alert-light-danger mb-4" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg"
            data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg></button>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12" y2="16"></line>
    </svg>
    <strong>Warning!</strong>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</div>
@endif

{{-- Create Modal --}}
<div class="modal fade" id="ajaxModal" tabindex="-1" aria-labelledby="ajaxModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal"></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ajaxForm" name="ajaxForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
			            <label for="tagline">Tagline</label>
			            <input type="text" name="tagline" id="tagline" class="form-control" >
			        </div>

                    <div class="modal-footer">
			            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
			            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
			        </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">WARNING!!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Are you sure want to delete?</b></p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="button" class="btn btn-danger" name="btnDelete" id="btnDelete">Delete</button>
            </div>
        </div>
    </div>
</div>


@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/elements/alert.css') }}">
<link href="{{ asset('admin/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/sweetalerts/sweetalert2.min.css') }}">
@endpush

@push('js-external')
<script src="{{ asset('admin/plugins/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('admin/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
@endpush

@push('js-internal')
<script>
    $(function () {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        var datatable = $('#dtable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columns: [{
                        "data": 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: "10%",
                        className: 'text-center'
                    },
                    {
                        data: 'tagline',
                        name: 'tagline'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'

                    },
                ],
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
                "pageLength": 5,
        });

        $('#createNew').click(function () {
                $('#saveBtn').val("create-tagline");
                $('#id').val('');
                $('#ajaxFrom').trigger("reset");
                $('#titleModal').html("Create Tagline");
                $('#ajaxModal').modal('show');
        });

        $('body').on('click', '.editData', function () {
                var id = $(this).data('id');
                $.get(' tagline/' + id + '/edit', function (data) {
                    $('#titleModal').html("Edit " + data.tagline);
                    $('#saveBtn').val("edit-tagline");
                    $('#ajaxModal').modal('show');
                    $('#id').val(data.id);
                    $('#tagline').val(data.tagline);
                })
        });

        $('#ajaxForm').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('tagline.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#ajaxForm').trigger("reset");
                    $("#ajaxModal").modal('hide');
                    var oTable = $('#dtable').dataTable();
                    oTable.fnDraw(false);
                    $("#saveBtn").html('Submit');
                    $("#saveBtn").attr("disabled", false);
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        padding: '2em'
                    });
                    toast({
                        type: 'success',
                        title: data.tagline + ' data is successfully saved',
                        padding: '2em',
                    })
                },
                error: function (data) {
                    console.log('Error:', data);
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        padding: '6em'
                    });
                    toast({
                        type: 'error',
                        title: ' Tagline must be filled',
                        padding: '2em',
                    })
                    $('#saveBtn').html('Save');
                }
            });
        });

        $(document).on('click', '.deleteData', function () {
            data = $(this).attr('id');
            $('#deleteModal').modal('show');
        });
        
        $('#btnDelete').click(function () {
                $.ajax({
                    url: "tagline/" + data,
                    type: 'delete',
                    beforeSend: function () {
                        $('#btnDelete').text('Delete');
                    },
                    success: function (data) {
                        setTimeout(function () {
                            $('#deleteModal').modal('hide');
                            var oTable = $('#dtable').dataTable();
                            oTable.fnDraw(false);
                            const toast = swal.mixin({
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 3000,
                                padding: '2em'
                            });
                            toast({
                                type: 'success',
                                title: ' Tagline is successfully delete',
                                padding: '2em',
                            })
                        });

                    }
                })
            })
    });
</script>
@endpush