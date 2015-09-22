/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function(){
    $('#btnSaveTodo').click(function(){
        var item_text = $('#txtNewTodo').val();
        //alert(item_text);
        $.post('todolist.php', {'call':'Insert', 'itemText':item_text})
                .done(ReloadList)
                .fail(ajaxFailure);        
    });
});

function ReloadList(){
    $('#txtNewTodo').val = "";
    alert('inserted');
}

function ajaxFailure(){
        $('#output').text('An ajax error occurred.');
    }