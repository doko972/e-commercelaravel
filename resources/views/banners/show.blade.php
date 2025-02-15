@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div>
        <h3>Show Banner</h3>

        <a href="{{ route('admin.banner.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Title</th>
                        <td>{{ $banner->title }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $banner->description }}</td>
                    </tr>
                    <tr>
                        <th>ButtonText</th>
                        <td>{{ $banner->buttonText }}</td>
                    </tr>
                    <tr>
                        <th>ButtonLink</th>
                        <td>{{ $banner->buttonLink }}</td>
                    </tr>
                    <tr>
                        <th>ImageUrl</strong></th>
                        @php
                            $imageUrls = json_decode($banner->imageUrl, true);
                        @endphp
                        <td>
                            <div class="form-group d-flex" id="preview_imageUrl" style="max-width: 100%;">
                                @if (!empty($imageUrls) && is_array($imageUrls) && isset($imageUrls[0]))
                                    <img src="{{ Storage::url($imageUrls[0]) }}" alt="Prévisualisation de l'image"
                                        style="max-width: 100px; display: block;">
                                @else
                                    <p>Aucune image disponible</p>
                                @endif
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>

            <div>
                <a href="{{ route('admin.banner.edit', ['id' => $banner->id]) }}" class="btn btn-primary my-1">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
            </div>
        </div>
@endsection