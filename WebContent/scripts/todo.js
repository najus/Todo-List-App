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
		$("body").on("click", "button", function() {
			var inputCommentId = this.id.split("-")[1];
			var postComment = $("#form-control-" + inputCommentId).val();
			$("#form-control-" + inputCommentId).val("");
			
			$.post("addcomment.php", {
				"newcomment" : postComment,
				"postid" : inputCommentId,
				"dataType" : "json"
			}).done(successfulComment).fail(failedComment);
		});
	});
	
	function successfulComment(data) {
		var d = jQuery.parseJSON(data);
		var comment = d[d.length - 1];
		var comment_id = comment["comment_id"];
		var post_id = comment["item_id"];

		var rootLi = $("<li>");

		var commentTextDiv = $("<div>").attr({"class": "commentText", "id": "commentText-" + comment_id});
		var commentP = $("<p>").attr({"class": ""}).text(comment["comment_text"]);
		var actionButtonDiv = $("<div>").attr({"class": "pull-right action-buttons"});

		var editComment = $("<a>").attr({"id": "editComment-" + comment_id}).append($("<span>").attr({"class": "glyphicon glyphicon-pencil"}));
		var deleteComment = $("<a>").attr({"id": "deleteComment-" + comment_id, "class": "trash"}).append($("<span>").attr({"class": "glyphicon glyphicon-trash"}));
		actionButtonDiv.append(editComment).append(deleteComment);

		var authorSpan = $("<span>").attr({"class": "date sub-text"}).text("By " + comment["user_id"] + " on " + comment["created_date"]);

		commentTextDiv.append(commentP).append(actionButtonDiv).append(authorSpan);
		rootLi.append(commentTextDiv);
		
		$("#commentList-" + post_id).append(rootLi);
	}
	
	function failedComment(xhr, status, exception) {
		console.log(xhr, status, exception);
	}

	function successfulPost(data) {
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
		var inlineForm = $("<div>").attr({"class": "form-inline"});

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