@extends('layouts.app')

@section('content')
       <div class="album py-5 bg-light">
        <div class="container">
 
          <div class="row">
		   
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22208%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20208%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_164fe7f67db%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A11pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_164fe7f67db%22%3E%3Crect%20width%3D%22208%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2266.953125%22%20y%3D%22117.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
           
              </div>
            </div>
			<div class="col-md-8">
              <div class="card mb-8 shadow-sm" style="padding:20px">
			  @if ($errors->any())
			  <div class="alert alert-danger">
			  <ul>
			  @foreach($errors->all() as $error)
			  <li>{{$error}}</li>
			  @endforeach
			  </ul>
			  </div>
			  @endif
			  
			  @if (session("success")!="")
              <div class="alert alert-success">
              <span>{{session("success")}}</span>
              </div>
              @endif
			  
			  
                  <p class="card-text" style="text-transform:uppercase">{{$product->name}} {{$product->price}}ZAR</p>
				  <p class="card-text" style="text-transform:capitalize">{{$product->description}}</p>
				  <p class="card-text" style="text-transform:capitalize">Highest bid {{$max_bid}}</p>
				  <div id="accordion"  >
				  <div class="card">
				   <div class="card-header" id="headingProduct">
				   <h5 class="mb-0">
                           <button type="button" class="btn btn-link accordion-toggle collapsed" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
                               <label>Edit Details</label>
							   
                             </button>
</h5>
                           </div>  
	       <div id="collapseProduct" class="collapse" aria-labelledby="headingProduct" data-parent="#accordion" >
           <div class="card-body">  
           <form method="POST" enctype="multipart\form-data" action="/admin/products/edit_product">
           {!! csrf_field() !!}
           <div class="form-group" style="">
           <label for="name" class="col-md-6 control-label col-xs-6">Enter Name</label>
	       <div class="col-md-6 col-xs-6">
            <input type="text" class="form-control" name="name" value="{{$product->name}}">
	          </div>
           </div>
		   
		   <div class="form-group">
            <label for="description" class="col-md-6 control-label col-xs-6" style="margin-top: 20px;">Enter Description</label>
	       <div class="col-md-6 col-xs-6" style="margin-top: 20px;">
           <input type="text" class="form-control" name="description" value="{{$product->description}}">
	        </div>
           </div>
		   
		   <div class="form-group">
            <label for="sku" class="col-md-6 control-label col-xs-6" style="margin-top: 20px;">Enter SKU</label>
	       <div class="col-md-6 col-xs-6" style="margin-top: 20px;">
           <input type="text" class="form-control" name="sku" value="{{$product->sku}}">
	        </div>
           </div>
		   
		    <div class="form-group">
            <label for="price" class="col-md-6 control-label col-xs-6" style="margin-top: 20px;">Ammount</label>
	       <div class="col-md-6 col-xs-6" style="margin-top: 20px;">
           <input type="text" class="form-control" name="price" value="{{$product->price}}">
	       <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}" >
	        </div>
           </div>
		  
  
           
           <div class="form-group">
           <div class="col-md-6 col-xs-6" style="margin-top: 20px;margin-bottom: 40px;">
           <input type="submit" class="btn btn-primary" id="" name="save" value="Save">
	       </div>
           </div>
           </form>
           </div>
           </div>
	       </div>
           </div>
		        <div style="margin-top:20px">
				<a href="/admin/products"><button>Back</button></a> 
                </div>				
				  
				  
				  
                  <div class="d-flex justify-content-between align-items-center">
                    
					
					
                  </div>
                </div>
              </div>
          
		
         
          </div>
		  
		  
		  
        </div>
      </div>
	 <h2>Product Bids</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Bid</th>
               
                </tr>
              </thead>
              <tbody>
			  @foreach($bids as $bid)
                <tr>
				<td>{{$bid->ammount}}</td>
                  
                </tr>
                 @endforeach
              </tbody>
            </table>
          </div>


@endsection
    