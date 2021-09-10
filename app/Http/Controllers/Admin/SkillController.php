<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class SkillController extends Controller
{
    public function index(Skill $skill)
    {
        if (request()->ajax()) {
            $skill = Skill::latest();
    
                return DataTables::of($skill)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.Crypt::encryptString($data->id) .'"
                            class="editData btn btn-sm btn-info" title="Edit"><i class="far fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip" id="'.Crypt::encryptString($data->id).'"
                            class="btn btn-sm btn-danger deleteData" title="Delete"><i class="far fa-trash-alt"></i></a>
                    ';
                })
                ->editColumn('percent', function ($data) {
                    return '
                        <span class="shadow-none badge badge-primary">'.$data->percent.'% </span>
                    ';
                })
                ->rawColumns(['action', 'percent'])
                ->make();
        }

        return view('admin.skill.index', compact('skill'));
    }

    public function store (Request $request)
    {
        $request->validate([
            'title' => 'required',
            'percent' => 'required'
        ]);

        $skill = Skill::updateOrCreate(['id' => $request->id], [
            'title' => $request->title,
            'percent' => $request->percent,
          ]);

        return response()->json($skill);
    }


    public function edit($id)
    {
        $decrypt = Crypt::decryptString($id);
        $skill = Skill::find($decrypt);

        return response()->json($skill);
    }

    public function destroy($id)
    {
        $decrypt = Crypt::decryptString($id);
        $data = Skill::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
