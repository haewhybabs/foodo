

<div class="modal fade" id="add-address-modal" tabindex="-1" role="dialog" aria-labelledby="add-address" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="add-address">Add Delivery Address</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <form>
                <div class="form-row">
                   <div class="form-group col-md-12">
                      <label for="inputPassword4">Delivery Area</label>
                      <div class="input-group">
                         <input type="text" class="form-control" placeholder="Delivery Area">
                         <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="icofont-ui-pointer"></i></button>
                         </div>
                      </div>
                   </div>
                   <div class="form-group col-md-12">
                      <label for="inputPassword4">Complete Address
                      </label>
                      <input type="text" class="form-control" placeholder="Complete Address e.g. house number, street name, landmark">
                   </div>
                   <div class="form-group col-md-12">
                      <label for="inputPassword4">Delivery Instructions
                      </label>
                      <input type="text" class="form-control" placeholder="Delivery Instructions e.g. Opposite Gold Souk Mall">
                   </div>
                   <div class="form-group mb-0 col-md-12">
                      <label for="inputPassword4">Nickname
                      </label>
                      <div class="btn-group btn-group-toggle d-flex justify-content-center" data-toggle="buttons">
                         <label class="btn btn-info active">
                         <input type="radio" name="options" id="option1" autocomplete="off" checked> Home
                         </label>
                         <label class="btn btn-info">
                         <input type="radio" name="options" id="option2" autocomplete="off"> Work
                         </label>
                         <label class="btn btn-info">
                         <input type="radio" name="options" id="option3" autocomplete="off"> Other
                         </label>
                      </div>
                   </div>
                </div>
             </form>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
             </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">SUBMIT</button>
          </div>
       </div>
    </div>
 </div>






<div class="modal fade" id="edit-profile-modal" tabindex="-1" role="dialog" aria-labelledby="edit-profile" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="edit-profile">Edit profile</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <form>
                <div class="form-row">
                   <div class="form-group col-md-12">
                      <label>Phone number
                      </label>
                      <input type="text" value="+91 85680-79956" class="form-control" placeholder="Enter Phone number">
                   </div>
                   <div class="form-group col-md-12">
                      <label>Email id
                      </label>
                      <input type="text" value="iamosahan@gmail.com" class="form-control" placeholder="Enter Email id
                         ">
                   </div>
                   <div class="form-group col-md-12 mb-0">
                      <label>Password
                      </label>
                      <input type="password" value="**********" class="form-control" placeholder="Enter password
                         ">
                   </div>
                </div>
             </form>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
             </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">UPDATE</button>
          </div>
       </div>
    </div>
 </div>
 {{--  <!-- Modal --> Stock Category  --}}
 <div class="modal fade" id="add-stockcategory-modal" tabindex="-1" role="dialog" aria-labelledby="add-stockcategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="add-address">Stock Category</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
          <form action="{{URL::TO('stock-category')}}" method="post">
            @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputPassword4">Category Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Stock Category Name" name="category_name[]">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div id="input-show">

                        </div>
                    </div>

                </div>

                <button type="submit" class="btn justify-content-center btn-warning">Submit</button>
                <button type="button" class="btn justify-content-center btn-info" id="clickable">Add More</button>

             </form>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
             {{--  </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">SUBMIT</button>  --}}
          </div>
       </div>
    </div>
 </div>


 <div class="modal fade" id="add-stock-modal" tabindex="-1" role="dialog" aria-labelledby="add-stock" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="add-address">Stock Category</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
          <form action="{{URL::TO('stock-create')}}" method="post">
            @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <select class="custom-select form-control" name="stockcategory">
                            <option value="">Select Category</option>
                            @foreach($stockcategories as $stockcategory)
                                <option value="{{$stockcategory->idstockcategories}}">{{$stockcategory->name}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Stock Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Stock Name" name="stock_name[]">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Stock Price</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Stock Price" name="stock_price[]">
                            </div>
                        </div>
                    </div>


                    <div id="stock-show">

                    </div>


                </div>

                <button type="submit" class="btn justify-content-center btn-warning">Submit</button>
                <button type="button" class="btn justify-content-center btn-info" id="add-to-stock">Add More</button>

             </form>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
             {{--  </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">SUBMIT</button>  --}}
          </div>
       </div>
    </div>
 </div>


 <!-- Modal -->
 <div class="modal fade" id="delete-address-modal" tabindex="-1" role="dialog" aria-labelledby="delete-address" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="delete-address">Delete</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <p class="mb-0 text-black">Are you sure you want to delete this xxxxx?</p>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
             </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">DELETE</button>
          </div>
       </div>
    </div>
 </div>

 <script>
    $(function(){
        $('#label-hide').hide();

        var cat_fields=11;
        var x=1;
        var j=1;
        var stock_fields=11;
        $('#clickable').click(function(){

            if(x<cat_fields){
                x++;
                $('#input-show').append('<div class="input-group"><input type="text" required class="form-control" placeholder="Stock Category Name" name="category_name[]"></div>' +

                    '<a href="#" id="remove-item"><i class="fa fa-times"></a>'
                );
            }


        });

        $('#input-show').on("click","#remove-item", function(e){
            e.preventDefault();
            $(this).parent('div').remove(); x--;
        })

        //Add to stock

        $('#add-to-stock').click(function(){

            if(x<stock_fields){
                j++;
                $('#stock-show').append(

                    '<div class="row"><div class="form-group col-sm-6"><label for="inputPassword4">Stock Name</label><div class="input-group"><input type="text" class="form-control" placeholder="Stock Name" name="stock_name[]"></div></div><div class="form-group col-sm-6"><label for="inputPassword4">Stock Price</label><div class="input-group"><input type="number" class="form-control" placeholder="Stock Price" name="stock_price[]"></div></div></div>' +

                    '<a href="#" id="remove-stock-item"><i class="fa fa-times"></a>'
                );
            }


        });

        $('#stock-show').on("click","#remove-stock-item", function(e){
            e.preventDefault();
            $(this).parent('div').remove(); j--;
        })



    });
</script>
