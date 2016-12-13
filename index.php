<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Staff Directory | Enterm Exam</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<script type="text/javascript">
    function clearHidden()
    {
        document.getElementById("staffId").value="";
    }
    function postForm(id)
    {
        document.getElementById("staffId").value=id;
        document.getElementById("form1").submit();
    }
</script>

<?php
require 'dbMethods.php';
$dbm=new dbMethods();
$departments=$dbm->getDepartments();
$chosenDep="SMSIT";
$chosenStaffId;
$chosenStaffDetails;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['dep']))
    {
        $chosenDep=$_POST['dep'];
    }
    if(isset($_POST['staffId'])&&$_POST['staffId']!="")
    {
        $chosenStaffId=$_POST['staffId'];
        $chosenStaffDetails=$dbm->getStaffById($chosenStaffId);
    }
}
$staffs=$dbm->getStaffByDepartment($chosenDep);
?>
<fieldset>
    <legend>Please, Select a department.</legend>

<form id="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <select name="dep">
        <?php foreach($departments as $department)
        {
            ?><option value="<?php echo($department['department'])?>"
            <?php if($department['department']==$chosenDep){?> selected<?php }?>>
            <?php echo($department['department'])?>
            </option>
            <?php
        }
        ?>
    </select>
    <input type="hidden" name="staffId" id="staffId" value="" />
    <input class="submit" type="submit" name="search" value="Search" onclick="clearHidden()" />
</form>
</fieldset>

<fieldset><legend>Staff directory for <em><?php echo($chosenDep)?></em>  Department</legend>

<ol>
    <?php foreach($staffs as $staff)
    {
        ?><li><a href="#" onclick="postForm(<?php echo($staff['id'])?>)">
            <?php echo($staff['lname'])?>, <?php echo($staff['fname'])?></a></li>
        <?php
    }
    ?>
</ol>
</fieldset>
<?php if(isset($chosenStaffId)&&isset($chosenStaffDetails))
{
    ?>
    <fieldset><legend>
            Staff Details
        </legend>
    <span><strong>Name :</strong> <?php echo($chosenStaffDetails['lname'].", ".$chosenStaffDetails['fname'])?></span>
        <span><strong>Email : </strong><?php echo($chosenStaffDetails['email'])?></span>
        <span><strong> Department : </strong><?php echo($chosenStaffDetails['department'])?></span>
    <span><strong>Profile : </strong><?php echo($chosenStaffDetails['profile'])?></span>
    <?php
}
?>
    </fieldset>
</body>
</html>
