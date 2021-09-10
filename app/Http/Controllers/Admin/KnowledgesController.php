<?php

namespace App\Http\Controllers\Admin;

use App\Models\Knowledges;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class KnowledgesController extends Controller
{
    public function index(Knowledges $knowledges)
    {
        if (request()->ajax()) {
            $knowledges = Knowledges::latest();
    
                return DataTables::of($knowledges)
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

        return view('admin.knowledges.index', compact('knowledges'));
    }

    public function store (Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $knowledges = Knowledges::updateOrCreate(['id' => $request->id], [
            'title' => $request->title,
          ]);

        return response()->json($knowledges);
    }


    public function edit($id)
    {
        $decrypt = Crypt::decryptString($id);
        $knowledges = Knowledges::find($decrypt);

        return response()->json($knowledges);
    }

    public function destroy($id)
    {
        $decrypt = Crypt::decryptString($id);
        $data = Knowledges::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
