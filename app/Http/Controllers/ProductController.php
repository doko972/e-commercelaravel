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
                $imageUrls = array_map(function ($imageUrls) {
                    return "images/" . $imageUrls;
                }, $product["imageUrls"]);
                $newProduct = new Product();
                $newProduct->name = $product["name"];
                $newProduct->slug = Str::slug($product["name"].' '.$key);
                $newProduct->description = $product["description"];
                $newProduct->moreDescription = $product["more_description"];
                $newProduct->additionnalInfos = $product["more_description"];
                $newProduct->stock = rand(200, 600);
                $newProduct->soldePrice = $product["solde_price"];
                $newProduct->regularPrice = $product["regular_price"];
                $newProduct->imageUrls = json_encode($product["imageUrls"]);
                $newProduct->isAvailable = $product["isAvailable"];
                $newProduct->isBestSeller = $product["isBestSeller"];
                $newProduct->isNewArrival = $product["isNewArrival"];
                $newProduct->isFeatured = $product["isFeatured"];
                $newProduct->isSpecialOffer = $product["isSpecialOffer"];

                $newProduct->save();
            }
            return [
                'result' => "created"
            ];
        }
        return [
            'result' => "error"
        ];
    }
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
        $categories = Category::all();
        return view('products/create', ['categories' => $categories]);
    }

    public function edit($id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products/edit', ['product' => $product, 'categories' => $categories]);
    }

    public function store(ProductFormRequest $req): RedirectResponse
    {
        $categories = $req->validated('$categories');
        $data = $req->validated();

        // Convertir les booléens en 0 ou 1
        $data['isAvailable'] = $req->boolean('isAvailable');
        $data['isBestSeller'] = $req->boolean('isBestSeller');
        $data['isNewArrival'] = $req->boolean('isNewArrival');
        $data['isFeatured'] = $req->boolean('isFeatured');
        $data['isSpecialOffer'] = $req->boolean('isSpecialOffer');

        if ($req->hasFile('imageUrls')) {
            $data['imageUrls'] = json_encode($this->handleImageUpload($req->file('imageUrls')));
        }

        $product = Product::create($data);
        $product->categories()->sync($categories);

        return redirect()->route('admin.product.show', ['id' => $product->id]);
    }

    public function update(Product $product, ProductFormRequest $req)
    {
        $categories = $req->validated('categories');
        $data = $req->validated();

        // Convertir les booléens en 0 ou 1
        $data['isAvailable'] = $req->boolean('isAvailable');
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

        $product->categories()->sync($categories);
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
