
<!doctype html>
<html lang="en">
<link rel="stylesheet" href="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-DO</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Bootstrap -->
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/new-to-do.css') }}">
    {{---------------------------}}
            <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>
<body>
<div class="container">
    <!-- NAVBAR START -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">TO-DO List</a>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- CONTENT START -->
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading lead clearfix">
                    Categories
                    <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create_category_modal">
                        Create New Category
                    </button>
                </div>
                <div class="panel-body list-group">
                    <a href="#" class="list-group-item active">
                        <span class="badge">{{  count($arrayCategory) }}</span>
                        All
                    </a>
                    @if(count($arrayCategory) != 0)
                        @foreach($arrayCategory as $category)
                        <a href="#" class="list-group-item">
                            {{ $category }}
                            <span class="badge">1</span>
                        </a>
                        @endforeach
                    @else
                        <a href="#" class="list-group-item" style="text-align: center">
                            You don't have category!!
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading lead clearfix">
                    Tasks
                    <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create_task_modal">
                        Create New Task
                    </button>
                </div>
                <div class="panel-body">
                    <ul class="todo-list ui-sortable">
                        @foreach($arrayCatTask as $task)
                            <li class="done">
                                <input type="checkbox" value="">
                                <span class="text">{{ $task->name_task }}</span>
                                <small class="label label-danger">{{ $task->name_category }}</small>
                                <div class="tools">
                                    <button class="saveButton" type="button" name="buttonSave"
                                        value="Save" style="height: 17px; width: auto; font-size: x-small">Save
                                    </button>
                                    <i class="glyphicon glyphicon-pencil"></i>
                                    <i class="glyphicon glyphicon-remove-circle" ></i>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- CONTENT END -->
    <!-- CATEGORY MODAL START -->
    <div id="create_category_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Create New Category</h4>
                </div>
                <form class="forms">{{ csrf_field() }}
                    <div class="modal-body">
                            <div class="form-group">
                                <label>List Name</label>
                                <input type="text" name="nameCategory" class="form-control" placeholder="List Name">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <input type="submit" class="btn btn-primary" value="Save changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- CATEGORY MODAL END -->

    <!-- TASK MODAL START -->
    <div id="create_task_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Create New Task</h4>
                </div>
                <form class="forms">
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Task</label>
                                <input type="text" name="nameTask" class="form-control" placeholder="Task">
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select name="id" class="form-control">
                                    <option>None</option>
                                    @foreach($arrayCategory as $id => $category)
                                        <option value ={{ $id }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <input type="submit" class="btn btn-primary" value="Save changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- TASK MODAL END -->

</div>
<script>
    $(document).ready(function ($) {
        $('.glyphicon-remove-circle').on('click', function () {
            $(this).parent().parent().remove();
        });
        $('.glyphicon-pencil').on('click', function () {
            var editText = $(this).parent().parent().find('.text');
            editText.parent().find('.glyphicon').css("display", "none");
            editText.parent().find('.saveButton').css("display", "inline")
            editText.attr('contenteditable', 'true').attr('id', 'editable');
            var currentText = editText.text();
            currentText += " ";
            editText.text(currentText);
            var el = document.getElementById("editable");
            var range = document.createRange();
            var sel = window.getSelection();
            range.setStart(el.childNodes[0], editText.text().length-1);
            range.collapse(true);
            sel.removeAllRanges();
            editText.removeAttr('id');
            sel.addRange(range);
        });
        $('.saveButton').click(function () {
            var forClassDone = $(this).parent().parent();
            forClassDone.find('.text').removeAttr('contenteditable');
            forClassDone.find('.saveButton').css("display", "none");
            forClassDone.find('.glyphicon').css("display", "inline");
            var thisText = forClassDone.find('.text').text();
            thisText = $.trim(thisText);
            forClassDone.find('.text').text(thisText);
        });

        $(this).submit(function () {
            $.ajax({
                type: 'POST',
                url:
            });
        });


//        function toDoAjax(drama){
//           alert(drama);
//        }
    });
</script>
</body>
</html>



{{--<form action= 'post' method="POST">{{ csrf_field() }}--}}
{{--form action="postTask" method="post">{{ csrf_field() }}--}}
/**
* Created by zelin on 10.11.2016.
*/
jQuery(document). ready(function ($) {
$(".form-button-paper").on("click", function () {
var n = $(this).find(".image-ok");
//  cosole.log(myAjaxName);
$.ajax({
type: 'POST',
url: myAjaxName.url,
data: { test: 'Тестовый запрос',
action: 'my_action_paper',
postId: myAjaxName.postId
},
success: function (dd){
$(n).fadeIn('slow');
console.log(dd);
},
error: function () {
alert("error!!!");
}
});
});
});