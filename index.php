<?php 
  // this simple dom parser library aloows
  // you to deal with the responses you get 
  // by curl like you deal with jquery 
  include "simple_html_dom.php";

  // curl call handler, that you
  // should create options for every 
  // time 
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,  "https://www.google.us/search?q=adolf");
  // if you are using the wrong domain 
  // ( it will follow location 
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  // execute and close the curl requset 
  $response = curl_exec($ch);
  curl_close($ch);

  // parsing the response into the something
  // that we can actually interact with 
  // like jquery interacts with the dom
  $html = new simple_html_dom();
  $html->load($response);

  foreach($html->find('a[href^=/url?]') as $link) {
    if (strpos($link->href, "webcache.google") == false) {
      echo $link->plaintext;
      echo "<br>";
    }
  }

?>