
$(document).ready(function ($) {
    $('.todo-list').on('click','.glyphicon-remove-circle', function () {
        var taskId = $(this).parent().parent().find('.id-task').text(); //save id for drop line
        var objectToAjax = {};
        objectToAjax.ajaxUrl = "drop-task";
        objectToAjax.ajaxType = "post";
        objectToAjax.ajaxData = {"idTask":taskId};
        myAjax(objectToAjax);
        $(this).parent().parent().remove();


    });
    $('.todo-list').on('click','.glyphicon-pencil', function () { //function for update line
        var editText = $(this).parent().parent().find('.text');
        editText.parent().find('.glyphicon').css("display", "none");
        editText.parent().find('.saveButton').css("display", "inline")
        editText.attr('contenteditable', 'true').attr('id', 'editable');
        var taskId = $(this).parent().parent().find('.id-task').text();
        //start to set caret(cursor) position in contenteditable elementstart to set caret(cursor) position in contenteditable element
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
        //end to set caret(cursor) position in contenteditable elementstart to set caret(cursor) position in contenteditable element

    });
    $('.todo-list').on('click', '.saveButton', function () {
        var forClassDone = $(this).parent().parent();
        var taskId = forClassDone.find('.id-task').text();
        forClassDone.find('.text').removeAttr('contenteditable');
        forClassDone.find('.saveButton').css("display", "none");
        forClassDone.find('.glyphicon').css("display", "inline");
        var thisText = forClassDone.find('.text').text();
        thisText = $.trim(thisText); // trim - delete space
        forClassDone.find('.text').text(thisText);
        var objectToAjax = {};
        objectToAjax.ajaxUrl = "update-task";
        objectToAjax.ajaxType = "post";
        objectToAjax.ajaxData = {"idTask":taskId, "nameTask":thisText};
        myAjax(objectToAjax);
    });
    
    $('.forms').submit(function (e){
        e.preventDefault();
        var formObject = $(this);
        var objectToAjax = {};
        objectToAjax.ajaxUrl = formObject.attr('action');
        objectToAjax.ajaxType = formObject.attr('method');
        objectToAjax.ajaxData = formObject.serialize();
        myAjax(objectToAjax);
        $('.form-group input').val("");
    });

    function myAjax(ajaxObjact){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: ajaxObjact.ajaxType,
            url: ajaxObjact.ajaxUrl,
            data: ajaxObjact.ajaxData,
            success: function (data) {
                if(data[0] == 'category'){
                    var a = $('.list-group .list-group-item:first .badge').text(); //count Category
                    a = +a + 1;
                    if($('.list-group .list-group-item').hasClass('no-category')){
                        $('.no-category').detach();
                    }
                    $('.list-group .list-group-item:first .badge').text(a);
                    $('.list-group').append("<a href='#' class='list-group-item'>" + data[1].name_category +
                        "<span class='badge'>1</span> </a>");
                    $('#create_task_modal').find('.form-control').append("<option value="+ data[1].id + ">" + data[1].name_category +"</option>");
                }
                $('#create_category_modal').modal("hide");
                if(data[0] == 'task'){
                    $('.todo-list').append('<li class="done"> <input type="checkbox" value=""> <span class="id-task" style="display: none">' +
                        data[1].id + '</span> <span class="text">' + data[1].name_task + '</span> <small class="label label-danger">' +
                        data[1].name_category + '</small> <div class="tools"> <button class="saveButton" type="button" name="buttonSave"value="Save" style="height: 17px; width: auto; font-size: x-small">' +
                        'Save </button> <i class="glyphicon glyphicon-pencil"></i> <i class="glyphicon glyphicon-remove-circle" ></i> </div> </li>');
                }
                $('.form-group select').val(0);
                $('#create_task_modal').modal("hide");
            },
            error: function () {
                alert('error');
            }
        });
    }

});