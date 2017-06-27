<?
include($_SERVER['DOCUMENT_ROOT']."/includes/site-settings.php");
$id = $_GET['id'];
$reviews_sql = mysql_query("SELECT * FROM reviews WHERE id = $id");
$reviews = array();
while($review = mysql_fetch_assoc($reviews_sql)) {
  $reviews[] = $review;
}
include('header.php');
?>
<h2 style='margin-bottom:10px; color:#<?=$email_hex?>'>Review Submission</h2>
There is a new review form submission the details are as follows:<br /><br />
<strong>Name :</strong> <?=$reviews[0]['name']?><br />
<strong>Email :</strong> <a style='color:#<?=$email_hex?>' href='mailto:<?=$reviews[0]['email']?>'><?=$reviews[0]['email']?></a><br />
<strong>Rating :</strong> <?=$reviews[0]['rating']?> Star(s)<br />
<strong>Review :<br /></strong> <pre style='<?=$pre_styles?>'><?=$reviews[0]['review']?></pre><br />
To approve this review log into your <a style='color:#<?=$email_hex?>' href='http://www.<?=$site_url?>/admin'>Command Centre</a>.<br /><br />
<?
include('footer.php');
