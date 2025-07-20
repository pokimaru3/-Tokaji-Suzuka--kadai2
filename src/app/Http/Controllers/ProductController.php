<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        }

        $products = $query->paginate(6)->withQueryString();

        return view('list', compact('products'));
    }

    public function add(Request $request)
    {
        return view('register');
    }

    public function show($productId)
    {
        $product = Product::find($productId);
        return view('detail', compact('product'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Product::query();

        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        $products = $query->paginate(6)->withQueryString();

        return view('list', compact('products'));
    }
    public function update(ProductRequest $request, $productId)
    {
        $product = Product::find($productId);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $product->image = $path;
        }

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description') ?? '';
        $product->save();

        if ($request->filled('seasons')) {
            $seasonIds = \App\Models\Season::whereIn('name', $request->input('seasons'))->pluck('id')->toArray();
            $product->seasons()->sync($seasonIds);
        } else {
            $product->seasons()->detach();
        }
        return redirect('/products');
    }

    public function store(RegisterRequest $request)
    {
        $path = $request->file('image')->store('images', 'public');

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $path,
            'description' => $request->description,
        ]);

        return redirect('/products');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->seasons()->detach();
        $product->delete();

        return redirect('/products');
    }
}
