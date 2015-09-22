$(function() {
	"use strict";

	$("#submit-post").click(function() {
		var postData = $("#newpost").val();
		$.post("addpost.php", {
			"newpost" : postData,
			"dataType" : "json"
		}).done(successfulPost).fail(failedPost);
	});

	$(document).ready(function() {
		$(".btn-comment").click(function() {
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
		var d = jQuery.parseJSON(data);
		var rootDiv = $("<div>");
		rootDiv.addClass("row posts");
		
		var postDiv = $("<div>").addClass("col-lg-12 admin").attr({'id': "post-" + d[0]['item_id']}).text(d[0]['item_text'] + " ");
		
		var input = $("<input>").attr({'id': "new-comment-" + d[0]['item_id'], 'type': 'text'});
		var button = $("<button>").text("+ Comment").addClass("btn-primary add-post-height btn-comment").attr({'id': d[0]['item_id']});
		
		rootDiv.append(postDiv);
		postDiv.append(input);
		postDiv.append(button);
		
		$("#posts").prepend(rootDiv);
	}

	function failedPost(xhr, status, exception) {
		console.log(xhr, status, exception);
	}
});