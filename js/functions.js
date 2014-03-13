$(document).ready(function() {

	// When user clicks on one of the tags below the associated code is executed

		// Change the download tabs
		$("#drag2install").click(function() {
			$("#install_emc").removeClass('active');
			$("#updatesite").removeClass('active');
			$(this).addClass("active");

			$("#content_drag2install").fadeIn(700);
			$("#content_emc").hide();
			$("#content_updatesite").hide();

			return false;
		});

		$("#eclipse_drag2install").click(function() {
			$("#eclipse_install_emc").removeClass('active');
			$("#eclipse_updatesite").removeClass('active');
			$(this).addClass("active");

			$("#content_drag2install_1").fadeIn(700);
			$("#content_emc_1").hide();
			$("#content_updatesite_1").hide();

			return false;
		});

		$("#install_emc").click(function() {
			$("#drag2install").removeClass('active');
			$("#updatesite").removeClass('active');
			$(this).addClass("active");

			$("#content_emc").fadeIn(700);
			$("#content_drag2install").hide();
			$("#content_updatesite").hide();
			
			return false;

		});

		$("#eclipse_install_emc").click(function() {
			$("#eclipse_drag2install").removeClass('active');
			$("#eclipse_updatesite").removeClass('active');
			$(this).addClass("active");

			$("#content_emc_1").fadeIn(700);
			$("#content_drag2install_1").hide();
			$("#content_updatesite_1").hide();

		});

		$("#updatesite").click(function() {
			$("#drag2install").removeClass('active');
			$("#install_emc").removeClass('active');
			$(this).addClass("active");

			$("#content_updatesite").fadeIn(700);
			$("#content_drag2install").hide();
			$("#content_emc").hide();

		});

		$("#eclipse_updatesite").click(function() {
			$("#eclipse_drag2install").removeClass('active');
			$("#eclipse_install_emc").removeClass('active');
			$(this).addClass("active");

			$("#content_updatesite_1").fadeIn(700);
			$("#content_drag2install_1").hide();
			$("#content_emc_1").hide();

		});

		// Display current year
		$("#year").text( (new Date).getFullYear() );
	});

function drag2InstallTooltip() {
	$('.drag2install_tooltip').css('display', 'block');

	return false;
}

function drag2InstallTooltip_out() {
	$('.drag2install_tooltip').css('display', 'none');

	return false;
}


