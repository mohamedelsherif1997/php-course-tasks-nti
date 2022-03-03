<!DOCTYPE html>
<html>

<head>
    <title>Your Tasks</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }
        .m-b-1em {
            margin-bottom: 1em;
        }
        .m-l-1em {
            margin-left: 1em;
        }
        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1>Yout Tasks </h1>      {{  "Welcome , ".auth()->user()->name  }}
            <br>

          
        </div>

        <a href="{{url('/Tasks/create')}}">+ Task</a>   ||     <a href="{{url('/Users/LogOut')}}">+ LogOut</a>

        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Task</th>
                <th>Content</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>action</th>
            </tr>


        @foreach ($data as $value )


            <tr>
                <td>{{ $value->id}}</td>
                <td>{{ $value->title }}</td>
                <td>{{ substr($value->content,0,50)}}</td>

                <td><img src="{{url('/tasksImages/'.$value->image)}}" alt=""  width="50" height="50"></td>
                <td>{{$value->userName}}</td>
                <td>
                    <a href='' data-toggle="modal" data-target="#modal_single_del{{ $value->id}}" class='btn btn-danger m-r-1em'>Remove </a>
                    <a href='{{url('/Tasks/'.$value->id.'/edit')}}' class='btn btn-primary m-r-1em'>Edit</a>
                </td>
            </tr>




            <div class="modal" id="modal_single_del{{ $value->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">delete confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                       </button>
                        </div>

                        <div class="modal-body">
                          Remove   {{$value->task}} !!!!
                        </div>
                        <div class="modal-footer">
                            <form action="{{url('/Tasks/'.$value->id)}}" method="post">

                                @csrf
                                @method('delete')

                                <div class="not-empty-record">
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




       @endforeach

            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>