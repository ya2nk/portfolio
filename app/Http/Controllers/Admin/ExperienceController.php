<?php

namespace App\Http\Controllers\Admin;

use App\Models\Experience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class ExperienceController extends Controller
{
    public function index(Experience $experience)
    {
        if (request()->ajax()) {
            $experience = Experience::latest();
    
                return DataTables::of($experience)
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

        return view('admin.experience.index', compact('experience'));
    }

    public function store (Request $request)
    {
        $request->validate([
            'company' => 'required',
            'year' => 'required',
            'title' => 'required',
        ]);

        $experience = Experience::updateOrCreate(['id' => $request->id], [
            'company' => $request->company,
            'year' => $request->year,
            'title' => $request->title,
          ]);

        return response()->json($experience);
    }

    public function edit($id)
    {
        $decrypt = Crypt::decryptString($id);
        $experience = Experience::find($decrypt);

        return response()->json($experience);
    }

    public function destroy($id)
    {
        $decrypt = Crypt::decryptString($id);
        $data = Experience::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
