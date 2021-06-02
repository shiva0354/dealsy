@extends('layouts.adminlte')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-dark">All Users</h1>
        </div>
        <div class="col-md-6">
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-valign-middle">
                        <span>Total:{{ $users->total() }}</span>
                        <thead>
                            <tr>
                                {{-- <th scope="col">image</th> --}}
                                <th scope="col">Name</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Email</th>
                                <th scope="col">Provider</th>
                                <th scope="col" class="min-w-200"></th>
                                <th scope="col" class="td-delete"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    {{-- <td><img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="brand-image img-circle elevation-3" width="50px"></td> --}}
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->provider }}</td>
                                    <td class="td-actions-2">
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn text-primary"><i
                                                class="fas fa-eye"></i> View</a>
                                        <a href="{{ route('admin.users.destroy', $user) }}" class="btn text-primary"><i
                                                class="fas fa-trash"></i> Delete</a>
                                    </td>
                                    {{-- <td class="td-actions-2">
                                        <a href="{{ route('admin.audits.user.one', $user) }}" class="btn text-primary"><i class="fas fa-history"></i> Audit</a>
                                        <a href="{{ route('admin.audits.user.by', $user) }}" class="btn text-primary"><i class="fas fa-history"></i> Actions</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- // pagination --}}
    <div class="row justify-content-center">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@stop
