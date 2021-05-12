@extends('admin.layouts.master')

@section('content')
	<div class="box">
		<div class="box-header with-border" style="background-color: #283142;">
			<h3 class="box-title">Manage Commission</h3>
			<!--<div class="box-tools pull-right">-->
			<!--    <a href="javascript:void(0)" data-link="{{ route('admin.deliverypartner.create') }}" class="ajax-modal-btn btn btn-new btn-flat">Add Delivery Partner</a>n-->
			<!--</div>-->
		</div> <!-- /.box-header -->
		<div class="box-body">
		    <div class="row">
                <form class="" enctype="multipart/form-data">
                <div class="col-md-6">
                        <div class="form-group" style="padding:1%">
                            <label for="name" class="col-sm-2 col-md-4 control-label">Start Date <i class="fa fa-question-circle" aria-hidden="true"></i></label>
                            <div class="col-sm-8 col-md-6" >
                                <input type="text" name="startdate" class="form-control datepicker startdate" id="datepicker"
                                    @if(isset($_REQUEST['startdate']) and !empty($_REQUEST['startdate']))
                                        value="{{ $_REQUEST['startdate'] }}" 
                                         @else
                                    value="<? $d = new DateTime('first day of this month');
                                echo $d->format('Y-m-d');?>"
                                    @endif
                                 placeholder="Start Date" readonly>
                             </div>
                             <div class="col-sm-2 col-md-2"><button class="btn-xs" type="button" onclick="startdateclear()" style="padding: 6px !important;">clear</a></div>
                             
                          </div>
                    </div>
					<div class="col-md-6">
                    <div class="form-group" style="padding:1%">
                        <label for="name" class="col-sm-2 col-md-4 control-label">End Date <i class="fa fa-question-circle" aria-hidden="true"></i></label>
                        <div class="col-sm-8 col-md-6">
                        <input type="text" name="enddate" class="form-control datepicker enddate" id="datepicker1" 
                            @if(isset($_REQUEST['enddate']) and !empty($_REQUEST['enddate']))
                                value="{{ $_REQUEST['enddate'] }}" 
                            @else
                            value="<? $d = new DateTime('last day of this month');
                                echo $d->format('Y-m-d');?>"
                            @endif
                         placeholder="End Date" readonly>
                         </div>
                         <div class="col-sm-2 col-md-2"><button class="btn-xs" type="button" onclick="enddateclear()" style="padding: 6px !important;">clear</a></div>
                      </div>
					</div> 
                
                <div class="col-md-12" style="padding-top:1%; text-align:center">
                    <button type="submit" class="btn btn-success">Search</button>
                      <a href="{{ URL::to('admin/report/reportlist')}}" class="btn btn-danger">Clear Search</a>
                </div>
                
                </form>  

             </div>
		    
			<table class="table table-hover table-2nd-no-sort">
				<thead>
					<tr>
						<th>S. No.</th>
						<th>Object</th>
						<th>Type</th>
						<th>Readable</th>
						<th>Margin</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="massSelectArea">
					@foreach($courier as $k=>$c )
						<tr class="">
							<td>{{ ++$k }}</td>
							<td>{{ $c->object }}</td>
				          	<td>{{ $c->type }}</td>
				          	<td>{{ $c->readable }}</td>
				          	<td>{{ $c->margin }}</td>
							<td>
							    @if($c->status == 1)
							        Active
							    @else
							        Inactive
							    @endif
							</td>
							<td>
							    <a href="javascript:void(0)" data-link="{{ route('admin.deliverypartner.edit', $c->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
    	   <!--             	    {!! Form::open(['route' => ['admin.deliverypartner.destroy', $c->id], 'method' => 'delete', 'class' => 'data-form']) !!}-->
			     <!--                   {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}-->
								<!--{!! Form::close() !!}-->
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->

<script>
    function enddateclear()
    {
        $('.enddate').val("");
    }
    
    function startdateclear()
    {
        $('.startdate').val("");
    }
    
</script>
@endsection