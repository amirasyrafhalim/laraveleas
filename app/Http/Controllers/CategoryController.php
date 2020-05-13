<?php

namespace App\Http\Controllers;

use App\Category;
use App\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{

    /**
     * constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Redirect to skill create.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return redirect('category/create');
    }

    /**
     * Show category form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {    
        $this->authorize('create', Event::class);
        $categories = Category::all();
        $user= Auth::user();
        return view('categories.create', compact('categories'));
    }

    /**
     * Store the categories.
     *
     * @param Skill $skill
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Category $category, Request $request)
    {
        
        $request->validate([
            'title' => 'required|min:2|max:255',
            
        ]);

         Category::create([
             'title' => $request->title,

         ]);

         return redirect()->back();
    }

    /**
     * Delete the categories.
     *
     * @param Skill $skill
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}

