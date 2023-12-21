<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Many To Many</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-6 py-2">
                <a href="{{ route('courses.index') }}" class="btn btn-dark">Go Courses</a>
            </div>
            <div class="col-6 text-end py-2">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Create">Create Question</a>
            </div>
            <!-- Create -->
            <div class="modal fade" id="Create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('questions.store') }}" method="post"> @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Title :</label>
                                        <input type="text" name="title" class="form-control my-2" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="">Courses :</label>
                                        @foreach($courses as $data)
                                        <div class="form-check">
                                            <input name="course_id[]" class="form-check-input" type="checkbox" value="{{ $data->id }}" id="flexCheck{{ $data->id }}">
                                            <label class="form-check-label" for="flexCheck{{ $data->id }}">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
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
                            <th scope="col">Title</th>
                            <th scope="col">Course</th>
                            <th scope="col" class="text-end">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($questions as $data)
                          <tr>
                            <td>{{ $data->title }}
                            </td>
                            <td>
                                @foreach($data->courses as $course){{ $course->name }}<br>@endforeach
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Edit{{ $data->id }}">Edit</a>
                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Delete{{ $data->id }}">Delete</a>
                            </td>
                          </tr>
                          <!-- Edit -->
                          <div class="modal fade" id="Edit{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="{{ route('questions.update',$data->id) }}" method="post"> @csrf @method('patch')
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="">Title :</label>
                                                    <input type="text" name="title" value="{{ $data->title }}" class="form-control my-2" required>
                                                </div>
                                                <div class="col-12">
                                                    <label>Courses :</label>
                                                    @foreach($courses as $course)
                                                    <div class="form-check">
                                                        <input name="course_id[]" class="form-check-input" type="checkbox" value="{{ $course->id }}" id="flexCheckA{{ $course->id }}"
                                                            {{ in_array($course->id, $data->courses->pluck('id')->toArray()) ? 'checked' : '' }}
                                                        >
                                                        <label class="form-check-label" for="flexCheckA{{ $course->id }}"> {{ $course->name }} </label>
                                                    </div>
                                                    @endforeach
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
                          <!-- Delete -->
                          <div class="modal fade" id="Delete{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="{{ route('questions.destroy',$data->id) }}" method="post"> @csrf @method('delete')
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