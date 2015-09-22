$(function() {
	"use strict";

	$("#submit-post").click(function() {
		var postData = $("#newpost").val();
		$.post("addpost.php", {
			"newpost" : postData
		}).done(successfulPost).fail(failedPost);
	});

	function successfulPost(data) {
		alert(data);
	}

	function failedPost(xhr, status, exception) {
		console.log(xhr, status, exception);
	}
});