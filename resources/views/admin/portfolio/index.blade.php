@extends('admin.layout.base')

@section('head-title')
<title>Portfolio</title>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page"><span>Portfolio</span></li>
@endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">

        <div class="row">
           <div class="col-lg-12 col-md-12">
            <a class="btn btn-primary float-right my-3" href="{{ route('portfolio.create') }}"> Create Portfolio</a>
           </div>
        </div>



        <div class="widget widget-content-area br-4">
            <div class="widget-one">
                
                <table id="dtable" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="no-content dt-no-sorting">No.</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Category</th>
                            {{-- <th>Description</th> --}}
                            <th class="no-content dt-no-sorting text-center">Image</th>
                            <th class="no-content dt-no-sorting text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1
                        @endphp
                        @foreach ($portfolio as $p)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $p->title }}</td>
                            <td>{{ $p->slug }}</td>
                            <td>{{ $p->categories->title }}</td>
                            {{-- <td>{!! Str::limit($p->description, 50, $end='...') !!}</td> --}}
                            <td class="text-center"><img src="{{ asset('upload/portfolio/'. $p->image) }}"
                                    class="rounded" width="50px" height="50px" alt="image"></td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Are you sure ?');"
                                    action="{{ route('portfolio.destroy', $p->id) }}" method="POST">
                                    <a href="{{ route('portfolio.edit', Crypt::encryptString($p->id)) }}" title="Edit"
                                        class="btn btn-primary btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i
                                            class="far fa-trash-alt"></i>
                                    </button>
                                    @method('delete')
                                    @csrf()
                                </form>
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
    });
</script>
@endpush