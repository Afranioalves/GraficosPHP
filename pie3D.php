<?php 
# importando o arquivo php, responsavel por mexer com a base de dados
require 'dados.php';

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Estatísticas</title>

    <style type="text/css">
/*Estilo Padrão, pode ser alterado*/
#container {
  margin-top:64px;
  height: 500px;
  padding-top:64px;
  
}

.highcharts-figure, .highcharts-data-table table {
  min-width: 310px; 
  max-width: 800px;
  margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #EBEBEB;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}
.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}
.highcharts-data-table th {
  font-weight: 600;
  padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
  padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}
.highcharts-data-table tr:hover {
  background: #f1f7ff;
}

		</style>
	</head>
	<body>
<!-- ======= BIBLIOTECAS IMPORTANTES ======= -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>



<!--===========TAGS PADRÃO ========-->
<figure class="highcharts-figure">
    <div id="container"></div>
</figure>


<!--=======  FAZENDO O GRÁFICO FUNCIONAR
A MAIORIA PARTE DESTE SCRIPT É PADRÃO
ONDE NÃO FOR, DEIXAREI COMENTÁRIO EXPLICANDO
O QUE ACABEI DE FAZER LA ====-->

		<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
     /*Título do seu Gráfico e estilo
     para maior compreensão recomendo-te ler a documentação
     https://www.highcharts.com*/

    title: {
      //Alterei o Titulo e o Estilo do titulo
        text: 'ESTATÍSTICAS DOS INSCRITOS',
        style:{
          color:'teal',
          fontSize: '30px',
         
        },
        
    },
   
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    //o Author do Gráfico
    credits:{
      text:'Por: Afrânio Alves',
      href:'http://github.com/Afranioalves',
      position:{
        align:'left',
        x:10
        
      },

    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Alunos',
        data: [
        /*Alterando os dados do gráfico de uma forma dinâmica
        essa estrutura de condição vai apresentar no gráfico o nome do curso
        e os inscritos, de acordo com os dados que estiver na
        base de dados
        */
          <?php while( $resultado = $busca->fetch()){?>
            ['<?=$resultado->Curso?>', <?=$resultado->Inscritos?> ],
         <?php } ?>
           
           
        ]
    }]
});
		</script>
	</body>
</html>
