<?php
	require_once "__conf__/__config.php";
	$isFromHomePage = 1;
?>

<?php
	$eventList = [
		[
			"city"	=>	"hcmc",
			"title"	=>	"Vietnamese International Flower Festival 2025",
			"date_from"	=>	"Feb 27, 2025",
			"date_to"	=>	"Mar 02, 2025",
			"time_from"	=>	"08:00",
			"time_to"	=>	"21:30",
			"location"	=>	"District 7",
			"ticket"	=>	"Free ticket",
			"description"	=>	"Flowers from all over the words...",
		],
		[
			"city"	=>	"hcmc",
			"title"	=>	"Charity Event from Singer My Tam",
			"date_from"	=>	"Feb 27, 2025",
			"date_to"	=>	"Mar 02, 2025",
			"time_from"	=>	"08:00 ",
			"time_to"	=>	"21:30",
			"location"	=>	"Nhà hát QK7",
			"ticket"	=>	"Free ticket",
			"description"	=>	"Very meaningful activity from singer My Tam and other famous artists...",
		],
		[
			"city"	=>	"hcmc",
			"title"	=>	"Charity Event from Singer Dan Truong",
			"date_from"	=>	"Feb 27, 2025",
			"date_to"	=>	"Mar 02, 2025",
			"time_from"	=>	"08:00 ",
			"time_to"	=>	"21:30",
			"location"	=>	"SVĐ Phú Thọ",
			"ticket"	=>	"Free ticket",
			"description"	=>	"Very meaningful activity from singer Dan Truong and other famous artists...",
		],
		[
			"city"	=>	"hanoi",
			"title"	=>	"Liveshow Khi người đàn hát của Tùng Dương",
			"date_from"	=>	"Feb 27, 2025",
			"date_to"	=>	"Mar 02, 2025",
			"time_from"	=>	"08:00 ",
			"time_to"	=>	"21:30",
			"location"	=>	"SVĐ Mỹ Đình",
			"ticket"	=>	"từ 500.000 vnđ",
			"description"	=>	"Giọng hát rất hay và tràn đầy nội lực cùng các bài hát rất ý nghĩa và hot của ca sĩ Tùng Dương",
		],
		[
			"city"	=>	"none",
			"title"	=>	"",
			"date_from"	=>	"",
			"date_to"	=>	"",
			"time_from"	=>	"",
			"time_to"	=>	"",
			"location"	=>	"",
			"ticket"	=>	"",
			"description"	=>	"",
		],
	];

	$citySelection = $_REQUEST['citySelection']?? 'none';
	$cities = [
		"hcmc"		=> "Hồ Chí Minh",
		"hanoi"		=> "Hà Nội",
		"danang"	=> "Đà Nẵng",
		"hue"		=> "Huế",
		"cantho"	=> "Cần Thơ",
		"haiphong"	=> "Hải Phòng",
		"none"	=> "-",
	];

	$cityName = $cities[$citySelection]?? "---";
	$eventsByCity = [];
	foreach ($eventList as $_ => $item) {
		if($item['city']==$citySelection){
			$eventsByCity[] = $item;
		}
	}
?>

<html>

<?php require_once "views/header-common.php"; ?>

<body class="container bg-white border">
	<header>
		<div class="mx-0 my-0 my-md-2 py-2 px-1 d-flex justify-content-start align-items-center">
			<img src="<?=wrap_file('images/ic_logo.png');?>" width="36" height="36" class="rounded float-left" />
			<div class="mx-2 my-auto">
				<div class="fs-large pointer"><b>Local Event Finder</b></div>
				<div class="">Never miss any events </div>
			</div>
		</div>
		<hr class="bg-light mt-0 shadow"/>
	</header>
	
	<h3>Event list</h3>

	<div class="container">
		<div>Events in <span class="city-name"><?=$cityName?></span> this week <span> <?=count($eventsByCity) ?></span>:</div>
		<div class="event-list">
<?php
	foreach ($eventList as $_ => $event) {
		if($event['city']!==$citySelection) continue;
		$dates = $event['date_from'] . ' - ' . $event['date_to'];
		$times = $event['time_from'] . ' - ' . $event['time_to'];
?>			
		<div class="container card my-3 py-2 bg-light" data-city="hcmc">
			<h5><?=$event['title']?></h5>
			<div class="m-1"><i class="fa fa-calendar" aria-hidden="true"></i> <span class="event-dates"><?=$dates?></span> </div>
			<div class="m-1"><i class="fa fa-hourglass" aria-hidden="true"></i> <span class="event-time"><?=$times?></span> </div>
			<div class="m-1"><i class="fa fa-location-arrow" aria-hidden="true"></i> <span class="event-location italic"><?=$event['location']?></span> </div>
			<div class="m-1"><i class="fa fa-ticket" aria-hidden="true"></i> <span class="event-ticket"><i><?=$event['ticket']?></i></span> </div>
			
			<div class="my-2"><span class="event-brief"><?=$event['description']?></span> </div>
		</div>	
<?php
	}
?>					
		</div>
	</div>

</body>

<?php require_once "views/footer.php"; ?>

</html>