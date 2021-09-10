<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = Config::all()->first();

        return view('admin.config.index', compact('config'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nameweb' => 'required',
            'about' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keywords' => 'required',
            'description' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'facebook' => 'required|url',
            'instagram' => 'required|url',
            'twitter' => 'required|url',
            'github' => 'required|url',
            'linkedin' => 'required|url',
            'google_maps' => 'required',

        ]);

        $config = Config::findOrFail($id);

        if ($request->hasFile('logo')) {
            $img = $request->file('logo');
            $config['logo'] = time().'-'. $img->getClientOriginalName();

            $filePath = public_path('/upload/config');
            $img->move($filePath, $config['logo']);
        } else {
            $img = $config->logo;
        }

        if ($request->hasFile('icon')) {
            $img = $request->file('icon');
            $config['icon'] = time().'-'. $img->getClientOriginalName();

            $filePath = public_path('/upload/config');
            $img->move($filePath, $config['icon']);
        } else {
            $img = $config->icon;
        }

        $config->update([
            'nameweb' => $request->nameweb,
            'about' => $request->about,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'github' => $request->github,
            'linkedin' => $request->linkedin,
            'google_maps' => $request->google_maps,
            'logo' => $config['logo'],
            'icon' => $config['icon']
        ]);

        Alert::toast('Update Configuration Success', 'success')->position('top');
        return redirect()->route('configuration.index');
    }
}
