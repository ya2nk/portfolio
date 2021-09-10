@extends('admin.layout.base')

@section('head-title')
<title>Skill</title>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page"><span>Skill</span></li>
@endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">

        <div class="row">
           <div class="col-lg-12 col-md-12">
            <a class="btn btn-primary float-right my-3" href="javascript:void(0)" id="createNew"> Create Skill</a>
           </div>
        </div>

        @include('admin.skill.addon')

        
        <div class="widget widget-content-area br-4">
            <div class="widget-one">
                
                <table id="dtable" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="no-content dt-no-sorting">No.</th>
                            <th>Skill</th>
                            <th>Percent</th>
                            <th class="no-content dt-no-sorting text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection