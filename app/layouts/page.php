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
			<h1><?php echo $config->get('name'); ?> <small>>> <?php echo $config->get('description'); ?></small></h1>
			<ul class="nav nav-pills">
				<?php foreach ($nav as $navitem => $url): ?>
					<li><a href="<?php echo $url ?>"><?php echo ucfirst($navitem) ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="row">
			<?php if ($dir): ?>
				<div class="col-md-3">
					<ul class="nav">
						<li><a href="../"><i class="glyphicon glyphicon-folder-open"></i> Up a level</a></li>
						<?php foreach ($dir as $type => $left_nav) : ?>
							<?php foreach($left_nav as $navitem): ?>
								<li>
									<?php if ($type == "folders") : ?>
										<a href="<?php echo $navitem . '/index'; ?>"><i class="glyphicon glyphicon-folder-open"></i> <?php echo $navitem; ?></a>
									<?php else : ?>
										<a href="<?php echo $navitem; ?>"><?php echo $navitem; ?></a>
									<?php endif ?>
								</li>
							<?php endforeach; ?>
						<?php endforeach ?>
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
