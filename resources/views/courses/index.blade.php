<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Many To Many</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  Github@01632109022
  <body>
    <div class="container">
        <div class="row">
            <div class="col-6 py-2">
                <a href="{{ route('questions.index') }}" class="btn btn-dark">Go Questions</a>
            </div>
            <div class="col-6 text-end py-2">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Create">Create Course</a>
            </div>
            <!-- Create -->
            <div class="modal fade" id="Create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('courses.store') }}" method="post"> @csrf
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="">Name :</label>
                                <input type="text" name="name" class="form-control my-2" required>
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 py-2">
                <div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-end">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($courses as $data)
                          <tr>
                            <td>{{ $data->name }}</td>
                            <td class="text-end">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Edit{{ $data->id }}">Edit</a>
                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Delete{{ $data->id }}">Delete</a>
                            </td>
                          </tr>
                            <!-- Delete -->
                            <div class="modal fade" id="Delete{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('courses.destroy',$data->id) }}" method="post"> @csrf @method('delete')
                                        <div class="modal-body text-danger fs-3 text-center">
                                            Are you sure ?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit -->
                            <div class="modal fade" id="Edit{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('courses.update',$data->id) }}" method="post"> @csrf @method('put')
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="">Name :</label>
                                                    <input type="text" name="name" value="{{ $data->name }}" class="form-control my-2" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>