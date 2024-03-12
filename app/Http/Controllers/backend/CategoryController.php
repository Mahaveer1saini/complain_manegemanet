<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
        public function index()
        {
            $categories = categories::all();
            return view('Admin.category.categorylist', compact('categories'));
          
           

        }

        public function create()
        {
          return view('Admin.category.categorycreate');
        }

        public function store(Request $request)
        {
            $request->validate([
                'categoryName' => 'required',
                'categoryDescription' => 'required',
            ]);

            categories::create($request->all());

            return redirect()->route('user.categories.index')
                ->with('success', 'Category created successfully.');
        }

        public function edit(categories $category)
        {
            return view('Admin.edit', compact('category'));
        }

        public function update(Request $request, categories $category)
        {
            $request->validate([
                'categoryName' => 'required',
                'categoryDescription' => 'required',
            ]);

            $category->update($request->all());
            return redirect()->route('categories.index')
                ->with('success', 'Category updated successfully');
        }

        public function destroy(categories $category)
        {
            $category->delete();
            return redirect()->route('user.categories.index')
            ->with('success', 'Category deleted successfully');
        }
}
