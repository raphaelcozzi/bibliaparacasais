<?php
class GCM {
                function __construct(){}

                public function send_notification($registatoin_ids,$data) {

                   $google_api_key = "AIzaSyBnHTGrfm1IcYrNTGcNxrbyE5IgjXhabK8"; // <-- Insert your Google API Key

                    $url = 'https://fcm.googleapis.com/fcm/send';
                    $fields = array(
                        'registration_ids' => $registatoin_ids,
                        'notification' => array('title' => $data['title'],
                            'body' => $data['description'],
                            'click_action' => "OPEN_MAIN_1",
                            'icon' => 'ic_launcher'),
                        'data' => array('link' => $data['link'])
                    );

                    $headers = array(
                        'Authorization:key =' . $google_api_key,
                        'Content-Type: application/json'
                    );
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    $result = curl_exec($ch);
                    if($result===FALSE){
                        die("Curl failed: ".curl_error($ch));
                    }
                    curl_close($ch);
                }
            }
            
            ?>