<?php
	require_once "__conf__/__config.php";
?>
<html>

<?php require_once "views/header-common.php"; ?>

<body class="container bg-white border">
	<header>
		<div class="mx-0 my-0 my-md-2 py-2 px-1 d-flex justify-content-start align-items-center">
			<img src="<?=wrap_file('images/ic_logo.png')?>" width="36" height="36" class="rounded float-left" />
			<div class="mx-2 my-auto">
				<div class="fs-large pointer"><b>Local Event Finder</b></div>
				<div class="">Never miss any events </div>
			</div>			
		</div>
		<hr class="bg-light mt-0 shadow"/>
	</header>

	<section class="container text-center h-75 align-content-center">
		<form actions="" method="post">
			<div class="form-group">
				<label for="citySelection">Select a city</label>
				<select name="citySelection" id="citySelection" class="form-control">			
					<option value="hcmc">Hồ Chí Minh</option>
					<option value="hanoi">Hà Nội</option>
					<option value="danang">Đà Nẵng</option>
					<option value="hue">Huế</option>
					<option value="cantho">Cần Thơ</option>
					<option value="haiphong">Hải Phòng</option>
				</select>
				<button type="button" id="btn_search" name="search" class="btn btn-primary my-2">
					<i class="fa fa-search" aria-hidden="true"></i> Search
				</button>
			</div>
		</form>
		<script>
			$(function(){
				$('#btn_search').on('click', (event)=>{
					window.location = `events-by-city/${citySelection.value}`
				})
			})
		</script>
	</section>

</body>

<?php require_once "views/footer.php"; ?>

</html>