@extends('admin_layout.app')

@section('body')
    @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
    @endif

    <h1>Show Users Page</h1>

    @php($n = 1)
    <table class="table table-dark table-striped mt-5">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Phone</th>
            <th>Address</th>
            <th>User Type</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $n++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td>
                        @if($user->usertype == '1')
                            Admin
                        @elseif ($user->usertype == '2')
                            Moderator
                        @else
                            User
                        @endif
                    </td>
                    <td>
                        {{-- <a href="" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a> --}}
                        @if(Auth::user()->usertype == '1')
                        <form action="{{ route('delete.user', $user->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('Are you Sure To Delete This')" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></button>
                        </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
