@extends('dashboard')
@section('listuser')
    <div class="container">
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            ID
                        </th>
                        <th>Image</th>
                        <th style="width: 12%">
                            Name
                        </th>
                        <th style="width: 10%">
                            Phone
                        </th>
                        <th>
                            Email
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <td>
                                {{ $item->id }}
                            </td>
                            <th>
                                <img src="{{ asset('assets/uploads/' . $item->image) }}" alt="" srcset=""
                                    height="100px" width="150px">
                            </th>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->phone }}
                            </td>
                            <td>
                                {{ $item->email }}
                            </td>

                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="{{ url('admin/edit-product/' . $item->id) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="{{ url('admin/delete-product/' . $item->id) }}">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
