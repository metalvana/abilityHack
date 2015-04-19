<?php
require_once 'facepp_sdk.php';
########################
###     example      ###
########################
$facepp = new Facepp();
$faceapp->api_key       = 'b0acda39f8deeb1677384a9fdb9d1356';
$faceapp->api_secret    = 'Cp190ucDfC2IPgTDWgTRc4sqbgNDhrr1';
    
#detect local image 
    #$params['img']          = '{image file path}';
$params['attribute']    = 'gender,age,race,smiling,glass,pose';

    #$response               = $facepp->execute('/detection/detect',$params);
    #print_r($response);

#detect image by url

    //$params['url']          = 'http://www.faceplusplus.com.cn/wp-content/themes/faceplusplus/assets/img/demo/1.jpg';
    //$params['url']          = 'http://politic365.com/wp-content/blogs.dir/1/files/2011/11/Obama-sad-face.jpg';
    $params['url']          = 'http://theselfemployed.com/wp-content/uploads/2013/01/alg-laughing-jpg.jpg';

$response               = $facepp->execute('/detection/detect',$params);
    

print_r($response);
    echo ('<br/>');
    echo('starts here: ');
    echo ('<br/>');
    
//detect json, update result
    $result = '';
    $data = json_decode($response['body'], 1);
    
    foreach($data['face'] as $face){
        $attr = $face['attribute'];
        //gender
        $gender = $attr['gender']['value'];
        $gHead = '';
        if($gender == 'Male') $gHead = "He ";
        else $gHead = "She ";
        $gMid = '';
        if($gender == 'Male') $gMid = "him ";
        else $gMid = "her ";
        //age
        $age = $attr['age']['value'];
        if((int)$age > 30){
            $result = $result . $gHead . "appears to be mature and wise. ";
        }
        else{
            $result = $result . $gHead . "appears to be young and energetic. ";
        }
        //glass
        $glass = $attr['glass']['value'];
        if($glass == 'None'){
            $result = $result . $gHead . "does not wear glasses, which gives " . $gMid . "an atheletic feeling. ";
        }
        else{
            $result = $result . $gHead . "wears a pair of glasses, which gives " . $gMid . "a feeling of being quiet and attractive. ";
        }
        //smiling
        $smile = $attr['smiling']['value'];
        if((double)$smile > 10){
            $result = $result . $gHead . "has a great smile in the picture. The smile is bright and attractive. ";
        }
        else if((double)$smile > 2){
            $result = $result . $gHead . "has a cool look in the picture. The slight smile makes " . $gMid . " mysterious. ";
        }
        else{
            $result = $result . $gHead . "is not very happy in the picture. ";
            $result = $result . $gHead . "will be more attractive when smiling. ";
        }
        
    }
    
    echo ('<br/>');
    echo($result);
    
    /*
    foreach ( $response['body'] as $item ){
        echo $item;
        echo ('<br/>');
    }*/

/*if($response['http_code'] == 200) {
    #json decode 
    $data = json_decode($response['body'], 1);
    
    #get face landmark
    foreach ($data['face'] as $face) {
        $response = $facepp->execute('/detection/', array('face_id' => $face['face_id']));
        print_r($response);
    }
    
    #create person 
    $response = $facepp->execute('/person/create', array('person_name' => 'unique_person_name'));
    print_r($response);

    #delete person
    $response = $facepp->execute('/person/delete', array('person_name' => 'unique_person_name'));
    print_r($response);

}*/

