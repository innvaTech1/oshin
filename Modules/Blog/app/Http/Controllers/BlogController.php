<?php

namespace Modules\Blog\app\Http\Controllers;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Modules\Blog\app\Http\Requests\PostRequest;
use Modules\Blog\app\Models\Blog;
use Modules\Blog\app\Models\BlogCategory;
use Modules\Language\app\Enums\TranslationModels;
use Modules\Language\app\Models\Language;
use Modules\Language\app\Traits\GenerateTranslationTrait;

class BlogController extends Controller
{
    use GenerateTranslationTrait, RedirectHelperTrait;

    public function index(Request $request)
    {
        abort_unless(checkAdminHasPermission('blog.view'), 403);
        $query = Blog::query();

        $query->when($request->filled('keyword'), function ($qa) use ($request) {
            $qa->whereHas('translations', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%');
                $q->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        });

        $query->when($request->filled('is_popular'), function ($q) use ($request) {
            $q->where('is_popular', $request->is_popular);
        });

        $query->when($request->filled('show_homepage'), function ($q) use ($request) {
            $q->where('show_homepage', $request->show_homepage);
        });

        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('status', $request->status);
        });

        $query->when($request->filled('order_by'), function ($q) use ($request) {
            $q->orderBy('id', $request->order_by == 1 ? 'asc' : 'desc');
        });

        if ($request->filled('par-page')) {
            $posts = $request->get('par-page') == 'all' ? $query->get() : $query->paginate($request->get('par-page'))->withQueryString();
        } else {
            $posts = $query->paginate()->withQueryString();
        }

        return view('blog::Post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(checkAdminHasPermission('blog.create'), 403);
        $categories = BlogCategory::all();

        return view('blog::Post.create', ['categories' => $categories]);
    }

    public function store(PostRequest $request): RedirectResponse
    {
        abort_unless(checkAdminHasPermission('blog.store'), 403);
        $blog = Blog::create(array_merge(['admin_id' => Auth::guard('admin')->user()->id], $request->validated()));

        if ($blog && $request->hasFile('image')) {
            $file_name = file_upload($request->image, $blog->image, 'uploads/custom-images/');
            $blog->image = $file_name;
            $blog->save();
        }

        $this->generateTranslations(
            TranslationModels::Blog,
            $blog,
            'blog_id',
            $request,
        );

        return $this->redirectWithMessage(
            RedirectType::CREATE->value,
            'admin.blogs.edit',
            [
                'blog' => $blog->id,
                'code' => allLanguages()->first()->code,
            ]
        );
    }

    public function show($id)
    {
        abort_unless(checkAdminHasPermission('blog.view'), 403);

        return view('blog::show');
    }

    public function edit($id)
    {
        abort_unless(checkAdminHasPermission('blog.edit'), 403);
        $code = request('code') ?? getSessionLanguage();
        if (!Language::where('code', $code)->exists()) {
            abort(404);
        }
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::all();
        $languages = allLanguages();

        return view('blog::Post.edit', compact('blog', 'code', 'categories', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $id)
    {
        abort_unless(checkAdminHasPermission('blog.update'), 403);
        $validatedData = $request->validated();

        $blog = Blog::findOrFail($id);

        if ($blog && !empty($request->image)) {
            $file_name = file_upload($request->image, $blog->image, 'uploads/custom-images/');
            $blog->image = $file_name;
            $blog->save();
        }
        $blog->update($validatedData);

        $this->updateTranslations(
            $blog,
            $request,
            $validatedData,
        );

        return $this->redirectWithMessage(
            RedirectType::UPDATE->value,
            'admin.blogs.edit',
            ['blog' => $blog->id, 'code' => $request->code]
        );
    }

    public function destroy($id)
    {
        abort_unless(checkAdminHasPermission('blog.delete'), 403);

        $blog = Blog::findOrFail($id);

        $blog->translations()->each(function ($translation) {
            $translation->post()->dissociate();
            $translation->delete();
        });

        if ($blog->image) {
            if (File::exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }
        }

        $blog->delete();

        return $this->redirectWithMessage(RedirectType::DELETE->value, 'admin.blogs.index');
    }

    public function statusUpdate($id)
    {
        abort_unless(checkAdminHasPermission('blog.update'), 403);

        $blog = Blog::find($id);
        $status = $blog->status == 1 ? 0 : 1;
        $blog->update(['status' => $status]);

        $notification = __('Updated Successfully');

        return response()->json([
            'success' => true,
            'message' => $notification,
        ]);
    }
}
