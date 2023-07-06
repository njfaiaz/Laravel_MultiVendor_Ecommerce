{{-- @extends('admin.admin_dashboard')

@section('title', 'Admin')

@section('admin')

@endsection --}}

@extends('admin.admin_dashboard')
<script src="{{ asset('admin/assets') }}/js/3.6.0.jquery.min.js"></script>
@section('title', 'Category Add ')

@section('admin')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Product</div>
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
                <h5 class="card-title">Add New Product</h5>
                <hr />
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border border-3 p-4 rounded">
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" id="product_name"
                                        placeholder="Enter product Name" />
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Tags</label>
                                    <input type="text" name="product_tags" class="form-control visually-hidden" data-role="tagsinput" value="New Product">
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Size</label>
                                    <input type="text" name="product_size" class="form-control visually-hidden" data-role="tagsinput" value="Small">
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Color</label>
                                    <input type="text" name="product_color" class="form-control visually-hidden" data-role="tagsinput" value="Red">
                                </div>


                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_disc" placeholder="Short Description" id="short_disc" rows="3"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Full Description</label>
                                    <textarea id="mytextarea" name="long_disc">Hello, World!</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Main Images</label>
                                    <input class="form-control" type="file" name="product_thumbnail" id="formFile" onChange="mainImage(this)"> <br>
                                    <img src="" id="mainImageShow" alt="">
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Multiple Images</label>
                                    <input class="form-control" name="multi_img[]" type="file" id="multiImg" multiple=""><br>

                                    <div class="row" id="preview_img"></div>

                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-3 p-4 rounded">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputPrice" class="form-label">Product Price</label>
                                        <input type="text" name="selling_price" class="form-control" id="inputPrice" placeholder="00.00" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                        <input type="text" name="discount_price" class="form-control" id="inputCompareatprice"
                                            placeholder="00.00" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                        <input type="text" name="product_code" class="form-control" id="inputCostPerPrice"
                                            placeholder="00.00" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                        <input type="text" name="product_qty" class="form-control" id="inputStarPoints"
                                            placeholder="00.00" />
                                    </div>

                                    <div class="col-12">
                                        <label for="inputProductType" class="form-label">Product Brand</label>
                                        <select name="brand_id" class="form-select" id="inputProductType">
                                            <option>Select a brand</option>
                                            @foreach ($brands as $item)
                                                <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputVendor" class="form-label">Product Category</label>
                                        <select name="category_id" class="form-select" id="inputVendor">
                                            <option>Select a Category</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCollection" class="form-label">Product Sub Category</label>
                                        <select name="subcategory_id" class="form-select" id="inputCollection">
                                            <option></option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="inputCollection" class="form-label">Selected Vendor </label>
                                        <select name="vendor_id" class="form-select" id="inputCollection">
                                            <option>Select a Vendor</option>
                                            @foreach ($activeVendor as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">Hot Deals</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="featured" type="checkbox" value="1" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">Featured</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="special_offer" type="checkbox" value="1" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">Special Offer</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">Special Deals</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="button" class="btn btn-primary">
                                                Save Product
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--end page wrapper -->
    @include('admin.alert')
@endsection

@section('script')



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
