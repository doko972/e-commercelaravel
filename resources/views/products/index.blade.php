@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div>
        <h3> Products Details</h3>

        <form method="GET" action="{{ route('admin.product.index') }}" class="mb-3">
    <input type="hidden" name="is_new_arrival" value="0">
    <input type="hidden" name="is_featured" value="0">
    <input type="hidden" name="is_special_offer" value="0">
    <input type="hidden" name="is_best_seller" value="0">

    <label>
        <input type="checkbox" name="is_new_arrival" value="1"
               {{ request()->input('is_new_arrival') == 1 ? 'checked' : '' }}> Nouveautés
    </label>
    <label>
        <input type="checkbox" name="is_featured" value="1"
               {{ request()->input('is_featured') == 1 ? 'checked' : '' }}> Produits en vedette
    </label>
    <label>
        <input type="checkbox" name="is_special_offer" value="1"
               {{ request()->input('is_special_offer') == 1 ? 'checked' : '' }}> Offres spéciales
    </label>
    <label>
        <input type="checkbox" name="is_best_seller" value="1"
               {{ request()->input('is_best_seller') == 1 ? 'checked' : '' }}> Meilleures ventes
    </label>
    <button type="submit" class="btn btn-primary">Filtrer</button>
    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Réinitialiser</a>
</form>


        <div class="d-flex justify-content-end">
            <div class="dropdown m-1">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Column
                </button>
                <div id="columnSelector" class="dropdown-menu"> </div>
            </div>
            <a href="{{ route('admin.product.create') }}" class="btn btn-success m-1">
                Create Product
            </a>
        </div>
        <div class="">
            <div class="card-body">
                <div class="table-responsive">

                    <table id="Product" class="table">
                        <thead>
                            <tr>
                                <th scope="col">N#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Description</th>
                                <th scope="col">MoreDescription</th>
                                <th scope="col">AdditionnalInfos</th>
                                <th scope="col">Stock</th>
                                <th scope="col">SoldePrice</th>
                                <th scope="col">RegularPrice</th>
                                <th scope="col">ImageUrls</th>
                                <th scope="col">Brand</th>
                                <th scope="col">isAvailable</th>
                                <th scope="col">IsBestSeller</th>
                                <th scope="col">IsNewArrival</th>
                                <th scope="col">IsFeatured</th>
                                <th scope="col">IsSpecialOffer</th>

                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                                    <tr>
                                                        <td>{{ $product->id }}</td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->slug }}</td>
                                                        <td>{{ $product->description }}</td>
                                                        <td>{!! $product->moreDescription !!}</td>
                                                        <td>{{ $product->additionnalInfos }}</td>
                                                        <td>{{ $product->stock }}</td>
                                                        <td>{{ number_format($product->soldePrice, 2, ',', ' ') . ' €' }}</td>
                                                        <td>{{ number_format($product->regularPrice, 2, ',', ' ') . ' €' }}</td>
                                                        <td class="d-flex align-items-center">
                                                            <div class="d-flex flex-row gap-2 flex-wrap" style="max-width: 100%;">
                                                                @php
                                                                    $imageUrls = json_decode($product->imageUrls, true);
                                                                    $imageUrl = is_array($imageUrls) && isset($imageUrls[0]) ? $imageUrls[0] : $product->imageUrls;
                                                                @endphp
                                                                @if ($imageUrl)
                                                                    <img src="{{ Str::startsWith($imageUrl, 'http') ? $imageUrl : Storage::url($imageUrl) }}"
                                                                        alt="Prévisualisation de l'image" style="max-width: 100px; display: block;" />
                                                                @else
                                                                    <p>Aucune image disponible</p>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>{{ $product->brand }}</td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input name="isAvailable" id="isAvailable" data-id="{{$product->id}}" value="true"
                                                                    data-bs-toggle="toggle" {{ isset($product) && $product->isAvailable == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input name="isBestSeller" id="isBestSeller" data-id="{{$product->id}}" value="true"
                                                                    data-bs-toggle="toggle" {{ isset($product) && $product->isBestSeller == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input name="isNewArrival" id="isNewArrival" data-id="{{$product->id}}" value="true"
                                                                    data-bs-toggle="toggle" {{ isset($product) && $product->isNewArrival == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input name="isFeatured" id="isFeatured" data-id="{{$product->id}}" value="true"
                                                                    data-bs-toggle="toggle" {{ isset($product) && $product->isFeatured == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input name="isSpecialOffer" id="isSpecialOffer" data-id="{{$product->id}}"
                                                                    value="true" data-bs-toggle="toggle" {{ isset($product) && $product->isSpecialOffer == 'true' ? 'checked' : '' }} class="form-check-input"
                                                                    type="checkbox" role="switch" />
                                                            </div>
                                                        </td>
                                                        <td class="d-flex align-items-center justify-content-center gap-2">
                                                            <a href="{{ route('admin.product.show', ['id' => $product->id]) }}"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                                                                class="btn btn-success btn-sm">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                            <a href="#" data-id="{{ $product->id }}" class="btn btn-danger btn-sm deleteBtn">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="confirmModalLabel">Delete confirm</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary confirmDeleteAction">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        const checkboxs = document.querySelectorAll('input[type="checkbox"]')

        checkboxs.forEach((checkbox) => {

            checkbox.onchange = async (event) => {
                const { checked, name, dataset } = event.target;
                const { id } = dataset;
                console.log({ checked, name, id });
                const data = { [name]: checked.toString() };
                const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                const response = await fetch('/admin/products/speed/' + id, {
                    method: 'PUT',
                    body: JSON.stringify(data), // Utilisation de JSON.stringify au lieu de JSON.stringfy
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
            };
        })

        const deleteButtons = document.querySelectorAll('.deleteBtn')
        deleteButtons.forEach(deleteButton => {
            deleteButton.addEventListener('click', (event) => {
                event.preventDefault();
                const { id, title } = deleteButton.dataset
                const modalBody = document.querySelector('.modal-body')
                modalBody.innerHTML = `Are you sure you want to delete this data ?</strong> `
                console.log({ id, title });
                const modal = new bootstrap.Modal(document.querySelector('#confirmModal'))
                modal.show()
                const confirmDeleteBtn = document.querySelector('.confirmDeleteAction')

                confirmDeleteBtn.addEventListener('click', async () => {
                    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                    const response = await fetch('/admin/products/delete/' + id, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })

                    const result = await response.json()

                    if (result && result.isSuccess) {
                        window.location.href = window.location.href;
                    }


                    modal.hide()
                })
            })

        });
        document.addEventListener('DOMContentLoaded', function () {
            const tableHeaders = document.querySelectorAll('#Product th');
            const columnSelector = document.getElementById('columnSelector');

            tableHeaders.forEach(function (header, index) {
                const li = document.createElement('li');
                const a = document.createElement('a');
                const div = document.createElement('div');
                a.className = 'dropdown-item';
                div.className = 'form-check form-switch';
                const label = document.createElement('label');
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.role = "switch"
                checkbox.className = 'columnSelector form-check-input';
                checkbox.dataset.column = index;
                const savedSelection = localStorage.getItem('selectedColumns#Product');
                checkbox.checked = !!!savedSelection; // Sélectionner par défaut
                checkbox.addEventListener('change', function () {
                    const columnIndex = parseInt(checkbox.dataset.column);
                    toggleColumn(columnIndex, checkbox.checked);
                    saveSelection();
                });

                label.appendChild(document.createTextNode(header.textContent));
                div.appendChild(label)
                div.appendChild(checkbox)
                a.appendChild(div);
                li.appendChild(a);
                columnSelector.appendChild(li);

                header.addEventListener('click', function () {
                    sortTable(index);
                });

                if (savedSelection) {
                    const selectedColumns = JSON.parse(savedSelection);
                    toggleColumn(parseInt(index), selectedColumns.includes(index));
                }
            });


            const checkboxes = document.querySelectorAll('.columnSelector');

            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const columnIndex = parseInt(checkbox.dataset.column);
                    toggleColumn(columnIndex, checkbox.checked);

                    // Sauvegarde la sélection dans le localStorage
                    saveSelection();
                });
            });

            // Chargement des valeurs sauvegardées dans le localStorage
            loadSavedSelection();
        });

        function toggleColumn(columnIndex, show) {
            const dataTable = document.getElementById('Product');
            const cells = dataTable.querySelectorAll(
                `tr td:nth-child(${columnIndex + 1}), th:nth-child(${columnIndex + 1})`);

            cells.forEach(function (cell) {
                if (show) {
                    cell.style.display = ''; // Affiche la colonne
                } else {
                    cell.style.display = 'none'; // Masque la colonne
                }
            });
        }

        function saveSelection() {
            const selectedColumns = Array.from(document.querySelectorAll('.columnSelector'))
                .filter(c => c.checked)
                .map(c => c.dataset.column);
            localStorage.setItem('selectedColumns#Product', JSON.stringify(selectedColumns));
        }

        function loadSavedSelection() {
            const savedSelection = localStorage.getItem('selectedColumns#Product');
            if (savedSelection) {
                const selectedColumns = JSON.parse(savedSelection);
                selectedColumns.forEach(function (columnIndex) {
                    const checkbox = document.querySelector(`.columnSelector[data-column="${columnIndex}"]`);
                    if (checkbox) {
                        checkbox.checked = true;
                        toggleColumn(parseInt(columnIndex), true);
                    }
                });
            }
        }

        function sortTable(columnIndex) {
            const table = document.getElementById('Product');
            const rows = Array.from(table.querySelectorAll('tbody tr'));

            console.log({ rows });

            rows.sort((a, b) => {
                const cellA = a.querySelectorAll('td')[columnIndex].textContent;
                const cellB = b.querySelectorAll('td')[columnIndex].textContent;

                return cellA.localeCompare(cellB, undefined, { numeric: true, sensitivity: 'base' });
            });

            table.querySelector('tbody').innerHTML = '';
            rows.forEach(row => table.querySelector('tbody').appendChild(row));
        }
    </script>
@endsection