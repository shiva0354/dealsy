@extends(auth_guard() =='admin' ?'layouts.adminlte' :'layouts.layout')

@section('title', __('Requested Url Not Found'))
@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <span> Requested Resource Not Found</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @includeWhen(auth_guard() !='admin','layouts.footer-call-to-action')
    @includeWhen(auth_guard() !='admin','layouts.footer-main')
@endsection
