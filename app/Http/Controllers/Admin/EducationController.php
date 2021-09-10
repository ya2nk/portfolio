<?php

namespace App\Http\Controllers\Admin;

use App\Models\Education;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class EducationController extends Controller
{
    public function index(Education $education)
    {
        if (request()->ajax()) {
            $education = Education::latest();
    
                return DataTables::of($education)
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

        return view('admin.education.index', compact('education'));
    }

    public function store (Request $request)
    {
        $request->validate([
            'year' => 'required',
            'school' => 'required',
            'title' => 'required',
        ]);

        $education = Education::updateOrCreate(['id' => $request->id], [
            'year' => $request->year,
            'school' => $request->school,
            'title' => $request->title,
          ]);

        return response()->json($education);
    }

    public function edit($id)
    {
        $decrypt = Crypt::decryptString($id);
        $education = Education::find($decrypt);

        return response()->json($education);
    }

    public function destroy($id)
    {
        $decrypt = Crypt::decryptString($id);
        $data = Education::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
