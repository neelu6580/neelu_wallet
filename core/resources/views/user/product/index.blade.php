
@extends('userlayout')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral" style="font-size: 1.2rem;"><i class="fa fa-plus"></i>{{__('Add Your New Product')}}</a>
              <a href="{{route('user.list')}}" class="btn btn-sm btn-success" style="font-size: 1.2rem;"><i class="fa fa-braille"></i>{{__(' Your Orders')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0">{{__('New Product')}}</h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                    <form action="{{route('submit.product')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Name')}}</label>
                        <div class="col-lg-10">
                          <input type="text" name="name" class="form-control" placeholder="The name of your product" required>
                        </div>
                      </div>       
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Amount')}}</label>
                        <div class="col-lg-10">
                          <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                              <span class="input-group-text">{{$currency->symbol}}</span>
                            </div>
                            <input type="number" step="any" name="amount" maxlength="10" class="form-control" required="">
                          </div>
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Quantity')}}</label>
                        <div class="col-lg-10">
                          <input type="number" name="quantity" class="form-control" value="1" required>
                        </div>
                      </div> 
                      
                      <div class="form-group row">
                          <label class="col-form-label col-lg-2">{{__('Image')}}</label>
                          <div class="col-lg-10">
                              <div class="custom-file text-center">
                                  <input type="file" class="custom-file-input" name="file" accept="image/*" id="customFileLang">
                                  <label class="custom-file-label" for="customFileLang">{{__('Choose Media')}}</label>
                              </div>
                          </div>
                      </div>
              
              
                      <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
      
      <div class="col-md-12">
        <div class="modal fade" id="modal-socialdetails" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                      <h1 class="mb-3">{{__(' Your product is ready to sell')}}</h1>
                    <h3 class="mb-0">{{__(' Product Details')}}</h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                      <?php if(isset($productdetails)) {?>
                       <div class="row mb-3">
                          <div class="col-4">
                            <span class="form-text text-xl">{{$currency->symbol}} {{number_format($productdetails->amount)}}.00</span>
                          </div>
                          <div class="col-8 text-right">
                             
                            @if($productdetails)
                            
                            <a href="{{url('/')}}/user/edit-product/{{$productdetails->id}}" class="btn btn-sm btn-success" title="Edit Product"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="{{url('/')}}/user/orders/{{$productdetails->id}}" class="btn btn-sm btn-neutral" title="Orders"><i class="fa fa-spinner"></i> Orders</a>
                            @endif
                            <a data-toggle="modal" data-target="#delete{{$productdetails->id}}" href="" class="btn btn-neutral btn-sm text-danger" title="Delete link"><i class="fa fa-trash"></i> Delete</a>
                             <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> {{__('Close')}}</button>
                          </div>
                        </div>
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <!-- Avatar -->
                            <a href="javascript:void;" class="avatar avatar-l">
                              <img               
                              @if($productdetails->new==0)
                               
                                
                                src="{{url('/')}}/asset/images/default_product.png"
                                
                                
                              @else
                                @php
                                $image=App\Models\Productimage::whereproduct_id($productdetails->id)->first();
                                @endphp
                                src="{{url('/')}}/asset/profile/{{$image['image']}}"
                              @endif alt="Image placeholder">
                            </a>
                          </div>
                          <div class="col">
                            <p class="text-sm text-dark mb-0" style="font-size: 25px !important; text-transform: capitalize;">{{$productdetails->name}}</p>
                            <p class="text-sm text-dark mb-0">Stock: {{$productdetails->quantity}}</p>
                            @if($productdetails->status==1)
                                <span class="badge badge-pill badge-success my-3">{{__('Active')}}</span>
                            @else
                                <span class="badge badge-pill badge-danger my-3">{{__('Disabled')}}</span>
                            @endif
                            <p class="text-sm text-dark mb-0"><button type="button" class="btn-icon-clipboard" data-clipboard-text="{{route('product.link', ['id' => $productdetails->ref_id])}}" title="Copy" style="border-radius: 50px; padding: 3px 7px 3px 7px; background-color: #256278; color: white; font-size: 17px; margin: 10px 0px;">{{__('Copy Product Link')}}</button></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div style="font-size:18px; padding-top: 10px; text-align:center;">
                                Sell your item by Social Media
                            </div>
                            <div class="share text-center">
                            	<div>
                            		<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('product.link', ['id' => $productdetails->ref_id])) }}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook" style="font-size:20px" ><img src="{{url('/')}}/asset/social/fb.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('product.link', ['id' => $productdetails->ref_id])) }}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Twitter" style="font-size:20px"><img src="{{url('/')}}/asset/social/twitter.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="https://www.instagram.com/" target="_blank" data-toggle="tooltip" data-placement="top" title="Copy Product Link & Post on Instagram" style="font-size:20px"><img src="{{url('/')}}/asset/social/insta.png" style="width: 40px; margin-right: 7px;"></a>
                                </div>
                                <div>
                                    <div style="font-size: 20px;">Or</div>
                            		<a href="http://www.reddit.com/submit?{{http_build_query(['url' => route('product.link', ['id' => $productdetails->ref_id]),'title' => $productdetails->name,])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Reddit" style="font-size:20px" ><img src="{{url('/')}}/asset/social/reddit.png" style="width: 40px; margin-right: 7px;"></a>
                                	<a href="https://pinterest.com/pin/create/button/?{{http_build_query(['url' => route('product.link', ['id' => $productdetails->ref_id]),'media' => '','description' => $productdetails->name])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Pinterest" style="font-size:20px" ><img src="{{url('/')}}/asset/social/pinterest.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="http://www.linkedin.com/shareArticle?{{http_build_query(['url' => route('product.link', ['id' => $productdetails->ref_id]),'title' => $productdetails->name,'mini' => true])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="LinkedIn" style="font-size:20px"><img src="{{url('/')}}/asset/social/linkedin.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="http://www.tumblr.com/share?{{http_build_query(['u' => route('product.link', ['id' => $productdetails->ref_id]),'t' => $productdetails->name,'v' => 3])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="tumblr" style="font-size:20px"><img src="{{url('/')}}/asset/social/tumblr.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="http://vk.com/share.php?{{http_build_query(['url' => route('product.link', ['id' => $productdetails->ref_id]),'title' => $productdetails->name,'image' => '','noparse' => false])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="VK" style="font-size:20px"><img src="{{url('/')}}/asset/social/vk.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="http://www.digg.com/submit?{{http_build_query(['url' => route('product.link', ['id' => $productdetails->ref_id]),'title' => $productdetails->name])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Digg" style="font-size:20px"><img src="{{url('/')}}/asset/social/digg.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="http://www.viadeo.com/?{{http_build_query(['url' => route('product.link', ['id' => $productdetails->ref_id]),'title' => $productdetails->name,'image' => ''])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Viadeo" style="font-size:20px"><img src="{{url('/')}}/asset/social/viadeo.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="whatsapp://send?text={{rawurlencode($productdetails->name ." | ". route('product.link', ['id' => $productdetails->ref_id]))}}" data-toggle="tooltip" data-placement="top" title="WhatsApp" style="font-size:20px"><img src="{{url('/')}}/asset/social/whatsapp.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="mailto:?subject={{ $productdetails->name}}&amp;body={{ route('product.link', ['id' => $productdetails->ref_id]) }}" data-toggle="tooltip" data-placement="top" title="Email" style="font-size:20px"><img src="{{url('/')}}/asset/social/gmail.png" style="width: 40px; margin-right: 7px;"></a>
                            	</div>
                            	<div class="addthis_native_toolbox"></div>
                            </div>
                        </div>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
      
    </div>
    <div class="row">  
      <div class="col-md-8">
        @if(isset($product) && count($product) > 0)
            @foreach($product as $k=>$val)
            <div class="col-md-12">
                <div class="card">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col-4">
                        <span class="form-text text-xl">{{$currency->symbol}} {{number_format($val->amount)}}.00</span>
                      </div>
                      <div class="col-8 text-right">
                        @if($val->status==1)
                        <a href="{{url('/')}}/user/edit-product/{{$val->id}}" class="btn btn-sm btn-success" title="Edit Product"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="{{url('/')}}/user/orders/{{$val->id}}" class="btn btn-sm btn-neutral" title="Orders"><i class="fa fa-spinner"></i> Orders</a>
                        @endif
                        <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="text-danger" title="Delete link"><i class="fa fa-close"></i></a>
                      </div>
                    </div>
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <a href="javascript:void;" class="avatar avatar-l">
                          <img               
                          @if($val->new==0)
                           
                            src="{{url('/')}}/asset/images/default_product.png"
                          @else
                            @php
                            $image=App\Models\Productimage::whereproduct_id($val->id)->first();
                            @endphp
                            src="{{url('/')}}/asset/profile/{{$image['image']}}"
                          @endif alt="Image placeholder">
                        </a>
                      </div>
                      <div class="col">
                        <p class="text-sm text-dark mb-0" style="font-size: 25px !important; text-transform: capitalize;">{{$val->name}}</p>
                        <p class="text-sm text-dark mb-0">Stock: {{$val->quantity}}</p>
                        @if($val->status==1)
                            <span class="badge badge-pill badge-success my-3">{{__('Active')}}</span>
                        @else
                            <span class="badge badge-pill badge-danger my-3">{{__('Disabled')}}</span>
                        @endif
                        <p class="text-sm text-dark mb-0"><button type="button" class="btn-icon-clipboard" data-clipboard-text="{{route('product.link', ['id' => $val->ref_id])}}" title="Copy"style="border-radius: 50px; padding: 3px 7px 3px 7px; background-color: #256278; color: white; font-size: 17px; margin: 10px 0px;">{{__('Copy Product Link')}}</button></p>
                        
                        <!--3-11-2020-->
                        
                        
                    </div>
                  </div>
                  <div class="col-md-12">
                      <div style="font-size:18px; padding-top: 10px; text-align:center;">
                            Sell your item by Social Media
                      </div>
                      <div class="share text-center">
                        	<div>
                        		<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('product.link', ['id' => $val->ref_id])) }}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook" style="font-size:20px" ><img src="{{url('/')}}/asset/social/fb.png" style="width: 35px; margin-right: 7px;"></a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('product.link', ['id' => $val->ref_id])) }}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Twitter" style="font-size:20px"><img src="{{url('/')}}/asset/social/twitter.png" style="width: 35px; margin-right: 7px;"></a>
                                <a href="https://www.instagram.com/" target="_blank" data-toggle="tooltip" data-placement="top" title="Copy Product Link & Post on Instagram" style="font-size:20px"><img src="{{url('/')}}/asset/social/insta.png" style="width: 35px; margin-right: 7px;"></a>
                            </div>
                            <div style="font-size: 20px;">Or</div>
                            <div>
                        		<a href="http://www.reddit.com/submit?{{http_build_query(['url' => route('product.link', ['id' => $val->ref_id]),'title' => $val->name,])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Reddit" style="font-size:20px" ><img src="{{url('/')}}/asset/social/reddit.png" style="width: 35px; margin-right: 7px;"></a>
                                <a href="https://pinterest.com/pin/create/button/?{{http_build_query(['url' => route('product.link', ['id' => $val->ref_id]),'media' => '','description' => $val->name])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Pinterest" style="font-size:20px" ><img src="{{url('/')}}/asset/social/pinterest.png" style="width: 35px; margin-right: 7px;"></a>
                                <a href="http://www.linkedin.com/shareArticle?{{http_build_query(['url' => route('product.link', ['id' => $val->ref_id]),'title' => $val->name,'mini' => true])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="LinkedIn" style="font-size:20px"><img src="{{url('/')}}/asset/social/linkedin.png" style="width: 35px; margin-right: 7px;"></a>
                                <a href="http://www.tumblr.com/share?{{http_build_query(['u' => route('product.link', ['id' => $val->ref_id]),'t' => $val->name,'v' => 3])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="tumblr" style="font-size:20px"><img src="{{url('/')}}/asset/social/tumblr.png" style="width: 35px; margin-right: 7px;"></a>
                                <a href="http://vk.com/share.php?{{http_build_query(['url' => route('product.link', ['id' => $val->ref_id]),'title' => $val->name,'image' => '','noparse' => false])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="VK" style="font-size:20px"><img src="{{url('/')}}/asset/social/vk.png" style="width: 35px; margin-right: 7px;"></a>
                                <a href="http://www.digg.com/submit?{{http_build_query(['url' => route('product.link', ['id' => $val->ref_id]),'title' => $val->name])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Digg" style="font-size:20px"><img src="{{url('/')}}/asset/social/digg.png" style="width: 35px; margin-right: 7px;"></a>
                                <a href="http://www.viadeo.com/?{{http_build_query(['url' => route('product.link', ['id' => $val->ref_id]),'title' => $val->name,'image' => ''])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Viadeo" style="font-size:20px"><img src="{{url('/')}}/asset/social/viadeo.png" style="width: 35px; margin-right: 7px;"></a>
                                <a href="whatsapp://send?text={{rawurlencode($val->name ." | ". route('product.link', ['id' => $val->ref_id]))}}" data-toggle="tooltip" data-placement="top" title="WhatsApp" style="font-size:20px"><img src="{{url('/')}}/asset/social/whatsapp.png" style="width: 35px; margin-right: 7px;"></a>
                                <a href="mailto:?subject={{ $val->name}}&amp;body={{ route('product.link', ['id' => $val->ref_id]) }}" data-toggle="tooltip" data-placement="top" title="Email" style="font-size:20px"><img src="{{url('/')}}/asset/social/gmail.png" style="width: 35px; margin-right: 7px;"></a>
                        	</div>
                        	<div class="addthis_native_toolbox"></div>
                        </div>
                  </div>
                </div>
            </div>
            <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                      <div class="modal-content">
                          <div class="modal-body p-0">
                              <div class="card bg-white border-0 mb-0">
                                  <div class="card-header">
                                      <span class="mb-0 text-sm">{{__('Are you sure you want to delete this?, all transaction related to this will also be deleted')}}</span>
                                  </div>
                                  <div class="card-body px-lg-5 py-lg-5 text-right">
                                      <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                      <a  href="{{route('delete.product', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
            </div>
            </div>
            @endforeach
        @else
        <div class="col-md-12">
            <p style="background: #fff; padding: 10px; border-radius: 7px;">Let’s Setup your first online Store!.</p>
            <div class="card">
              <!-- Card body -->
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col" style="text-align:center">
                    <img src="{{url('asset/profile/nodata.png')}}" width="30%">
                  </div>
                 
                </div>
                
              </div>
            </div>
          </div>
        @endif
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                {{__('Statistics')}}
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> {{__('Received')}}</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($received)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle">{{__('Pending')}}</span><br>
                  <span class="surtitle ">{{__('Total')}}</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle ">{{$currency->name}} 00.00</span><br>
                  <span class="surtitle ">{{$currency->name}} {{number_format($total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
@stop