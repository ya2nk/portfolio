<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use App\Models\Config;
use App\Models\Comment;
use App\Models\Tagline;
use App\Models\Education;
use App\Models\Portfolio;
use App\Models\Experience;
use App\Models\Knowledges;
use Illuminate\Http\Request;
use App\Models\CategoriesPortfolio;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {

        $user = User::all()->first();
        $config = Config::all()->first();
        $tagline = Tagline::all();
        $education = Education::latest()->get();
        $experience = Experience::latest()->get();
        $knowledges = Knowledges::latest()->get();
        $skill = Skill::all();
        $category = CategoriesPortfolio::all();
        $portfolio = Portfolio::all();
        return view('frontend.index', compact('user', 'config', 'tagline', 'education', 'experience', 'knowledges', 'skill','category', 'portfolio'));
    }

    public function detail($slug)
    {

        $user = User::all()->first();
        $config = Config::all()->first();
        $tagline = Tagline::all();
        $category = CategoriesPortfolio::all();
        $portfolio = Portfolio::where('slug', $slug)->firstOrFail();
        return view('frontend.detail', compact('user', 'config', 'tagline','category', 'portfolio'));
    }

    public function createComment(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'description' => 'required'
        ]);

        $comment = Comment::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'description' => $request->description,
        ]);

        return response()->json($comment);
    }
}
