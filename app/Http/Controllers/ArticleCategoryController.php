<?php

namespace App\Http\Controllers;

use App\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleCategoryController extends Controller
{
    /**
     * @var ArticleCategory
     */
    protected $repo;

    /**
     * ArticleController constructor.
     * @param ArticleCategory $article_category
     */
    public function __construct(ArticleCategory $article_category)
    {
        $this->repo = $article_category;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.modules.article_category.index', [
            'item' => $this->repo,
            'categories' => ArticleCategory::all(),            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.article_category.form', [            
            'item' => $this->repo,
            'categories' => $this->getFormCategories('Select...')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->requestValidate($request, $this->repo);

        if ($request->exists('status')) {
            $request->merge([
                'status' => 'Published'
            ]);
        }

        $this->repo->create($request->all());

        $request->session()->forget('image');

        return redirect()->route('article_categories.index')
            ->with('success', 'Article Category Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleCategory $articleCategory)
    {
        return view('admin.modules.article_category.form', [            
            'item' => $articleCategory,
            'categories' => $this->getFormCategories('Select...', $articleCategory->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArticleCategory $articleCategory)
    {
        $this->requestValidate($request, $articleCategory);

        if ($request->exists('status')) {
            $request->merge([
                'status' => 'Published'
            ]);
        }

        $articleCategory->fill($request->all())->save();

        $request->session()->forget('image');

        return redirect()->route('article_categories.index')
            ->with('success', 'Article Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function delete(ArticleCategory $articleCategory)
    {

        $articleCategory->delete();

        return redirect()->route('article_categories.index')
            ->with('success', 'Article Category Deleted Successfully!');
    }

    /**
     * change the status resource from storage.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request,ArticleCategory $articleCategory)
    {
        if ($articleCategory->status == 'Published') {
            $request->merge(['status' => 'Draft']);
        } else {
            $request->merge(['status' => 'Published']);
        }

        $articleCategory->fill($request->all())->save();

        return redirect()->route('article_categories.index')
            ->with('success', 'Article Category Updated Successfully!');
    }

    /**
     * chnage the approval status.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function approval(Request $request,ArticleCategory $articleCategory)
    {
        if ($articleCategory->approval == 'Approved') {
            $request->merge(['approval' => 'Pending']);
        } else {
            $request->merge(['approval' => 'Approved']);
        }

        $articleCategory->fill($request->all())->save();

        return redirect()->route('article_categories.index')
            ->with('success', 'Article Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * @param string $text
     * @param null $article
     * @return array
     */
    protected function getFormCategories($text, $article = null)
    {
        return $this->repo->where('id', '<>', $article)
            ->whereNull('category_id')
            ->pluck('title', 'id')
            ->prepend($text, '')->all();
    }

    /**
     * @param Request $request
     * @param ArticleCategory $article_category
     */
    protected function requestValidate(Request $request, ArticleCategory $article_category)
    {
        $request->merge([
            'slug' => Str::slug(trim($request->title)),
            'image' => $request->session()->get('image') ? : $article_category->image
        ]);

        $request->validate([
            'title' => 'required',            
            'slug' => 'required|unique:article_categories,slug,'.$article_category->id,            
        ]);
    }
}
