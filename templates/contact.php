<?
include($_SERVER['DOCUMENT_ROOT']."/includes/site-settings.php");
$id = $_GET['id'];
$contacts_sql = mysql_query("SELECT * FROM form_contact WHERE id = $id");
$contacts = array();
while($contact = mysql_fetch_assoc($contacts_sql)) {
  $contacts[] = $contact;
}
include('header.php');
?>
<h2 style='margin-bottom:10px; color:#<?=$email_hex?>'>General Inquiry</h2>
Thank you for sending us your inquiry. A member of our staff will contact you shortly. The details of your submission are as follows:<br /><br />
<strong>Name :</strong> <?=$contacts[0]['name']?><br />
<strong>Email :</strong> <a style='color:#<?=$email_hex?>' href='mailto:<?=$contacts[0]['email']?>'><?=$contacts[0]['email']?></a><br />
<strong>Subject :</strong> <?=$contacts[0]['subject']?><br />
<?
if($contacts[0]['service'] != '') {
  ?>
  <strong>Service :</strong> <?=$contacts[0]['service']?><br />
  <?
}
?>
<strong>Message :<br /></strong> <pre style='<?=$pre_styles?>'><?=$contacts[0]['message']?></pre><br />
Thanks again,<br />
<?=$company_name?><br /><br />
<?
include('footer.php');
