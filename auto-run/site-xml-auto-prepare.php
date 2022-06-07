<?php

//once in a day 
require_once '../database/db-con.php';

$site_xml_string = "";

$sitemap_url_start_tag = "\t<url>\n";
$sitemap_url_end_tag = "\t</url>\n";
$sitemap_loc_start_tag = "\t\t<loc>";
$sitemap_loc_end_tag = "</loc>\n";
$sitemap_lastmod_start_tag = "\t\t<lastmod>";
$sitemap_lastmod_end_tag = "</lastmod>\n";
$sitemap_changefreq_start_tag = "\t\t<changefreq>";
$sitemap_changefreq_end_tag = "</changefreq>\n";
$sitemap_priority_start_tag = "\t\t<priority>";
$sitemap_priority_end_tag = "</priority>\n";


//adding initialization
$site_xml_string .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

//adding first url set
$site_xml_string .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"  xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";

//main pages urls
$site_xml_string .= $sitemap_url_start_tag;
$site_xml_string .= $sitemap_loc_start_tag;
$site_xml_string .= "https://navisavar.com/";
$site_xml_string .= $sitemap_loc_end_tag;
$site_xml_string .= $sitemap_lastmod_start_tag;
$site_xml_string .= date('Y-m-d');
$site_xml_string .= $sitemap_lastmod_end_tag;
$site_xml_string .= $sitemap_changefreq_start_tag;
$site_xml_string .= "daily";
$site_xml_string .= $sitemap_changefreq_end_tag;
$site_xml_string .= $sitemap_priority_start_tag;
$site_xml_string .= "1.0";
$site_xml_string .= $sitemap_priority_end_tag;
$site_xml_string .= $sitemap_url_end_tag;


//first index pages
$site_xml_string .= $sitemap_url_start_tag;
$site_xml_string .= $sitemap_loc_start_tag;
$site_xml_string .= "https://navisavar.com/";
$site_xml_string .= $sitemap_loc_end_tag;
$site_xml_string .= $sitemap_lastmod_start_tag;
$site_xml_string .= date('Y-m-d');
$site_xml_string .= $sitemap_lastmod_end_tag;
$site_xml_string .= $sitemap_changefreq_start_tag;
$site_xml_string .= "daily";
$site_xml_string .= $sitemap_changefreq_end_tag;
$site_xml_string .= $sitemap_priority_start_tag;
$site_xml_string .= "1.0";
$site_xml_string .= $sitemap_priority_end_tag;
$site_xml_string .= $sitemap_url_end_tag;





//here we are going to add all business pages 
$sql = "SELECT * FROM blog WHERE `is_deleted` = 0 ORDER BY `publish_date` DESC";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $site_xml_string .= $sitemap_url_start_tag;
        $site_xml_string .= $sitemap_loc_start_tag;
        $site_xml_string .= "https://navisavar.com/blog/".$row['unique_link'];
        $site_xml_string .= $sitemap_loc_end_tag;
        $site_xml_string .= $sitemap_lastmod_start_tag;
        $site_xml_string .= date('Y-m-d');
        $site_xml_string .= $sitemap_lastmod_end_tag;
        $site_xml_string .= $sitemap_changefreq_start_tag;
        $site_xml_string .= "daily";
        $site_xml_string .= $sitemap_changefreq_end_tag;
        $site_xml_string .= $sitemap_priority_start_tag;
        $site_xml_string .= "1.0";
        $site_xml_string .= $sitemap_priority_end_tag;
        $site_xml_string .= $sitemap_url_end_tag;
    }
}


//here we are going to add all category pages
//category
$query = "SELECT * FROM `category_list` WHERE `is_deleted` = 0";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $site_xml_string .= $sitemap_url_start_tag;
        $site_xml_string .= $sitemap_loc_start_tag;
        $site_xml_string .= "https://navisavar.com/category/".$row['unique_link'];
        $site_xml_string .= $sitemap_loc_end_tag;
        $site_xml_string .= $sitemap_lastmod_start_tag;
        $site_xml_string .= date('Y-m-d');
        $site_xml_string .= $sitemap_lastmod_end_tag;
        $site_xml_string .= $sitemap_changefreq_start_tag;
        $site_xml_string .= "daily";
        $site_xml_string .= $sitemap_changefreq_end_tag;
        $site_xml_string .= $sitemap_priority_start_tag;
        $site_xml_string .= "1.0";
        $site_xml_string .= $sitemap_priority_end_tag;
        $site_xml_string .= $sitemap_url_end_tag;
    }
}












//end of the urlset
$site_xml_string .= '</urlset>';
// echo $site_xml_string;

if (file_exists('../sitemap.xml')) {
unlink('../sitemap.xml');
}
$fp = fopen('../sitemap.xml', 'a');//live opens file in append mode 


// if (file_exists('../sitemap.xml')) {
//     unlink('../sitemap.xml');
//     }
// unlink('sitemap.xml');
// $fp = fopen('sitemap.xml', 'a');//local opens file in append mode   

fwrite($fp,$site_xml_string);  
fclose($fp);
?>