{{-- @extends('admin.admin_dashboard')

@section('title', 'Admin')

@section('admin')

@endsection --}}

@extends('admin.admin_dashboard')
<script src="{{ asset('admin/assets') }}/js/3.6.0.jquery.min.js"></script>
@section('title', 'Product Edit ')

@section('admin')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Product Edit</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Product</h5>
                <hr />
                <form id="myForm"  action="{{ route('product.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Name</label>
                                        <input type="text" name="product_name" class="form-control" id="product_name"
                                            placeholder="Enter product Name" value="{{ $product->product_name }}" />
                                    </div>

                                    <div class=" mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Tags</label>
                                        <input type="text" name="product_tags" class="form-control visually-hidden" data-role="tagsinput" value="{{ $product->product_tags }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Size</label>
                                        <input type="text" name="product_size" class="form-control visually-hidden" data-role="tagsinput" value="{{ $product->product_size }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Color</label>
                                        <input type="text" name="product_color" class="form-control visually-hidden" data-role="tagsinput" value="{{ $product->product_color }}">
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea class="form-control" name="short_disc" placeholder="Short Description" id="short_disc" rows="3">{{ $product->short_disc }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Full Description</label>
                                        <textarea id="mytextarea" name="long_disc">{!! $product->long_disc !!}</textarea>
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="form-group col-md-6">
                                            <label for="inputPrice" class="form-label">Product Price</label>
                                            <input type="text" name="selling_price" class="form-control" id="inputPrice" value="{{ $product->selling_price }}" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                            <input type="text" name="discount_price" class="form-control" id="inputCompareatprice"
                                            value="{{ $product->discount_price }}" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                            <input type="text" name="product_code" class="form-control" id="inputCostPerPrice"
                                            value="{{ $product->product_code }}" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                            <input type="text" name="product_qty" class="form-control" id="inputStarPoints"
                                            value="{{ $product->product_qty }}" />
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputProductType" class="form-label">Product Brand</label>
                                            <select name="brand_id" class="form-select" id="inputProductType">
                                                <option></option>
                                                @foreach ($brands as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == $product->brand_id ? 'selected' : '' }}>{{ $item->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputVendor" class="form-label">Product Category</label>
                                            <select name="category_id" class="form-select" id="inputVendor">
                                                <option></option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == $product->category_id ? 'selected' : '' }}>{{ $item->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputCollection" class="form-label">Product Sub Category</label>
                                            <select name="subcategory_id" class="form-select" id="inputCollection">
                                                <option></option>
                                                @foreach ($subcategories as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $product->subcategory_id ? 'selected' : '' }}>{{ $item->subcategory_name }}</option>
                                            @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="inputCollection" class="form-label">Selected Vendor </label>
                                            <select name="vendor_id" class="form-select" id="inputCollection">
                                                <option></option>
                                                @foreach ($activeVendor as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == $product->vendor_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault" {{ $product->hot_deals == 1 ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="flexCheckDefault">Hot Deals</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="featured" type="checkbox" value="1" id="flexCheckDefault" {{ $product->featured == 1 ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="flexCheckDefault">Featured</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_offer" type="checkbox" value="1" id="flexCheckDefault" {{ $product->special_offer == 1 ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="flexCheckDefault">Special Offer</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="flexCheckDefault" {{ $product->special_deals == 1 ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="flexCheckDefault">Special Deals</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <input type="submit" class="btn btn-primary px-4" value="Save Change" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end page wrapper -->

        {{-- ------------------- Main Image or Multiple image Update Form  ------------------------------- --}}

        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Update Main Imaage Form</h6>
            <hr>
            <div class="card">
                <form id="myForm"  action="{{ route('product.mainImage.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="old_img" value="{{ $product->product_thumbnail }}">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Main Image Update</label>
                            <input class="form-control" name="product_thumbnail" type="file" id="formFile">
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label"></label>
                            <img src="{{ asset($product->product_thumbnail) }}" alt="" style="width: 100px; height:100px;">
                        </div>
                        <input type="submit" class="btn btn-primary px-4" value="Save Change" />
                    </div>
                </form>
            </div>
        </div>



        {{-- Updat Multi Image -------------------------------------------------------------- --}}

        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Update Multi Imaage Form</h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#SI</th>
                                <th scope="col">Image</th>
                                <th scope="col">Chage Image</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form id="myForm"  action="{{ route('product.multiImage.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @foreach ($multi_image as $key => $item)

                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>
                                        <img src="{{ asset($item->photo_name) }}" alt="" style="width: 70px; height:40px;">
                                    </td>
                                    <td>
                                        <input type="file" class="form-group" name="multi_images[{{ $item->id }}]">
                                    </td>
                                    <td>
                                        <input type="submit" class="btn btn-primary px-4" value="Update Image" />
                                        <a href="{{ route('product.multiImage.delete',$item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br><br>





    @include('admin.alert')
@endsection

@section('script')

{{-- Form Validate script code --------------------------------------------------- --}}

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                product_name: {
                    required : true,
                },
                short_disc: {
                    required : true,
                },
                product_thumbnail: {
                    required : true,
                },
                multi_img: {
                    required : true,
                },
                selling_price: {
                    required : true,
                },
                product_code: {
                    required : true,
                },
                product_qty: {
                    required : true,
                },
                brand_id: {
                    required : true,
                },
                category_id: {
                    required : true,
                },
                subcategory_id: {
                    required : true,
                },
            },
            messages :{
                product_name: {
                    required : 'Please Enter Product Name',
                },
                short_disc: {
                    required : 'Please Enter Product Short Description',
                },
                product_thumbnail: {
                    required : 'Please Enter Product Main Image',
                },
                multi_img: {
                    required : 'Please Enter Product Sub Image',
                },
                product_code: {
                    required : 'Please Enter Product Code',
                },
                product_qty: {
                    required : 'Please Enter Product Quantity',
                },
                brand_id: {
                    required : 'Please Enter Product Brand Name Select',
                },
                category_id: {
                    required : 'Please Enter Product Category Name Select',
                },
                subcategory_id: {
                    required : 'Please Enter Product Sub-Category Name Select',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>

    {{-- Sub Category Show script code --------------------------------------------------- --}}

    <script type="text/javascript">
        $(document).ready(function(){
            $('select[name="category_id"]').on('change', function(){
                var category_id = $(this).val();
                if(category_id) {
                    $.ajax({
                        url: "{{ url('admin/subcategory/ajax') }}/"+category_id,
                        type: "GET",
                        dataType:"json",
                        success:function(data){
                            $('select[name="subcategory_id"]').html('');
                            var d =$('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>



    {{-- Single Image Show script ----------------------------------- --}}
    <script type="text/javascript">
        function mainImage(input){
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#mainImageShow').attr('src',e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


    {{-- Multi Image Show script code --------------------------------------------------- --}}
    <script>

        $(document).ready(function(){
         $('#multiImg').on('change', function(){ //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file){ //loop though each file
                    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                        .height(80); //create image element
                            $('#preview_img').append(img); //append image to output element
                        };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            }else{
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
         });
        });

        </script>



@endsection
