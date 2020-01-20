<?php

namespace App\Http\Controllers;

use App\Category;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::where('user_id',Auth::id())->get();
        return view('category/index', [
            'categories'=>$categories
        ]);
    }

    public function category_new() {
        return view('category/category', [
            'id'=>'new',
            'category'=>new Category()
        ]);
    }

    public function category($id) {
        $category = Category::where('user_id',Auth::id())->where('id', $id)->with('reviews')->firstOrFail();
        return view('category/category', [
            'id'=>$id,
            'category'=>$category
        ]);
    }

    public function postCategory(Request $request, $id) {
        if ($id=='new') {
            $category = new Category();
            $category->user_id = Auth::id();
            $successful_status = "Category created.";
        } else {
            $category = Category::where('user_id',Auth::id())->where('id', $id)->firstOrFail();
            $successful_status = "Category updated.";
        }
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->save();

        return redirect('category/'.$category->id)
            ->with(['status'=>$successful_status]);
    }

    public function deleteCategory($id) {
        $category = Category::where('user_id',Auth::id())->where('id', $id)->firstOrFail();
        DB::delete('delete from category_review WHERE category_id='.$category->id);
        $category->delete();
        return redirect('category')
            ->with(['status'=>'Category removed.']);
    }

    public function searchReviewCategory(Request $request, $id) {
        $search = $request->get('search');
        $search_results = [];
        $search_results['title'] = Review::where('title','LIKE','%'.$search.'%')->orderBy('title')->limit(20)->get();
        $search_results['description'] = Review::where('description_fulltext','LIKE','%'.$search.'%')->orderBy('description_fulltext')->limit(20)->get();

        $category = Category::where('user_id',Auth::id())->where('id', $id)->with('reviews')->firstOrFail();

        return view('category/category', [
            'id'=>$id,
            'category'=>$category,
            'search_results'=>$search_results
        ]);
    }

    public function postAddCategoryReview($id, $review_id) {
        $review = Review::where('id',$review_id)->firstOrFail();
        $category = Category::where('user_id',Auth::id())->where('id', $id)->firstOrFail();

        $category->reviews()->save($review);
        return redirect('category/'.$id)
            ->with(['status'=>'Film added.']);
    }

    public function postDeleteCategoryReview($id, $review_id) {
        $review = Review::where('id',$review_id)->firstOrFail();
        $category = Category::where('user_id',Auth::id())->where('id', $id)->firstOrFail();

        DB::delete('delete from category_review where category_id='.$category->id.' AND review_id='.$review->id);

        return redirect('category/'.$id)
            ->with(['status'=>'Film removed.']);
    }
}
