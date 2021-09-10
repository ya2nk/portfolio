<?php

namespace App\Http\Controllers\Admin;

use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriesPortfolio;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolio = Portfolio::latest()->get();

        return view('admin.portfolio.index', compact('portfolio'));
    }

    public function create()
    {
        $category = CategoriesPortfolio::all();

        return view('admin.portfolio.create', compact('category'));
    }

    public function store(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $portfolio['image'] = time().'-'. $img->getClientOriginalName();

            $filePath = public_path('/upload/portfolio');
            $img->move($filePath, $portfolio['image']);
        }

        Portfolio::create([
            'title' => $request->title,
            'slug' =>  Str::slug($request->title),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $portfolio['image']
        ]);

        Alert::toast('Create Portfolio Success', 'success')->position('top');
        return redirect()->route('portfolio.index');
    }

    public function edit($id)
    {
        $decrypt = Crypt::decryptString($id);

        $category = CategoriesPortfolio::all();
        $portfolio = Portfolio::findOrFail($decrypt);

        return view('admin.portfolio.edit', compact('portfolio','category'));
    }

    public function update (Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $decrypt = Crypt::decryptString($id);
        $portfolio = Portfolio::findOrFail($decrypt);

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $portfolio['image'] = time().'-'. $img->getClientOriginalName();

            $filePath = public_path('/upload/portfolio');
            $img->move($filePath, $portfolio['image']);
        } else {
            $img = $portfolio['image'];
        } 
        
        $portfolio->update([
            'title' => $request->title,
             'slug' =>  Str::slug($request->title),
             'category_id' => $request->category_id,
             'description' => $request->description,
             'image' => $portfolio['image']
         ]);
 

        Alert::toast('Update Portfolio Success', 'success')->position('top');
        return redirect()->route('portfolio.index');
    }

    public function destroy($id)
    {
        Portfolio::findOrFail($id)->delete();

        Alert::toast('Delete Portfolio Success', 'success')->position('top');
        return redirect()->route('portfolio.index');
    }
}
