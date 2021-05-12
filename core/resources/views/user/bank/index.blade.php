
@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
  <div class="row">
    <div class="col-md-12">
      <div class="">
        <div class="card-body">
          <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Add account')}}</a>
          <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-body p-0">
                  <div class="card border-0 mb-0">
                    <div class="card-header">
                      <h3 class="mb-0">{{__('Add Account')}}</h3>
                    </div>
                    <div class="card-body">
                      <form role="form" action="{{url('user/add_bank')}}" method="post"> 
                      @csrf
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2">{{__('Bank')}}</label>
                          <div class="col-lg-10">
                            <input type="text" name="name" class="form-control">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2">{{__('Acct Name')}}</label>
                          <div class="col-lg-10">
                            <input type="text" name="acct_name" class="form-control" required>
                          </div>
                        </div>                                                                      
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2">{{__('Account No')}}</label>
                          <div class="col-lg-10">
                            <input type="number" name="acct_no" class="form-control" required>
                          </div>
                        </div>                        
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2">{{__('ABA Routing #')}}</label>
                          <div class="col-lg-10">
                            <input type="text" name="swift" class="form-control" required>
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
      </div>
    </div>
  </div>
  <div class="row">
    @foreach($bank as $k=>$val)
      <div class="col-md-6">
          <div class="card">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <!-- Title -->
                  <h5 class="h4 mb-0 text-dark">{{$val->name}}</h5>
                </div>
                <div class="col text-right">
                  @if($val->status==0)
                  <a href="{{route('bank.default', ['id' => $val->id])}}" class="btn btn-sm btn-success">{{__('Default')}}</a>
                  @endif
                  <a data-toggle="modal" data-target="#modal-form{{$val->id}}"href="#" class="btn btn-sm btn-neutral">{{__('Edit')}}</a>
                  <a href="{{route('bank.delete', ['id' => $val->id])}}" class="btn btn-sm btn-danger">{{__('Delete')}}</a>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <p class="text-sm text-dark mb-0">{{__('Account No')}} #: {{$val->acct_no}}</p>
                  <p class="text-sm text-dark mb-0">{{__('Name')}}: {{$val->acct_name}}</p>
                  <p class="text-sm text-dark mb-0">{{__('ABA Routing #')}}: {{$val->swift}}</p>
                  <p class="text-sm text-dark mb-0">{{__('Default account')}}: @if($val->status==1) Yes @else No @endif</p>
                  <p class="text-sm text-dark mb-0">{{__('Created')}}: {{date("Y/m/d h:i:A", strtotime($val->created_at))}}</p>
                  <p class="text-sm text-dark mb-0">{{__('Updated')}}: {{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</p>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal fade" id="modal-form{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card border-0 mb-0">
                <div class="card-header">
                  <h3 class="mb-0">{{__('Edit Bank')}}</h3>
                </div>
                <div class="card-body">
                  <form role="form" action="{{url('user/edit_bank')}}" method="post"> 
                  @csrf
                    <div class="form-group row">
                      <label class="col-form-label col-lg-2">{{__('Bank')}}</label>
                        <div class="col-lg-10">
                          <input type="text" name="name" placeholder="Bank name" class="form-control" value="{{$val['name']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                          <label class="col-form-label col-lg-2">{{__('Acct Name')}}</label>
                          <div class="col-lg-10">
                        <input type="text" name="acct_name" placeholder="Account name" class="form-control" value="{{$val['acct_name']}}">
                      </div>
                    </div>                           
                    <div class="form-group row">
                          <label class="col-form-label col-lg-2">{{__('Account No')}}</label>
                          <div class="col-lg-10">
                        <input type="number" name="acct_no" placeholder="Account number" class="form-control" value="{{$val['acct_no']}}">
                        <input type="hidden" name="id" value="{{$val['id']}}">
                      </div>
                    </div>                    
                    <div class="form-group row">
                          <label class="col-form-label col-lg-2">{{__('Swift')}}</label>
                          <div class="col-lg-10">
                        <input type="text" name="swift" placeholder="Swift code" class="form-control" value="{{$val['swift']}}">
                        <input type="hidden" name="id" value="{{$val['id']}}">
                      </div>
                    </div>
                    <div class="text-right">
                      <button type="submit" class="btn btn-success btn-sm">{{__('Update Acount')}}</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="row">
      <div class="col-md-12">
      {{ $bank->links() }}
      </div>
    </div>
@stop