@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div>
        <h3>Show Product</h3>

        <a href="{{ route('admin.product.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $product->slug }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $product->description }}</td>
                    </tr>
                    <tr>
                        <th>More Description</th>
                        <td>{!! $product->moreDescription !!}</td>
                    </tr>
                    <tr>
                        <th>Additional Infos</th>
                        <td>{{ $product->additionnalInfos }}</td>
                    </tr>
                    <tr>
                        <th>Stock</th>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <th>Solde Price</th>
                        <td>{{ $product->soldePrice }}</td>
                    </tr>
                    <tr>
                        <th>Regular Price</th>
                        <td>{{ $product->regularPrice }}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            <div class="form-group d-flex" id="preview_imageUrls" style="max-width: 100%;">
                                @php
                                    $imageUrl = is_string($product->imageUrls) ? $product->imageUrls : json_decode($product->imageUrls, true)[0] ?? null;
                                @endphp

                                @if ($imageUrl)
                                    <img src="{{ Str::startsWith($imageUrl, 'http') ? $imageUrl : Storage::url($imageUrl) }}"
                                        alt="Prévisualisation de l'image" style="max-width: 100px; display: block;" />
                                @else
                                    <p>Aucune image disponible</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Brand</th>
                        <td>{{ $product->brand }}</td>
                    </tr>

                    @php
                        $checkboxes = [
                            'isAvailable' => 'Available',
                            'isBestSeller' => 'Best Seller',
                            'isNewArrival' => 'New Arrival',
                            'isFeatured' => 'Featured',
                            'isSpecialOffer' => 'Special Offer'
                        ];
                    @endphp

                    @foreach ($checkboxes as $key => $label)
                        <tr>
                            <th>{{ $label }}</th>
                            <td>
                                <div class="form-check form-switch">
                                    <input name="{{ $key }}" disabled id="{{ $key }}" value="true" 
                                        data-bs-toggle="toggle" {{ $product->$key ? 'checked' : '' }}
                                        class="form-check-input" type="checkbox" role="switch" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" class="btn btn-primary my-1">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
            </div>
        </div>
    </div>
@endsection
