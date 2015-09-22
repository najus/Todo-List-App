$(function() {
	"use strict";

	$(document).ready(function() {
		$("body").on("click", "#btnSaveTodo", function() {
			var postData = $("#txtNewTodo").val();
			$("#txtNewTodo").val("");
			$.post("addpost.php", {
				"newpost" : postData,
				"dataType" : "json"
			}).done(successfulPost).fail(failedPost);
		});
	});

	$(document).ready(function() {
		$("body").on("click", ".btn-comment", function() {
			var postComment = $("#new-comment-" + this.id).val();
			$.post("addcomment.php", {
				"newcomment" : postComment,
				"postid" : this.id,
				"dataType" : "json"
			}).done(successfulComment).fail(failedComment);
		});
	});
	
	function successfulComment(data) {
		var d = jQuery.parseJSON(data);
		var postDiv = $("#post-" + d[d.length - 1]['item_id']);
		
		var commentRootDiv = $("<div>").addClass("row comments");
		var commentDiv = $("<div>").addClass("col-lg-6 admin").attr({'id': "comment-" + d[d.length - 1]['comment_id']}).text(d[d.length - 1]['comment_text']);
		
		commentRootDiv.append(commentDiv);
		postDiv.append(commentRootDiv);
	}
	
	function failedComment(xhr, status, exception) {
		console.log(xhr, status, exception);
	}

	function successfulPost(data) {
//		var d = jQuery.parseJSON(data);
//		var rootDiv = $("<div>");
//		rootDiv.addClass("row posts");
//		
//		var postDiv = $("<div>").addClass("col-lg-12 admin").attr({'id': "post-" + d[0]['item_id']}).text(d[0]['item_text'] + " ");
//		
//		var input = $("<input>").attr({'id': "new-comment-" + d[0]['item_id'], 'type': 'text'});
//		var button = $("<button>").text("+ Comment").addClass("btn-primary add-post-height btn-comment").attr({'id': d[0]['item_id']});
//		
//		rootDiv.append(postDiv);
//		postDiv.append(input);
//		postDiv.append(button);
//		
//		$("#posts").prepend(rootDiv);
		
		var post = jQuery.parseJSON(data)[0];
		var post_id = post["item_id"];

		var rootLi = $("<li>").attr({"class": "list-group-item titleBox", "id": post_id});

		var postLabel = $("<label>").attr({"id": "item-" + post_id}).text(post["item_text"]);
		rootLi.append(postLabel);

		

		var postActionDiv = $("<div>").attr({"class": "pull-right action-buttons", "id": "action-buttons-" + post_id});
		var editList = $("<a>").attr({"id": "editList-" + post_id}).append($("<span>").attr({"class": "glyphicon glyphicon-pencil"}));
		var deleteList = $("<a>").attr({"id": "deleteList-" + post_id, "class": "trash"}).append($("<span>").attr({"class": "glyphicon glyphicon-trash"}));
		var markList = $("<a>").attr({"id": "markList-" + post_id, "class": "flag"}).append($("<span>").attr({"class": "glyphicon glyphicon-ok"}));
		postActionDiv.append(editList).append(deleteList).append(markList);
		rootLi.append(postActionDiv);

		var actionBoxDiv = $("<div>").attr({"class": "actionBox", "id": "actionBox-" + post_id});
		var commentListUl = $("<ul>").attr({"class": "commentList", "id": "commentList-" + post_id});
		var inlineForm = $("<form>").attr({"class": "form-inline", "role": "form"});

		var newCommentDiv = $("<div>").attr({"class": "form-group"}).append($("<input>").attr({"class": "form-control", "id": "form-control-" + post_id, "type": "text", "placeholder": "Your comments"}));
		var addCommentDiv = $("<div>").attr({"class": "form-group"}).append($("<button>").attr({"class": "btn btn-success", "id": "btn-" + post_id}).text("Add"));
		inlineForm.append(newCommentDiv).append(addCommentDiv);

		actionBoxDiv.append(commentListUl).append(inlineForm);
		rootLi.append(actionBoxDiv);

		$(".list-group").prepend(rootLi);
	}

	function failedPost(xhr, status, exception) {
		console.log(xhr, status, exception);
	}
});