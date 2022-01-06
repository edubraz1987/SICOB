function mudaCorlink1()
	{
		document.getElementById('link1').className = 'linksmenuativo';
		document.getElementById('link2').className = 'linksmenu';
		document.getElementById('link3').className = 'linksmenu';
		document.getElementById('link4').className = 'linksmenu';				
		document.getElementById('link5').className = 'linksmenu';				
	}
function mudaCorlink2()
	{
		document.getElementById('link2').className = 'linksmenuativo';
		document.getElementById('link1').className = 'linksmenu';
		document.getElementById('link3').className = 'linksmenu';
		document.getElementById('link4').className = 'linksmenu';
		document.getElementById('link5').className = 'linksmenu';
	}
function mudaCorlink3()
	{
		document.getElementById('link3').className = 'linksmenuativo';
		document.getElementById('link2').className = 'linksmenu';
		document.getElementById('link1').className = 'linksmenu';
		document.getElementById('link4').className = 'linksmenu';		
		document.getElementById('link5').className = 'linksmenu';		
	}
function mudaCorlink4()
	{
		document.getElementById('link4').className = 'linksmenuativo';
		document.getElementById('link2').className = 'linksmenu';
		document.getElementById('link5').className = 'linksmenu';
		document.getElementById('link3').className = 'linksmenu';
		document.getElementById('link1').className = 'linksmenu';
	}
function mudaCorlink5()
	{
		document.getElementById('link5').className = 'linksmenuativo';
		document.getElementById('link2').className = 'linksmenu';
		document.getElementById('link4').className = 'linksmenu';
		document.getElementById('link3').className = 'linksmenu';
		document.getElementById('link1').className = 'linksmenu';
	}

function mudaCorSublink1()
	{
		document.getElementById('sublink1').className = 'linksmenuativo';
		document.getElementById('sublink2').className = 'linksmenu';
		document.getElementById('sublink3').className = 'linksmenu';
		document.getElementById('sublink4').className = 'linksmenu';				
	}
function mudaCorSublink2()
	{
		document.getElementById('sublink2').className = 'linksmenuativo';
		document.getElementById('sublink1').className = 'linksmenu';
		document.getElementById('sublink3').className = 'linksmenu';
		document.getElementById('sublink4').className = 'linksmenu';
	}
function mudaCorSublink3()
	{
		document.getElementById('sublink3').className = 'linksmenuativo';
		document.getElementById('sublink2').className = 'linksmenu';
		document.getElementById('sublink1').className = 'linksmenu';
		document.getElementById('sublink4').className = 'linksmenu';		
	}
function mudaCorSublink4()
	{
		document.getElementById('sublink4').className = 'linksmenuativo';
		document.getElementById('sublink2').className = 'linksmenu';
		document.getElementById('sublink3').className = 'linksmenu';
		document.getElementById('sublink1').className = 'linksmenu';
	}

function deslogar()
	{
		var login = 0;
		location.href='../control/terminar_sessao.php';
	}

function goBack(){
		window.history.back()
	}	
		
function abrirConvenio()
	{
		document.getElementById('fra_principal').src = 'calendario/calendar_convenio.php';
	}
		
function abrirFinanceiro()
	{
		document.getElementById('fra_principal').src = 'calendario/calendar_financeiro.php';
	}
		
function abrirHupe()
	{
		document.getElementById('fra_principal').src = 'calendario/calendar_hupe.php';
	}
		
function abrirCepuerj()
	{
		document.getElementById('fra_principal').src = 'calendario/calendar_cepuerj.php';
	}

function login()
	{
		document.getElementById('fra_principal').src = 'index2.php';
	}
	
function abrirCadConv(login)
	{
		if (login == '1') {
			document.getElementById('fra_principal').src = 'convenio.php';
		}
		else{
			alert("Não permitido!");
			location.href='index2.php';		
		}
		
	}	
function abrirCadFin(login)
	{
		if (login == '1') {
			document.getElementById('fra_principal').src = 'financeiro.php';
		}
		else{
			alert("Não permitido!");
			location.href='index2.php';		
		}
		
	}
function abrirCadHupe(login)
	{
		if (login == '1') {
			document.getElementById('fra_principal').src = 'hupe.php';
		}
		else{
			alert("Não permitido!");
			location.href='index2.php';		
		}
		
	}
	
function abrirCadCepu(login)
	{
		if (login == '1') {
			document.getElementById('fra_principal').src = 'cepuerj.php';
		}
		else{
			alert("Não permitido!");
			location.href='index2.php';		
		}
		
	}	
