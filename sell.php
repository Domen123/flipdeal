<?php include("header1.php");
if(isset($_SESSION['utype']))
{
if($_SESSION['utype']=="courier")
{
	header("location:courier.php");
}}
?>

<script>
function sub()
{
	var x=document.f.t.value;
	alert(x);
	location.href="addtocart.php?t="+x;
}
</script>
<span id="bigbucket">
<?php
include("dbconnect.php");
$rec=mysqli_query($con,"select count(*) from offer");
$of1=mysqli_query($con,"select * from offer");
$prd=mysqli_query($con,"select * from product order by ptdid desc;");
	$rec1=mysqli_fetch_array($rec);
	//echo $rec1[0];
	echo "<form name='f'>";
for($i=0;$i<=($rec1[0]-1);$i++)
{ 
$of=mysqli_fetch_array($of1);
$prd=mysqli_query($con,"select * from product where ptdid=$of[1]");
$prd1=mysqli_fetch_array($prd);
$dd1=mysqli_query($con,"select * from offer where pdtid=$prd1[0]");
$ds=mysqli_fetch_array($dd1);
$a=time();
$da1=date("Y-m-d",$a);
$da3=date_create($da1);
$da2=date("Y-m-d",$ds[4]);
$da4=date_create($da2);
$df=date_diff($da4,$da3);
$s=$df->format("%a");
$pic=$prd1[8];
//echo "<br>".$prd1[0]."-".$s."<br>";
if($ds[3]>$s)
	{
echo "<div class='bucket'>";
$dv2=date("Y-m-d",$prd1[9]);
$dv3=date_create($dv2);
$df1=date_diff($da3,$dv3);
$n=$df1->format("%a");
echo "<div class='notf'>";
if($n<7)
{
echo "<div class='new'>new</div>";
}
if($ds[2]!=NULL)
{
	if($ds[3]>$s)
	{
echo "<div class='dis'>$ds[2]%</div>";
	}
}
echo "</div><a href='productinfo.php?t1=$prd1[0]'>";
echo "<img width='130' height='130' src='.\\productlogo\\$pic'>";
echo "</br>";
echo $prd1[3];
echo "</a>";
echo "</br>";
if($ds[2]!=NULL)
{ if($s<$ds[3])
{ 
$dp=$prd1[4]-($prd1[4]*$ds[2]/100);
echo "<strike>$prd1[4]</strike>&nbsp;<b>$dp</b>";
}else
{
	echo "<b>".$prd1[4]."</b>";
}

}
else
{
	echo "<b>".$prd1[4]."</b>";
}
echo "</br>";
echo $prd1[7];
echo "<br>";
echo "<a href='directbuy.php?t=$prd1[0]' ><input type='button' name='buy' value='BUY'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type='hidden' name='t' value='$prd1[0]'>";
echo "<a href='addtocart.php?t=$prd1[0]'><input type='button' name='addtocart' value='ADD TO CART' ></a>";
echo "</div>";
}
echo "</form>";
}
include("footer.php");
?>
</span>
