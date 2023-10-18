<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>

<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
	// echo $this->Html->meta('icon');
	// echo $this->Html->css('cake.generic');
	echo $this->Html->css('users');
	echo $this->Html->css('messages');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
	<div id="container">
		<!-- <div id="header" class="py-3 bg-light">
			<div class="container">
				<div class="row">
					<div class="col-3">
						<h1>Message Board</h1>
					</div>
					<div class="col-9">
						<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
						<a class="nav-link" href="#">Features</a>
						<a class="nav-link" href="#">Pricing</a>
					</div>
				</div>

			</div>

		</div> -->
		<nav class="navbar bg-body-tertiary py-3">
			<div class="container">
				<?php
				if ($this->Session->check('Auth.User')) {
					$current_user = $this->Session->read('Auth.User');
					echo $this->Html->link('MessageBoard', array('controller' => 'users', 'action' => 'profile'), ['class' => 'navbar-brand text-decoration-none px-3']);
				} else {
					echo $this->Html->link('MessageBoard', array('controller' => 'users', 'action' => 'login'), ['class' => 'navbar-brand text-decoration-none px-3']);
				}
				?>
				<div class="d-flex">
					<!-- <a class="nav-link px-3" href="#">Home</span></a> -->




					<?php
					if ($this->Session->check('Auth.User')) :
						// echo $current_user['name'] ?? $current_user['User']['name'];
						$user_icon = '<i class="fa-regular fa-user px-1"></i>';
						echo $this->Html->link($current_user['name'] ?? $user_icon . $current_user['User']['name'], array('controller' => 'Users', 'action' => 'profile'), ['class' => 'text-decoration-none px-3', 'escape' => false]);
						echo $this->Html->link('Logout', array('controller' => 'Users', 'action' => 'logout'), ['class' => 'px-3']);
					else :
						echo $this->Html->link('Login', array('controller' => 'Users', 'action' => 'login'), ['class' => 'px-3']);
						echo $this->Html->link('Register', array('controller' => 'Users', 'action' => 'register'), ['class' => 'px-3']);
					?>
					<?php endif; ?>


				</div>
			</div>
		</nav>
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer" class="mt-5 py-3 bg-light">
			<div class="container">

				<p>
					FDCI - MessageBoard - <?php echo $cakeVersion; ?>
				</p>
			</div>

		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>


</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?= $this->Html->script('users/register.js'); ?>
<?= $this->Html->script('users/login.js'); ?>
<?= $this->Html->script('users/edit.js'); ?>
<?= $this->Html->script('users/messages.js'); ?>

</html>