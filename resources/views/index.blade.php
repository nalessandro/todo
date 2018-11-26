<!doctype html>
<html>
    <head>
        <title>Todo</title>
        
        <!-- Styles -->
        <link rel="stylesheet" 
                href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
                integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
                crossorigin="anonymous">
        <style>
            body{
                background-color:#EEEEEE;
                padding-top: 20px;
            }
            ul {
                list-style-type:none;
            }
            .todo {
                padding-bottom: 10px !important;
            }
            .todolist{
                background-color:#FFF;
                padding:20px;
            }
            
            .todolist h1{
                margin-top:0;
                padding-bottom:20px;
            }

            .todo-items {
                padding:0;
                margin: 0;
            }
            
            li.ui-state-default{
                background:#fff;
                border:none;
                border-bottom:1px solid #ddd;
            }

            .task-complete {
                padding:0 0 25px 0;

            }
            
            .label-success {
                margin:0 5px 0 0;
            }

            {{-- .todo-footer{
                background-color:#EFEFEF;
                margin:0 -20px -10px -20px;
                padding: 10px 20px;
            } --}}
            #done-items li{
                padding:10px;
                border-bottom:1px solid #ddd;
            }
            .form-group {
                margin: 
            }
        
            .hidden{
                visibility:hidden;
            }
        </style>   
    </head>

    <body>
        <div class="container">
            {{-- <div class="row"> --}}
                <div style="row">
                    <div class="col-md-6">
                        <div class="todolist not-done">
                            <h1>To Do</h1>
                            
                            {{ Form::open(array('url' => '/todos')) }}
                            <div class="form-group">
                                {{ Form::text('todo', null, array('class' => 'form-control', 'placeholder' => 'What needs done?')) }}
                            </div>
                                {{ Form::submit('Add', array('class' => 'btn btn-primary btn-sm pull-right')) }}
                            {{ Form::close() }}
                            <br/><hr/>
                                <h4 id="count"></h4>
                            <hr>

                            <ul class="todo-items">
                                {{ Form::open(array('id' => 'theList', 'url' => '/todos'))}}
                                @foreach($todos as $todo)
                                    @if($todo->isComplete == '0')
                                        <li><input class="todo" onclick="visibility($(this))" type="checkbox" value="{{ $todo->_id }}"> {{ $todo->todo }}  <a class="btn btn-xs btn-danger pull-right" href="/todos/{{ $todo->_id }}/destroy"><span class="glyphicon glyphicon-trash"></span></a></li>
                                    @endif
                                @endforeach
                            </ul>
                            <div class='task-complete hidden'>
                                <hr/>
                                    {{ Form::submit('Complete', array('id' => 'complete', 'class' => 'btn btn-sm btn-success pull-right'))}}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="todolist">
                            <h1>Done</h1>
                            <ul id="done-items" class="list-group">
                                @foreach($todos as $todo)
                                @if($todo->isComplete == '1')
                                    <li class="list-group-item">{{ $todo->todo }} <a class="btn btn-xs btn-danger pull-right" href="/todos/{{ $todo->_id }}/destroy"><span class="glyphicon glyphicon-trash"></span></a> <span class="pull-right label label-success" style="margin-top: 4px;">Complete</span></li>
                                @endif
                            @endforeach
                            </ul>
                        </div>
                    <div>
                </div>
            {{-- </div> --}}
        </div>
    
    
        <!-- JAVASCRIPTS -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> --}}
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>
        <script src="/js/todo.js"></script>
    </body>
</html>
