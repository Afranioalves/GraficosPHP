<?php require 'dados.php'; ?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Highcharts Example</title>

    <style type="text/css">
    /*Estilo Padrão, pode ser alterado*/
#container {
    margin-top:88px;
    height: 400px; 
}

.highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
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
button{
  height: 35px;
  width: 100px;
  border:none;
  font-size: 16px;
  cursor: pointer;
}
button#plain{
  background: teal;
  color:#fff;
}
button#inverted{
  background: tomato;
  color:#fff;
}
button#polar{
  background: #212121;
  color:#fff;
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
    <p class="highcharts-description">
      Escolha o método de visualização 
    </p>
<!--====Butões para alterar a previsualização do gráfico===-->
    <button id="plain">Plain</button>
    <button id="inverted">Inverted</button>
    <button id="polar">Polar</button>
</figure>




    <script type="text/javascript">
var chart = Highcharts.chart('container', {
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

    subtitle: {
        text: 'Plain'
    },
     //o Author do Gráfico
    credits:{
      enabled:false,
      text:'Por: Afrânio Alves',
      href:'http://github.com/Afranioalves',
      position:{
        align:'left',
        x:10
        
      },
      style:{
        fontSize:'15px',
        color:'red',
      }
    },
  
    xAxis: {
      /*Dados alterados Estaticamente de acordo com as informações
      da base de dados, podem ser feitas dinamicamente*/
        categories: ['PHP', 'HTML5 & CSS3', 'JavaScript', 'Flutter', 'React Native']
    },
    series: [{
      name:'Inscritos',
        type: 'column',
        colorByPoint: true,
        data: [
          /*Alterando os dados do gráfico de uma forma dinâmica
        essa estrutura de condição vai apresentar no gráfico o nome do curso
        e os inscritos, de acordo com os dados que estiver na
        base de dados
        */
          <?php while( $resultado = $busca->fetch()){?>
            ['<?=$resultado->Curso?>', <?=$resultado->Inscritos?> ],
         <?php } ?>
           
           
        ],
        showInLegend: false
    }]

});


$('#plain').click(function () {
    chart.update({
        chart: {
            inverted: false,
            polar: false
        },
        subtitle: {
            text: 'Plain'
        }
    });
});

$('#inverted').click(function () {
    chart.update({
        chart: {
            inverted: true,
            polar: false
        },
        subtitle: {
            text: 'Inverted'
        }
    });
});

$('#polar').click(function () {
    chart.update({
        chart: {
            inverted: false,
            polar: true
        },
        subtitle: {
            text: 'Polar'
        }
    });
});

    </script>
  </body>
</html>
