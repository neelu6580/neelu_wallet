@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h3 class="mb-0"> {{$details->title}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('page.update')}}" method="post">
                    @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{$details->title}}:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="title" class="form-control" value="{{$details->title}}">
                                    <input type="hidden" name="id" value="{{$details->id}}">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{ __('Details')}}:</label>
                                <div class="col-lg-10">
                                    <textarea type="text" name="content" class="form-control tinymce">{{$details->content}}</textarea>
                                </div>
                            </div>               
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-sm">{{ __('Save')}}</button>
                        </div>
                    </form>
            </div>
        </div> 
@stop