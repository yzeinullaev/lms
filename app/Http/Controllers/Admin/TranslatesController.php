<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Translate;
use Illuminate\Http\Request;

class TranslatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $translates = Translate::where('data', 'LIKE', "%$keyword%")
                ->orWhere('language_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $translates = Translate::latest()->paginate($perPage);
        }

        return view('admin.translates.index', compact('translates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.translates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Translate::create($requestData);

        return redirect('admin/translates')->with('flash_message', 'Translate added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $translate = Translate::findOrFail($id);

        return view('admin.translates.show', compact('translate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $translate = Translate::findOrFail($id);

        return view('admin.translates.edit', compact('translate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $translate = Translate::findOrFail($id);
        $translate->update($requestData);

        return redirect('admin/translates')->with('flash_message', 'Translate updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Translate::destroy($id);

        return redirect('admin/translates')->with('flash_message', 'Translate deleted!');
    }
}
