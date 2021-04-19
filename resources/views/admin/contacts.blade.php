@extends('layouts.adminlte')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-dark">Contact Request</h1>
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
                                <th scope="col">Message</th>
                                <th scope="col" class="td-delete"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->message }}</td>
                                    <td class="td-delete">
                                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-danger"><i class="fas fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
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
        {{ $contacts->links('pagination::bootstrap-4') }}
    </div>
@stop
