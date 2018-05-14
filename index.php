<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <style>
        .circulo {
            display: inline-block;
            
            border: 1px solid #000000;
            background-color: #FFFF00;
          }    
        </style>
    </head>
    <body>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="chart_div"></div>
        <?php 
        
        $cont = 0;
        while ($cont < 15){
            $cont++;
            
            //SELECIONA O NÓ PAI ALEATORIAMENTE===================================================================
            if($cont > 1){
                $no_selecionado = (rand(1 , sizeof($array_nos)));
                echo "no selecionado: ".$no_selecionado."<br>";
            }else{
            
            }
            
            //CRIA NOVO NÓ========================================================================================
            $array_nos[] = array(
                                    'id'        => $cont,
                                    'pai'       => ($cont > 1 ? ($no_selecionado) : 'Início'),
                                    'qtd_filhos'=> 0
                                );
            
            //INCREMENTA QUANTIDADE DE FILHOS=====================================================================
            
            
            if($cont > 1){
                $qtd = 0;
                foreach ($array_nos as $val){
                    if($val['pai'] == $no_selecionado){
                        $qtd++;
                    }
                }
                $array_nos[$no_selecionado-1]['qtd_filhos'] = $qtd;
                // $id_pai = (($array_nos[$no_selecionado - 1]['$pai']) - 1);
                // echo "ID_SELE: ".$array_nos[$no_selecionado - 1]['id']."<br> ID PAI SELE: ".$id_pai."<br><br>";
                /*$id_pai = ($array_nos[$no_selecionado-1]['id']);
                echo "ID_SELE: ".$array_nos[$no_selecionado]['id']."<br> ID PAI SELE: ".$id_pai."<br><br>";
                $array_nos[$pai]['qtd_filhos'] = $array_nos[$pai]['qtd_filhos']+1;
                while(($id_pai) > 0){
                    $array_nos[$pai]['qtd_filhos'] = $array_nos[$pai]['qtd_filhos']+1;
                    echo $array_nos[$no_selecionado-1]['pai']."<br>";
                    $pai = $array_nos[$no_selecionado-1]['pai'];
                    //$pai = "Início";
                }*/
            }
        }
        ?>


        <script>
            google.charts.load('current', {
                packages: ["orgchart"]
              });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
              var data = new google.visualization.DataTable();
              data.addColumn('string', 'Name');
              data.addColumn('string', 'Manager');
              data.addColumn('string', 'ToolTip');

            // For each orgchart box, provide the name, manager, and tooltip to show.
            data.addRows([
                <?php
                echo "[{
                            v: 'Início',
                            f: 'Início'
                          },
                          '', 'The President'
                        ],";
                foreach ($array_nos as $cha => $val){
                    
                    echo "['".$val['id']."', '".$val['pai']."', '".$val['qtd_filhos']."']".($cha+1 == sizeof($array_nos) ? "" : ","); 
                }
                
                /*echo "[{
                        v: 'Jim',
                        f: 'Jim<div>Vice President</div>'
                      },
                      '1', 'VP'
                    ],";*/
              
                ?>
            ]);

            // Create the chart.
            var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
            // Draw the chart, setting the allowHtml option to true for the tooltips.
            chart.draw(data, {
              allowHtml: true
            });
          }
        </script>
        <?php
        /*
        <div align="center" style="width: 100%; margin-bottom: 50px">
            <span class="circulo">
                <?=$val['id']?><br>
                <?='PAI: '.$val['pai']?><br><br>
            </span>
        </div>
        */ 
      ?>
    </body>
</html>

