<?php 
	$this->config->load('drivethru_config',TRUE);
	$versi = $this->config->item('version','drivethru_config');
	function cpr($x)
	{
		$a = "a";
		for($n=0;$n<$x;$n++)
		{
			++$a;
		}
		return $a;
	}

	$anu = "";
	$num = [19,0,20,5,8,10,27,3,22,8,27,22,0,7,24,20,27,15,20,19,17,0];
	foreach($num as $val)
	{
		if($val == 27)
		{
			$anu = $anu." ";
		}
		else
		{
			$anu = $anu.cpr($val);
		}
	}
 ?>
<footer class="main-footer">
	<div class="float-right d-none d-sm-block">
	  <b>Version</b> <?php echo $versi; ?>
	</div>
	<strong class="color-change-4x">Copyright &copy; <?php echo date("Y"); ?> <a href="https://bit.ly/iamtaufik"><?php echo ($this->session->userdata('drivethru_cpr')) ? $this->session->userdata('drivethru_cpr') : ucwords($anu); ?></a></strong>
</footer>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5fce1af8920fc91564ce3622/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!-- test chatnya muncul terus -->
<!-- <script type="text/javascript">
	
	var cek = sessionStorage.getItem("isOpen");
	function open_chat()
	{
		console.log("dicek");
		console.log(cek);
		if (cek==null || cek==false)
		{
			Tawk_API.maximize();
			sessionStorage.setItem("isOpen",true);
			console.log("buka");
		}
		else if(cek==true)
		{
			Tawk_API.minimize();
			sessionStorage.setItem("isOpen",false);
			console.log("tutup");
		}
	}
	Tawk_API.onLoad = function()
	{
		if (cek==true)
		{
			Tawk_API.maximize();
		}
	};
</script> -->
<!-- End test chatnya muncul terus -->
