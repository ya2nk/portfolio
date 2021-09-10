<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tagline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;

class TaglineController extends Controller
{
    public function index(Tagline $tagline)
    {
        if (request()->ajax()) {
            $tagline = Tagline::latest();
    
                return DataTables::of($tagline)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.Crypt::encryptString($data->id) .'"
                            class="editData btn btn-sm btn-info" title="Edit"><i class="far fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip" id="'.Crypt::encryptString($data->id).'"
                            class="btn btn-sm btn-danger deleteData" title="Delete"><i class="far fa-trash-alt"></i></a>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.tagline.index', compact('tagline'));
    }

    public function store (Request $request)
    {
        $request->validate([
            'tagline' => 'required'
        ]);

        $tagline = Tagline::updateOrCreate(['id' => $request->id], [
            'tagline' => $request->tagline,
          ]);

        return response()->json($tagline);
    }


    public function edit($id)
    {
        $decrypt = Crypt::decryptString($id);
        $tagline = Tagline::find($decrypt);

        return response()->json($tagline);
    }

    public function destroy($id)
    {
        $decrypt = Crypt::decryptString($id);
        $data = Tagline::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
