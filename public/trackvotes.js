let currentUrl = document.URL;
let votesElement = document.querySelector("#votes");
let link = '/admin/newvotes';
let notifyLink = '/admin/latestvotes';
const INTERVAL = 5000;

let isInVotingURL = () => {
	return (currentUrl.includes('admin/voting'));
};

	document.addEventListener('DOMContentLoaded' , () => {
		window.setInterval( () => {
			if (isInVotingURL()) {
				fetch(link, { headers: { "Content-Type": "application/json; charset=utf-8" }})
			    .then(res => res.json()) // parse response as JSON
			    .then(data => {
			        	if (data.positions.length !== 0 && data.candidates.length !== 0) {
					 		displayDataInVotingURL(data);
					 	}
			    });
			}
			//display notification and get the latest record
			if (window.myApp.last_vote !== 0 ) {
				fetch(notifyLink, {
					headers: { "Content-Type": "application/json; charset=utf-8" },
					method:'POST',
					body : JSON.stringify(window.myApp)
				})
			    .then(res => res.json()) // parse response as JSON
			    .then(data => {
			    	//check if there's new vote
			    	if (typeof(data.candidate)  !== 'undefined' &&data.candidate.length !== 0) {
			    		notifyAdmin(data);
			    	}
			    	window.myApp.last_vote = data.update_vote_date;
			    });
			}
		},INTERVAL);




let displayDataInVotingURL = (data) => {
		let imgDir = window.myApp.image_path;
 		let element = "";
 		//append the new votes
 		votesElement.innerHTML = null;
 		// loop through positions
 		data.positions.forEach((position , key) => {
 			//set up tiles
 			element += "<div class='row top_tiles'><h3 style='margin-left : 1vw;'>"+position.name+"</h3>";
 			//loop through candidates
 			data.candidates.forEach((candidate, keys) => {
 				//grouping
 				if (position.id == candidate.position_id) {
 					element += '<div class="flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12"><div class="tile-stats"><div class="text-center"><img src="'+imgDir +'/'+ candidate.profile +'" alt="..." class="img-circle img-responsive profile_img text-center"></div><div class="clearfix"></div><div class="text-center count">'+candidate.votes.length+'</div><div class="text-center count">'+candidate.student_info.lastname+' , '+candidate.student_info.firstname+' '+candidate.student_info.middlename.substring(0,1)+'.</div></div></div>';
 				}
 			});
 			//closing the tiles set up
 		element += "</div><hr />";
 	});
 	//append
 	votesElement.innerHTML = element;
};

let notifyAdmin = (data) => {
	$.amaran({
		'theme'     :'colorful',
		'content'   :{
		bgcolor:'#27ae60',
		color:'#fff',
		message:`${data.candidate.student_info.lastname}, ${data.candidate.student_info.firstname} ${data.candidate.student_info.middlename.substring(0,1).toUpperCase()}. running for ${data.candidate.position.name} has new vote`
		},
		'position'  :'bottom right',
		'outEffect' :'slideBottom',
		'sticky':true
	});
};


});
