		<!-- HEADER (START) -->
		<?php 
			$scannedtimezone = str_replace("_"," ",$_SESSION[WEBSITE_ALIAS]['timezone']);
			$scannedtimezone = str_replace("/"," - ",$scannedtimezone);
		?>
        <div class="header">
			<a href="<?php echo GIT_WEBSITE; ?>" class="company-logo" title="<?php echo WEBSITE_NAME ?>" ><img src="img/header-logo.png" alt="<?php echo WEBSITE_NAME ?>"></a>
			<div class="log-account-block">
				<table class="left height-auto user-logged-info" cellpadding="0" cellspacing="0">
					<tr>
						<td class="col1">Timezone:</td>
						<td class="col2"><?php echo strtoupper($scannedtimezone); ?></td>
					</tr>
					<tr>
						<td class="col1">System Date:</td>
						<td class="col2"><?php echo date($_SESSION[WEBSITE_ALIAS]['dateformat'].' - '.$_SESSION[WEBSITE_ALIAS]['timeformat'].'A'); ?></td>
					</tr>
					<tr>
						<td class="col1">Logged-in as:</td>
						<td class="col2"><?php echo $_SESSION[WEBSITE_ALIAS]['user_fullname']; ?></td>
					</tr>
				</table>
				<a href="<?php echo INDEX_PAGE?>logoff" class="log-off" title="LOGOFF">LOGOFF</a>
			</div>
    	</div>
        <!-- HEADER (END) -->