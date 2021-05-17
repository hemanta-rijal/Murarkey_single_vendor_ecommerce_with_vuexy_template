{!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.featured-categories.update', $model->id], 'id' => 'edit-form']) !!}

<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('weight', 'Value:') !!}
    {!! Form::text('weight', null, ['class' => 'form-control']) !!}
    {!! $errors->first('weight', '<div class="text-danger">:message</div>') !!}
</div>

<div>
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id', get_root_categories()->pluck('name','id') ,null, ['class' => 'form-control', 'disabled']) !!}
    {!! $errors->first('category_id', '<div class="text-danger">:message</div>') !!}
</div>
<br>
<div class="form-group">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
        Add Featured Product
    </button>
</div>
<br>

<div>
    <table class="table table-stripped">
        <thead>
        <th>Product Name</th>
        <th>Weight</th>
        <th>Action</th>
        </thead>
        <tbody id="featured-products-tbody">

        @foreach($model->products as $product)
            <tr id="old-item-{{ $product->id }}">
                <td><a href="{{ route('products.show', $product->product->slug) }}"
                       target="_blank">{{ $product->product->name }}</a></td>
                <td><input type="number" name="products[{{ $loop->index }}][weight]" value="{{ $product->weight }}"
                           class="form-control"></td>
                <input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $product->id }}"
                       class="form-control">
                <td>
                    <button class="btn btn-danger"
                            onclick="removeProduct({{ $product->id }},{{ $product->product->id }})">Remove
                    </button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
<div class="form-group">
    {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Search and Add Product</h4>
            </div>
            <div class="modal-body">
                <div class="input-group input-group-sm">
                    <input id="search-input-field" type="text" name="search" class="form-control no_border_radius"
                           placeholder="Keyword"
                           value="{{ request()->search }}" onkeypress="if(event.keyCode == 13) {getSearchResult()}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" onclick="getSearchResult()"><i
                                                        class="fa fa-search"></i></button>
                                        </span>
                </div>
                <div id="no-result-found" style="display:none;">
                    <div class="alert alert-info">
                        Please try other keywords, No search result found!
                    </div>
                </div>
                <table class="table table-stripped">
                    <thead>
                    <th>Product Name</th>
                    <th>Action</th>
                    </thead>
                    <tbody id="search-result-table-body">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@section('scripts')
    <script>
        var searchResult = [];
        var category_id = {{ $model->category_id }};
        var product_ids = {!! json_encode(get_product_ids_from_featured_products($model->products)) !!};

        function removeProduct(id, product_id) {
            var index = product_ids.indexOf(product_id);
            product_ids.splice(index, 1);
            $('#edit-form').append('<input type="hidden" name="remove_item[]" value="' + id + '">');
            $('#old-item-' + id).remove();
        }

        function removeNewlyAdded(id) {
            var index = product_ids.indexOf(id);
            product_ids.splice(index, 1);

            $('#product-' + id).remove();
        }

        function getSearchResult() {
            $.post('/admin/products/ajax-search-with-category', {
                _token: "{{ csrf_token() }}",
                search: $('#search-input-field').val(),
                category_id: category_id
            })
                    .fail(function (error) {
                        alert('Something went wrong');
                    })
                    .done(function (data) {
                        console.log(data);
                        searchResult = data;
                        var tableBody = $('#search-result-table-body');
                        var noResultDiv = $('#no-result-found');
                        noResultDiv.hide();
                        tableBody.empty();
                        data.forEach(function (product) {
                            tableBody.append(searchResultProductTemplate(product));
                        });

                        if (data.length == 0)
                            noResultDiv.show();
                    })
        }
        function addProduct(index) {
            var product = searchResult[index];
            var tbody = $('#featured-products-tbody');
            if (inArray(product.id, product_ids))
                alert('Already added!')
            else {
                tbody.append(generateAddProductTemplate(product, tbody.length));
                product_ids.push(product.id);
            }


        }

        function generateAddProductTemplate(product, index) {
            index = $('#featured-products-tbody tr').length;
            return '<tr id="product-' + product.id + '">' +
                    '<td>' + product.name + '</td>' +
                    '<td><input type="number" name="products[' + index + '][weight]" class="form-control"></td>' +
                    '<td><button class="btn btn-danger" onclick="removeNewlyAdded(' + product.id + ')">Remove</button>' +
                    '<input type="hidden" name="products[' + index + '][product_id]" value="' + product.id + '">' +
                    '</tr>';
        }

        function searchResultProductTemplate(product) {
            return '<tr id="search-product-' + product.id + '">' +
                    '<td><a href="/products/' + product.id + '" target="_blank">' + product.name + '</a></td>' +
                    '<td><button class="btn btn-success" onclick="addProduct(' + searchResult.indexOf(product) + ')">Add</button>' +
                    '</tr>';
        }

        function inArray(needle, haystack) {
            var length = haystack.length;
            for (var i = 0; i < length; i++) {
                if (haystack[i] == needle) return true;
            }
            return false;
        }
    </script>
@endsection
