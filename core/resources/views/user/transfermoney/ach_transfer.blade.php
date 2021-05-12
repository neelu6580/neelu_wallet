@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="card bg-white">
          <div class="card-body">
            <div class="">
              <h3 class="">To ACH Transfer</h3>
              <!--<p class="mt-0 mb-5">Transfer charge is {{$set->transfer_chargex}}% per transaction.</p>-->
              <p class="mt-0 mb-5">To ACH Transfer charges: 1.5% per transaction.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
          <div class="card-header header-elements-inline">
            <h3 class="mb-0">Transfer Funds</h3>
                <div class="header-elements">
                  <div class="list-icons">
                </div>
              </div>
          </div>
          <div class="card-body">
            <form action="{{route('submit.otherbank')}}" method="post" id="modal-details">
            @csrf
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Account Number</label>
                  <div class="col-lg-10">
                    <div class="input-group">
                      <span class="input-group-prepend">
                        <span class="input-group-text">#</span>
                      </span>
                      <input type="number" name="acct_no" maxlength="10" class="form-control" required>
                    </div>
                  </div>
                </div>    
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Account Holder Name</label>
                  <div class="col-lg-10">
                    <input type="text" name="name" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Bank Name</label>
                  <div class="col-lg-10">
                    <select name="bank" class="form-control">
                        <option> JPMorgan Chase & Co. </option>
                        <option> Bank of America Corp. </option>
                        <option> Wells Fargo & Co. </option>
                        <option> Citigroup Inc.	</option>
                        <option> U.S. Bancorp </option>
                        <option> Truist Bank </option>
                        <option> PNC Financial Services Group Inc. </option>
                        <option> TD Group US Holdings LLC </option>
                        <option> Capital One Financial Corp. </option>
                        <option> Bank of New York Mellon Corp. </option>
                        <option> Goldman Sachs Group Inc. </option>
                        <option> State Street Corp. </option>
                        <option> HSBC </option>
                        <option> Fifth Third Bank </option>
                        <option> Citizens Financial Group </option>
                    </select>
                  </div>
                </div> 
               <div class="form-group row">
                  <label class="col-form-label col-lg-2">Beneficiary Address</label>
                  <div class="col-lg-10">
                    <input type="text" name="address" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Routing No ( ABA supported)</label>
                  <div class="col-lg-10">
                    <input type="text" name="swift" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Amount</label>
                  <div class="col-lg-10">
                    <div class="input-group">
                      <span class="input-group-prepend">
                        <span class="input-group-text">{{$currency->symbol}}</span>
                      </span>
                      <input type="number" class="form-control" name="amount" id="amount" required>
                      <span class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </span>
                    </div>
                  </div>
                </div>                     
                <div class="text-right">
                  <a href="#" data-toggle="modal" data-target="#modal-form" class="btn btn-primary">Send<i class="icon-paperplane ml-2"></i></a>
                </div>         
                <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="card bg-white border-0 mb-0">
                          <div class="card-header bg-transparent pb-2ß">
                            <div class="text-dark text-center mt-2 mb-3">Enter account pin to complete transfer</div>
                            <div class="text-center text-dark"><i class="ni ni-key-25 icon-2x"></i></div> 
                          </div>
                          <div class="card-body px-lg-5 py-lg-5">
                            <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ni ni-lock-circle-open text-dark"></i></span>
                                </div>
                                <input class="form-control" placeholder="Pin" type="password" name="pin">
                              </div>
                            </div>
                          <div class="text-right">
                            <button type="submit" class="btn btn-primary" form="modal-details">Submit</button>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 
            </form>
          </div>
        </div>
        <!-- /basic layout -->
      </div>
    </div>
@stop