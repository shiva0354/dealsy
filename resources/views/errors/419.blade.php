@extends(auth_guard() =='admin' ?'layouts.adminlte' :'layouts.layout')

@section('title', __('Page Expired'))
@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-1 pt-1 pb-2">419</h1>
                    <div class="alert alert-danger" role="alert">
                        <span>{{ __($exception->getMessage() ?: 'Page Expired') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @includeWhen(auth_guard() !='admin','layouts.footer-call-to-action')
    @includeWhen(auth_guard() !='admin','layouts.footer-main')
@endsection

@section('code', '419')
