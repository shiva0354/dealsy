@extends(auth_guard() =='admin' ?'layouts.adminlte' :'layouts.layout')

@section('title', __('Not Found'))
@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 404-content">
                    <h1 class="display-1 pt-1 pb-2">404</h1>
                    <div class="alert alert-danger" role="alert">
                        <span> {{ $exception->getMessage() }}</span>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-info">GO HOME</a>

                </div>
            </div>
        </div>
    </section>
    @includeWhen(auth_guard() !='admin','layouts.footer-call-to-action')
    @includeWhen(auth_guard() !='admin','layouts.footer-main')
@endsection
