<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->


</head>
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
	<center style="width: 100%; background-color: #f1f1f1;">
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
    	<!-- BEGIN BODY -->
      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
		<tr>
			<td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
				<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td class="logo" style="text-align: left;">
						  <h1><a href="#"><?php echo $this->data = $website; ?></a></h1>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="middle" class="hero bg_white" style="padding: 2em 0 2em 0;">
				<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td style="padding: 0 2.5em; text-align: left;">
							<div class="text">
								<h4>Hello, <?php echo $this->data = $sender_name; ?></h4>
								<h4><?php echo $this->data = $sender_text; ?></h4>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="middle" class="hero bg_white" style="">
				<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
							<div class="text">
								<h3><?php echo $this->data = $amount; ?></h3>
								<span>PAYMENT DETAILS</span>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr style="padding: 2em 0 2em 0;">
			<table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td valign="middle" width="60%" style="text-align:left; padding: 1em 2.5em;">
						<span style="font-size: 12px;">Amount Paid</span>
					</td>
					<td valign="middle" width="40%" style="text-align:right; padding: 1em 2.5em;">
						<span class="price" style="color: #000; font-size: 12px;"><?php echo $this->data = $amount; ?></span>
					</td>
				</tr>				
				<tr>
					<td valign="middle" width="60%" style="text-align:left; padding: 1em 2.5em;">
						<span style="font-size: 12px;">Shipping Fee</span>
					</td>
					<td valign="middle" width="40%" style="text-align:right; padding: 1em 2.5em;">
						<span class="price" style="color: #000; font-size: 12px;"><?php echo $this->data = $shipping_fee; ?></span>
					</td>
				</tr>				
				<tr>
					<td valign="middle" width="60%" style="text-align:left; padding: 1em 2.5em;">
						<span style="font-size: 12px;">Quantity</span>
					</td>
					<td valign="middle" width="40%" style="text-align:right; padding: 1em 2.5em;">
						<span class="price" style="color: #000; font-size: 12px;"><?php echo $this->data = $quantity; ?></span>
					</td>
				</tr>								
				<tr>
					<td valign="middle" width="60%" style="text-align:left; padding: 1em 2.5em;">
						<span style="font-size: 12px;">Payment Method</span>
					</td>
					<td valign="middle" width="40%" style="text-align:right; padding: 1em 2.5em;">
						<span class="price" style="color: #000; font-size: 12px;"><?php echo $this->data = $method; ?></span>
					</td>
				</tr>				
				<tr>
					<td valign="middle" width="20%" style="text-align:left; padding: 1em 2.5em;">
						<span style="font-size: 12px;">Transaction ID</span>
					</td>
					<td valign="middle" width="80%" style="text-align:right; padding: 1em 2.5em;">
						<span class="price" style="color: #000; font-size: 12px;"><?php echo $this->data = $reference; ?></span>
					</td>
				</tr>				
				<tr>
					<td valign="middle" width="20%" style="text-align:left; padding: 1em 2.5em;">
						<span style="font-size: 12px;">Payment Reference</span>
					</td>
					<td valign="middle" width="80%" style="text-align:right; padding: 1em 2.5em;">
						<span class="price" style="color: #000; font-size: 12px;"><?php echo $this->data = $payment_link; ?></span>
					</td>
				</tr>
			</table>
		</tr>
      </table>
      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
      	<tr>
			<td valign="middle" class="bg_light footer email-section">
				<table>
					<tr>
						<td valign="top" width="100%" style="padding-top: 20px;">
						<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
							<tr>
							<td style="text-align: center; padding-right: 10px; font-size: 12px;">
								<p><?php echo date("h:i:A j, M Y", strtotime($this->data = $created)); ?></p>
							</td>
							</tr>
						</table>
						</td>
					</tr>					
					<tr>
						<td valign="top" width="100%" style="padding-top: 20px;">
						<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
							<tr>
							<td style="text-align: center; padding-right: 10px; font-size: 12px;">
								<p>If you have an account, please <a href="<?php echo e(route('user.dashboard')); ?>">head to your dashboard</a> to see more information on this payment</p>
							</td>
							</tr>
						</table>
						</td>
					</tr>					
					<tr>
						<td valign="top" width="100%" style="padding-top: 20px;">
						<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
							<tr>
							<td style="text-align: center; padding-right: 10px; font-size: 12px;">
								<p>Have questions or need help? Kindly respond to this email or visit our <a href="<?php echo e(route('faq')); ?>">FAQ</a> page</p>
							</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="middle" style="padding: 2em 0;">
			  <table>
				  	<tbody>
						<tr>
							<td>
								<div class="text" style="padding: 0 2.5em; text-align: center; font-size: 13px; color:#000">
									<p><?php echo e(date('Y')); ?> <?php echo $this->data = $website; ?></p>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr><!-- end: tr -->
      </table>

    </div>
  </center>
</body>
</html><?php /**PATH /home/cuminup/public_html/core/resources/views/emails/product/test.blade.php ENDPATH**/ ?>