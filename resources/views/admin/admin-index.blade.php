@extends('layouts.adminlte')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-dark">All Admins</h1>
        </div>
        <div class="col-md-6">
            <a href="{{ route('admin.admins.create') }}" class="btn btn-info float-right">Add New Admin</a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-valign-middle">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Enabled/Disabled</th>
                                <th scope="col">Role</th>
                                <th scope="col" class="min-w-200"></th>
                                <th scope="col" class="td-delete"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->enabled == 1 ? 'Enabled' : 'Disabled' }}</td>
                                    <td>{{ $admin->role }}</td>
                                    <td class="td-actions-1">
                                        <a href="{{ route('admin.admins.edit', $admin) }}" class="btn text-primary"><i class="fas fa-edit"></i> Edit</a>
                                    </td>
                                    <td class="td-delete">
                                        <form action="{{ route('admin.admins.destroy', $admin) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-danger"><i class="fas fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                    {{-- <td class="td-actions">
                                        <a href="{{ route('admin.audits.admin.one', $admin) }}" class="btn text-primary"><i class="fas fa-history"></i> Audit</a>
                                        <a href="{{ route('admin.audits.admin.by', $admin) }}" class="btn text-primary"><i class="fas fa-history"></i> Actions</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
