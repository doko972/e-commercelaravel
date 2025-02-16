<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;

class ProductController extends Controller
{
    public function load()
    {
        if (Product::all()->count() < 5) {
            $filePath = __DIR__ . "/products.json";
            $fileContent = file_get_contents($filePath);

            $products = json_decode($fileContent, true);

            foreach ($products as $key => $product) {
                $imageUrls = array_map(fn ($image) => "images/" . $image, $product["imageUrls"]);

                Product::create([
                    'name' => $product["name"],
                    'slug' => Str::slug($product["name"] . ' ' . $key),
                    'description' => $product["description"],
                    'moreDescription' => $product["more_description"],
                    'additionnalInfos' => $product["more_description"],
                    'stock' => rand(200, 600),
                    'soldePrice' => $product["solde_price"],
                    'regularPrice' => $product["regular_price"],
                    'imageUrls' => json_encode($imageUrls),
                    'isAvailable' => (bool) $product["isAvailable"],
                    'isBestSeller' => (bool) $product["isBestSeller"],
                    'isNewArrival' => (bool) $product["isNewArrival"],
                    'isFeatured' => (bool) $product["isFeatured"],
                    'isSpecialOffer' => (bool) $product["isSpecialOffer"],
                ]);
            }

            return ['result' => "created"];
        }

        return ['result' => "error"];
    }

    public function index(Request $request): View
    {
        $query = Product::query();

        // Application des filtres uniquement si la valeur est "1"
        if ($request->input('is_new_arrival') == 1) {
            $query->where('isNewArrival', 1);
        }
        if ($request->input('is_featured') == 1) {
            $query->where('isFeatured', 1);
        }
        if ($request->input('is_special_offer') == 1) {
            $query->where('isSpecialOffer', 1);
        }
        if ($request->input('is_best_seller') == 1) {
            $query->where('isBestSeller', 1);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('products.index', compact('products'));
    }

    public function show($id): View
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function edit($id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function store(ProductFormRequest $req): RedirectResponse
    {
        $data = $req->validated();
        
        // Conversion explicite des booléens
        $data['isAvailable'] = $req->boolean('isAvailable') ? 1 : 0;
        $data['isBestSeller'] = $req->boolean('isBestSeller') ? 1 : 0;
        $data['isNewArrival'] = $req->boolean('isNewArrival') ? 1 : 0;
        $data['isFeatured'] = $req->boolean('isFeatured') ? 1 : 0;
        $data['isSpecialOffer'] = $req->boolean('isSpecialOffer') ? 1 : 0;

        if ($req->hasFile('imageUrls')) {
            $data['imageUrls'] = json_encode($this->handleImageUpload($req->file('imageUrls')));
        }

        $product = Product::create($data);
        $product->categories()->sync($req->validated('categories', []));

        return redirect()->route('admin.product.show', ['id' => $product->id]);
    }

    public function update(Product $product, ProductFormRequest $req)
    {
        $data = $req->validated();

        // Conversion explicite des booléens
        $data['isAvailable'] = $req->boolean('isAvailable') ? 1 : 0;
        $data['isBestSeller'] = $req->boolean('isBestSeller') ? 1 : 0;
        $data['isNewArrival'] = $req->boolean('isNewArrival') ? 1 : 0;
        $data['isFeatured'] = $req->boolean('isFeatured') ? 1 : 0;
        $data['isSpecialOffer'] = $req->boolean('isSpecialOffer') ? 1 : 0;

        if ($req->hasFile('imageUrls')) {
            $uploadedImages = $this->handleImageUpload($req->file('imageUrls'));

            if (!empty($product->imageUrls)) {
                $oldImages = json_decode($product->imageUrls, true);
                if (is_array($oldImages)) {
                    foreach ($oldImages as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            $data['imageUrls'] = json_encode($uploadedImages);
        }

        $product->update($data);
        $product->categories()->sync($req->validated('categories', []));

        return redirect()->route('admin.product.show', ['id' => $product->id]);
    }

    public function updateSpeed(Product $product, Request $req)
    {
        $data = $req->all();

        // Forcer la conversion des booléens
        foreach (['isAvailable', 'isBestSeller', 'isNewArrival', 'isFeatured', 'isSpecialOffer'] as $field) {
            if ($req->has($field)) {
                $data[$field] = $req->boolean($field) ? 1 : 0;
            }
        }

        $product->update($data);

        return [
            'isSuccess' => true,
            'data' => $data
        ];
    }

    public function delete(Product $product)
    {
        if (!empty($product->imageUrls)) {
            $images = json_decode($product->imageUrls, true);
            if (is_array($images)) {
                foreach ($images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $product->delete();
        return ['isSuccess' => true];
    }

    private function handleImageUpload($images): array
    {
        $uploadedImages = [];

        if (!is_array($images)) {
            $images = [$images]; 
        }

        foreach ($images as $image) {
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->storeAs('images', $imageName, 'public');
            $uploadedImages[] = 'images/' . $imageName;
        }

        return $uploadedImages;
    }
}
