@extends("layout.master")

@section("title", "Product Edit Page")

@section("content")

<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            @include("layout.admin_sidebar")
        </div>
        <div class="col-md-8">
            @include("layout.report_message")

            <!--Form Start-->

            <form action="/admin/product/{{ $product->id }}/edit" method="POST" enctype="multipart/form-data" class="table-bordered pb-5 px-5">
                <h3 class="text-center english my-5 text-info">Create Product</h3>
               <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                           <label for="name" class="form-label"> Name</label>
                           <input type="text" class="form-control rounded-0" id="name" name="name" value="{{ $product->name }}" >
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                           <label for="name" class="form-label">Price</label>
                           <input type="number" step="any" class="form-control rounded-0" id="price" name="price" value="{{ $product->price }}" >
                       </div>
                   </div>
               </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cat_id">Category</label>
                            <select class="form-control" name="cat_id" id="cat_id">
                              @foreach($cats as $cat)
                                    <option value="{{$cat->id}}"
                                <?php echo $cat->id == $product->cat_id ? 'selected' : '' ?>
                                        >{{$cat->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sub_cat_id">Sub Category</label>
                            <select class="form-control" name="sub_cat_id" id="sub_cat_id">
                                @foreach($sub_cats as $cat)
                                    <option value="{{$cat->id}}"
                                    <?php echo $cat->id == $product->sub_cat_id ? 'selected' : '' ?>
                                        >{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="file">File Input</label>
                    <input type="file" class="form-control-file bg-dark text-white" id="file" name="file">

                </div>

                <input type="hidden" name="old_image" value="{{ $product->image }}">

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="5">
                        {{ $product->description }}
                    </textarea>
                </div>


                <input type="hidden" name="token" value="{{\App\classes\CSRFToken::__token()}}">

                <div class="row justify-content-end no-gutters">
                    <button type="reset" class="btn btn-outline-secondary btn-sm">Cancel</button>
                    <button type="submit" class="btn btn-outline-primary btn-sm">Update</button>
                </div>

            </form>

            <!-- Form End -->
        </div>
    </div>
</div>

@endsection


