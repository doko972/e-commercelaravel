<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(5);
        return view('products/index', ['products' => $products]);
    }

    public function show($id): View
    {
        $product = Product::findOrFail($id);
        return view('products/show', ['product' => $product]);
    }

    public function create(): View
    {
        return view('products/create');
    }

    public function edit($id): View
    {
        $product = Product::findOrFail($id);
        return view('products/edit', ['product' => $product]);
    }

    public function store(ProductFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

        // Convertir les booléens en 0 ou 1
        $data['isAvaible'] = $req->boolean('isAvaible');
        $data['isBestSeller'] = $req->boolean('isBestSeller');
        $data['isNewArrival'] = $req->boolean('isNewArrival');
        $data['isFeatured'] = $req->boolean('isFeatured');
        $data['isSpecialOffer'] = $req->boolean('isSpecialOffer');

        if ($req->hasFile('imageUrls')) {
            $data['imageUrls'] = json_encode($this->handleImageUpload($req->file('imageUrls')));
        }

        $product = Product::create($data);
        return redirect()->route('admin.product.show', ['id' => $product->id]);
    }

    public function update(Product $product, ProductFormRequest $req)
    {
        $data = $req->validated();

        // Convertir les booléens en 0 ou 1
        $data['isAvaible'] = $req->boolean('isAvaible');
        $data['isBestSeller'] = $req->boolean('isBestSeller');
        $data['isNewArrival'] = $req->boolean('isNewArrival');
        $data['isFeatured'] = $req->boolean('isFeatured');
        $data['isSpecialOffer'] = $req->boolean('isSpecialOffer');

        if ($req->hasFile('imageUrls')) {
            $uploadedImages = $this->handleImageUpload($req->file('imageUrls'));

            // Suppression des anciennes images
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
        return redirect()->route('admin.product.show', ['id' => $product->id]);
    }

    public function updateSpeed(Product $product, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $product->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Product $product)
    {
        // Suppression des images associées
        if (!empty($product->imageUrls)) {
            $images = json_decode($product->imageUrls, true);
            if (is_array($images)) {
                foreach ($images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $product->delete();
        return [
            'isSuccess' => true
        ];
    }

    private function handleImageUpload(\Illuminate\Http\UploadedFile|array $images): array
    {
        $uploadedImages = [];

        if (!is_array($images)) {
            $images = [$images]; // Convertir un fichier unique en tableau
        }

        foreach ($images as $image) {
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->storeAs('images', $imageName, 'public');
            $uploadedImages[] = 'images/' . $imageName;
        }

        return $uploadedImages;
    }
}
