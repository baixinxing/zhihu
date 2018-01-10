<?php

//require_once './curl/curl.php';
//$curl = new Curl;
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, "https://www.zhihu.com/api/v4/questions/26055737/answers?include=data[*].is_normal,admin_closed_comment,reward_info,is_collapsed,annotation_action,annotation_detail,collapse_reason,is_sticky,collapsed_by,suggest_edit,comment_count,can_comment,content,editable_content,voteup_count,reshipment_settings,comment_permission,created_time,updated_time,review_info,relevant_info,question,excerpt,relationship.is_authorized,is_author,voting,is_thanked,is_nothelp,upvoted_followees;data[*].mark_infos[*].url;data[*].author.follower_count,badge[?(type=best_answerer)].topics&limit=20&offset=0&sort_by=default");
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//$output = curl_exec($ch);
//die(var_dump($output));
//curl_close($ch);

$urls = [
    "https://www.zhihu.com/api/v4/questions/26055737/answers?include=data[*].is_normal,admin_closed_comment,reward_info,is_collapsed,annotation_action,annotation_detail,collapse_reason,is_sticky,collapsed_by,suggest_edit,comment_count,can_comment,content,editable_content,voteup_count,reshipment_settings,comment_permission,created_time,updated_time,review_info,relevant_info,question,excerpt,relationship.is_authorized,is_author,voting,is_thanked,is_nothelp,upvoted_followees;data[*].mark_infos[*].url;data[*].author.follower_count,badge[?(type=best_answerer)].topics&limit=20&offset=0&sort_by=default"
];

$mh = curl_multi_init();
foreach ($urls as $i => $url) {
    $conn[$i] = curl_init($url);
    curl_setopt($conn[$i], CURLOPT_HTTPHEADER, array('authorization: oauth c3cef7c66a1843f8b3a9e6a1e3160e20'));
    curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($conn[$i], CURLOPT_SSL_VERIFYPEER, false);
    curl_multi_add_handle($mh, $conn[$i]);
} // 初始化   

do {
    curl_multi_exec($mh, $active);
} while ($active);

$data = [];
foreach ($urls as $i => $url) {
    $res[$i] = curl_multi_getcontent($conn[$i]);
    $data[] = rule($res[$i]);
    curl_multi_remove_handle($mh, $conn[$i]);
    curl_close($conn[$i]);
}

print_r($res);
curl_multi_close($mh);

//赞同数≥200
//文字为空的过滤
function rule($data) {
    
}

?>