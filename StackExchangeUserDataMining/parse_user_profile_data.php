<?php 
	
	//List of user profiles.
	$profiles = array(
					 "Senior Software Engineer",
					 "Lead Software Engineer",
					 "Software Engineer",
					"Machine Learning Engineer",
					 "Senior Software Developer",
					 "Lead Software Developer",
					"Machine Learning Developer",
					"Software Developer",
					"Full Stack Developer",
					"Front End Developer",
					"Back End Developer",					 
					"Software Architect",
					"Senior Software Architect",
					"PHP Developer",
					"Developer",
					"Engineer",
					"Data Scientist"
					);
	$tags = array(
				"php",
				"polyglot",
				"unit-testing",
				"machine-learning","data-mining","bigdata",
				
			);
	/* Parsing user data */
	$file = fopen("QueryResults.csv","r");
	$users = array();
	while(!feof($file)){	
		$user = fgetcsv($file);
		$about_me = $user[5];
		if($about_me == "")
			continue;					//Not considering the users which have an empty about me section.
	    $about_me = strtolower($about_me);
		foreach($profiles as $profile){
			$profileLC = strtolower($profile);
			if(preg_match("/$profileLC/", $about_me)){
				$user['profile'] = $profile;
				$users[] = $user;
				break;
			}
							
		}
	}
	fclose($file);	
	print(count($users));
	$j = 0;
	$top_hundred_users = array();
	for($i = 0; $i < 100; $i++){
	//	print_r($users[$i]);	
		$tags_in_common = get_user_tags($users[$j][0],$tags);
		
		if(count($tags) == 0)
		{
			print("none found\n");
			$i--;
			
		}else{

			
			$user_of_interest = return_user($users[$j]);
			$user_of_interest['relevant_tags'] = $tags_in_common;
			$top_hundred_users[] = $user_of_interest;
		}
		$j++;
		
	}
	$top_ten = get_top_ten($top_hundred_users);
	print_r($top_ten);

/*get the top tags in which the user's contribution has been most signficant */
function get_user_tags($userID,$tags){
	$url= "http://api.stackexchange.com/2.2/users/$userID/top-tags?site=stackoverflow";		
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_ENCODING, ""); // this will handle gzip content
	$result = curl_exec($ch);
	curl_close($ch);
	//print $result;
	$json = json_decode($result,true);
	$in_common = array();
	print_r($json);
	foreach($json['items'] as $item){
		foreach($tags as $tag){
			if(preg_match("/$tag/", $item['tag_name'])){
				echo "found one it's $tag\n";
				$in_common["$tag"] = $item;
			}
						
		}
	}
	print_r($in_common);
	return $in_common;
	

}

function return_user($user){
	$new_user['id'] = $user[0];
	$new_user['Name'] = $user[1];
	$new_user['Reputation'] = $user[2];
	$new_user['WebsiteUrl'] = $user[3];
	$new_user['Location'] = $user[4];
	$new_user['AboutMe'] = $user[5];
	$new_user['Views'] = $user[6];
	$new_user['UpVotes'] = $user[7];
	$new_user['DownVotes'] = $user[8];
	$new_user['Age'] = $user[10];
	$new_user['profile'] = $user['profile'];
	$new_user['profile_address'] = "http://stackoverflow.com/users/".$new_user['id']."/".$new_user['Name'];
	return $new_user;

}

function get_top_ten($top_hundred)
{
	//we will rank the users based on their total score in the relevant tags on Stack Overflow
	$candidates = array();
	foreach($top_hundred as $candidate)
	{
		$net_tag_score = 0;
		$answer_score_sum = 0;
		$answer_count_sum = 0;
		$question_score_sum = 0;
		$question_count_sum = 0;
		foreach($candidate['relevant_tags'] as $tag_name=> $tag){
			print("tag info\n");
			print_r($tag);
			$answer_score_sum += $tag['answer_score'];
			$answer_count_sum += $tag['answer_count'];
			$question_score_sum += $tag['question_score'];
			$question_count_sum += $tag['question_count'];
		}	
		if(($answer_count_sum + $question_count_sum) != 0)
			$net_tag_score = ($answer_score_sum + $question_score_sum)/($answer_count_sum + $question_count_sum) + ($answer_count_sum + $question_count_sum); 
		else $net_tag_score;
		echo "score ".$net_tag_score."\n";
		$candidate['score'] = $net_tag_score;
		$candidates[$candidate['id']] = $candidate;
	}
	usort($candidates,"compare_scores");
	print_candidates_to_file($candidates);
	return $candidates;
}
function print_candidates_to_file($candidates)
{
	print("no of candidates = ".count($candidates));
	$outstream = fopen("output.csv","a+");
	$c = 1;
	foreach($candidates as $candidate){
		fputcsv($outstream, $candidate);
		if(++$c > 20)
			break;	
	}
	fclose($outstream);
}

function compare_scores($candidate1, $candidate2)
{
	if($candidate1['score'] == $candidate2['score'])
		return 0;
	return ($candidate1['score'] < $candidate2['score']) ? 1 : -1;
}
?>
