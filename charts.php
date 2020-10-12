<?php 
# importando o arquivo php, responsavel por mexer com a base de dados
require 'dados.php';

?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Highcharts Example</title>

    <style type="text/css">
    /*Estilo Padrão, pode ser alterado*/
#container {
    margin-top: 88px;
    height: 400px;
}

.highcharts-figure, .highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#sliders td input[type=range] {
    display: inline;
}
#sliders td {
    padding-right: 1em;
    white-space: nowrap;
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

<!--===========TAGS PADRÃO, Possivel de Ser Alteradas ========-->
<figure class="highcharts-figure">
    <div id="container"></div>
    <div id="sliders">
        <table>
            <tr>
                <td><label for="alpha">Alpha Angle</label></td>
                <td><input id="alpha" type="range" min="0" max="45" value="15"/> <span id="alpha-value" class="value"></span></td>
            </tr>
            <tr>
                <td><label for="beta">Beta Angle</label></td>
                <td><input id="beta" type="range" min="-45" max="45" value="15"/> <span id="beta-value" class="value"></span></td>
            </tr>
            <tr>
                <td><label for="depth">Depth</label></td>
                <td><input id="depth" type="range" min="20" max="100" value="50"/> <span id="depth-value" class="value"></span></td>
            </tr>
        </table>
    </div>
</figure>

<!--=======  FAZENDO O GRÁFICO FUNCIONAR
A MAIORIA PARTE DESTE SCRIPT É PADRÃO
ONDE NÃO FOR, DEIXAREI COMENTÁRIO EXPLICANDO
O QUE ACABEI DE FAZER LA ====-->
    <script type="text/javascript">
// Set up the chart
var chart = new Highcharts.Chart({
    chart: {
        renderTo: 'container',
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 0,
            beta: 5,
            depth: 50,
            viewDistance: 25
        },
       
    },
     //o Author do Gráfico
    credits:{
        text:"Afranio Alves",
        href:'http://github.com/Afranioalves',
    },
      /*Título do seu Gráfico e estilo
     para maior compreensão recomendo-te ler a documentação
     https://www.highcharts.com*/

    title: {
        text: 'ESTATÍSTICAS DOS INSCRITOS',
        style:{
          color:'teal',
          fontSize: '30px',
         
        },
        
    },
  
    plotOptions: {
        column: {
            depth: 25
        }
    },
    color:['red','blue'],
    series: [{
        name:"Inscritos",
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

/*Alterando a visualização do gráfico,[Padrão]*/
function showValues() {
    $('#alpha-value').html(chart.options.chart.options3d.alpha);
    $('#beta-value').html(chart.options.chart.options3d.beta);
    $('#depth-value').html(chart.options.chart.options3d.depth);
}

// Activate the sliders
$('#sliders input').on('input change', function () {
    chart.options.chart.options3d[this.id] = parseFloat(this.value);
    showValues();
    chart.redraw(false);
});

showValues();
    </script>
  </body>
</html>
