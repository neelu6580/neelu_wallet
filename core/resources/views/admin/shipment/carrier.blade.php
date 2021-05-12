@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Carriers</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
            					<tr>
            					    <th>S. No.</th>
            						<th>Object</th>
            						<th>Type</th>
            						<th>Readable</th>
            						<th>Logo</th>
            						<th>Access Key Id</th>
            						<th>Secret Key</th>
            						<th>Merchant Id</th>
            						<th>Status</th>
            						<th>Action</th>
            					</tr>
            				</thead>
            				<tbody>
            					@foreach($carriers as $k=>$data )
            						<tr>
            						    <td>{{ ++$k }}</td>
            						    <td>{{ $data->object }}</td>
            						    <td>{{ $data->type }}</td>
            						    <td>{{ $data->readable }}</td>
            						    <td>{{ $data->logo }}</td>
            						    <td>{{ $data->access_key_id }}</td>
            						    <td>{{ $data->secret_key }}</td>
            						    <td>{{ $data->merchant_id }}</td>
            						    <td>
            						        @if($data->status == 1)
            						            Active
            						        @else
            						            Inactive
            						        @endif
            						    </td>
            						   
            						    <td class="text-center">
                                            <div class="">
                                                <div class="dropdown">
                                                    <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a data-toggle="modal" data-target="#description{{$data->id}}" href="" class="dropdown-item">Edit</a>
                                                    </div>
                                                </div>
                                            </div> 
                                        </td> 
            						</tr>
                                    <div class="modal fade" id="description{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <div class="card bg-white border-0 mb-0">
                                                        <div class="card-body">
                                                            <form method="Post" action="{{ route('admin.carriers.update', $data->id) }}">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label>Status</label>
                                                                    <select class="form-control makeSlug" name="status">
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Inctive</option>
                                                                    </select>
                                                                  <div class="help-block with-errors"></div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                @endforeach               
                            </tbody>                    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop