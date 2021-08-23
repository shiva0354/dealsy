@extends('layouts.adminlte')

@section('title', __('Forbidden'))
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-danger">
                    <h5 class="card-title">{{ __($exception->getMessage() ?: 'Forbidden') }}</h5>
                </div>
                <!-- /.card-header -->

            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@stop
@section('message', __($exception->getMessage() ?: 'Forbidden'))
