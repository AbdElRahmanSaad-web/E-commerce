@extends('admin_layout.app')
@section('body')
    @php($n = 1)
    <table class="table table-dark table-striped mt-5">
        <thead>
            <th>id</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>User Type</th>
            <th>New User Type</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($persons as $person)
                <tr>
                    <td>{{ $person->id }}</td>
                    @if ($person->usertype == '1')
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->email }}</td>
                        <td>Admin</td>
                    @elseif ($person->usertype == '2')
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->email }}</td>
                        <td>Moderator</td>
                    @else
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->email }}</td>
                        <td>User</td>
                    @endif
                    <form action="{{ route('save.role',$person->id) }}" method="POST">
                        @csrf
                        <td>
                            <select name="role" class="form-select text-dark" aria-label="Default select example">
                                <option value="1">Admin</option>
                                <option value="2">Moderator</option>
                                <option value="0" selected>User</option>
                            </select>
                        </td>
                        <td><button class="btn btn-success"><i class="fa-sharp fa-solid fa-download"></i></button></td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
