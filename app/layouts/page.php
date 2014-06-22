<!doctype html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/css/nav.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1>TechDocs <small>>> A simple flexible documentation system</small></h1>
			<ul class="nav nav-pills">
				<?php foreach ($nav as $navitem => $url): ?>
					<li><a href="<?php echo $url ?>"><?php echo $navitem ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-3">
				<ul class="nav">
				<li><a class="active" href="#">Part 1</a>
					<ul class="nav">
						<li><a href="#">Part 1.1</a></li>
						<li><a href="#">Part 1.2</a>
							<ul class="nav">
								<li><a href="#">Part 1.2.1</a></li>
								<li><a href="#">Part 1.2.2</a></li>
								<li><a href="#">Part 1.2.3</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li><a href="#">Part 2</a></li>
				<li><a href="#">Part 3</a></li>
				</ul>
			</div>
			<div class="col-md-9">
				<?php echo $this['file']; ?>
			</div>
		</div>
	</div>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</body>
</html>
