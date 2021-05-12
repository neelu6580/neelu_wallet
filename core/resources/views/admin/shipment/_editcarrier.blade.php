<div class="modal-dialog modal-md">
    <div class="modal-content">
        <?php $de = json_decode($courierData); 
        
        $en = json_decode(json_encode($courierData),true);
        // echo $en[0]['id'];
        // die(); ?>
        {!! Form::model($courierData, ['method' => 'Post', 'route' => ['admin.carriers.update', $en[0]['id']], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
            @include('admin.shipment._formcarrier')
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->