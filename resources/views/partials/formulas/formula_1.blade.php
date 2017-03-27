

{{-- <div class="col-sm-12">
	<ul>
		<li><b><i>ESA</i> = </b>Eficacia del Serivico/Actividades.</li>
		<li><b><i>SAR</i> = </b>Servicio/Actividades Realizadas.</li>
		<li><b><i>SAP</i> = </b>Servicio/Actividades Programadas.</li>
	</ul>
</div> --}}

<div class="text-center" >
	
	<i><b>Eficacia</b> = 
	<div class="fraction">
		<span class="fup">  Actividades Programadas  </span>
		<span class="bar">/</span>
		<span class="fdn">  Actividades Realizadas  </span>
	</div>
	x 100
	</i>
</div>

<style>
	.fraction {
		display: inline-block;
		vertical-align: middle; 
		margin: 0 0.2em 0.4ex;
		text-align: center;
	}

	.fraction > span {
	    display: block;
	    padding-top: 0.15em;
	}
	
	.fraction span.fdn {border-top: thin solid black;}
	.fraction span.bar {display: none;}
</style>
