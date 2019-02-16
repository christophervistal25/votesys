let currentUrl = document.URL;

//run the ajax
$(document).ready(() =>  {
	window.setInterval( () => {
	 $.get("/admin/newvotes", function(data, status){
	 	//check if there's running for a position
	 	if (data.positions.length !== 0 && data.candidates.length !== 0) {
	 		displayData(data);
	 	}
	  });
	},1000);

let displayData = (data) => {
	if (currentUrl.includes('/admin/voting')) {
		 		let element = "";
		 		//append the new votes
		 		$('#votes').html('');
		 		data.positions.forEach((position , key) => {
		 			element += "<div class='row top_tiles'><h3 style='margin-left : 1vw;'>"+position.name+"</h3>";
		 			data.candidates.forEach((candidate, keys) => {
		 				if (position.id == candidate.position_id) {
		 					element += '<div class="flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12"><div class="tile-stats"><div class="icon"><i class="fa fa-check-square-o"></i></div><div class="count">'+candidate.votes.length+'</div><div class="count">'+candidate.student_info.lastname+' , '+candidate.student_info.firstname+' '+candidate.student_info.middlename.substring(0,1)+'.</div></div></div>';
		 				}
		 			});
		 		element += "</div><hr />";
		 	});
		 	$('#votes').html(element);
		 	} else {
				//otherwise display notifier for new votes
				console.log('Display notifier in ' + currentUrl);
		 	}
};
});

