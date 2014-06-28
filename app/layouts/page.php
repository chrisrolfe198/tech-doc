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
					<li><a href="<?php echo $url ?>"><?php echo ucfirst($navitem) ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="row">
			<?php if ($left_nav): ?>
				<div class="col-md-3">
					<ul class="nav">
						<?php foreach($left_nav as $navitem): ?>
							<?php if (substr($navitem, -3) == '.md'): ?>
								<li><a href="<?php echo substr($navitem, 0, -3); ?>"><?php echo substr($navitem, 0, -3); ?></a></li>
							<?php else: ?>
								<li><a href="<?php echo $navitem.'/index'; ?>"><?php echo $navitem; ?></a></li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="col-md-9">
			<?php else: ?>
				<div class="col-md-12">
			<?php endif; ?>
				<?php echo $this['file']; ?>
			</div>
		</div>
	</div>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</body>
</html>
