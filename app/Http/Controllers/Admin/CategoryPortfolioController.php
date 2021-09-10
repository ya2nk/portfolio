<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoriesPortfolio;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class CategoryPortfolioController extends Controller
{
    public function index(CategoriesPortfolio $category)
    {
        if (request()->ajax()) {
            $category = CategoriesPortfolio::latest();
    
                return DataTables::of($category)
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

        return view('admin.category.index', compact('category'));
    }

    public function store (Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $category = CategoriesPortfolio::updateOrCreate(['id' => $request->id], [
            'title' => $request->title,
          ]);

        return response()->json($category);
    }


    public function edit($id)
    {
        $decrypt = Crypt::decryptString($id);
        $category = CategoriesPortfolio::find($decrypt);

        return response()->json($category);
    }

    public function destroy($id)
    {
        $decrypt = Crypt::decryptString($id);
        $data = CategoriesPortfolio::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
