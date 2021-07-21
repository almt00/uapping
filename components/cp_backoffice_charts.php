<main class="container-fluid main-flex">
    <section class="row">
        <article class="col-12">
            <section class="row sec-top-nucleos">
                <article class="col-12 section-search-home-page-backoffice">
                    <section class="row justify-content-center">
                        <article class="col-12 px-4">
                        </article>
                    </section>
                </article>
            </section>
            <section class="row section-nucleos">
                <article class="col-12 mt-4 px-4 text text-center">
                    <h2 class="h2-admin-administradores-sub d-inline-block mr-2"> Estatísticas </h2>
                </article>
                <article class="col-12 mt-4 px-4 text text-center mb-5">
                    <?php
                    require_once "connections/connection.php";
                    $link  = new_db_connection();
                    if (!$link) {
                        # code...
                        echo "Problem in database connection! Contact administrator!" . mysqli_error();
                    }else{
                        $query ="SELECT interesses.nome_interesse, COUNT(utilizadores_has_interesses.utilizadores_id_utilizador) AS n_utilizadores
FROM utilizadores_has_interesses
INNER JOIN interesses
on utilizadores_has_interesses.interesses_id_interesse = interesses.id_interesse
GROUP BY interesses.nome_interesse";
                        $result = mysqli_query($link,$query);
                        $chart_data="";
                        while ($row = mysqli_fetch_array($result)) {

                            $interesses[]  = $row['nome_interesse']  ;
                            $utilizadores[] = $row['n_utilizadores'];
                        }
                    }
                    ?>
                    <div style="width:100%;height:50%;text-align:center">
                        <div>Utilizadores por interesses </div>
                        <canvas  id="chartjs_bar"></canvas>
                    </div>
                </article>
            </section>
        </article>
    </section>
    <?php include_once "components/cp_footer.php"?>
</main>

<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
    var ctx = document.getElementById("chartjs_bar").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:<?php echo json_encode($interesses); ?>,
            datasets: [{
                backgroundColor: [
                    "#9f61ef",
                    "#61d5ef",
                    "#61ef9a",
                    "#efd061",
                    "#ef6195",
                    "#7040fa",
                    "#ff004e"
                ],
                data:<?php echo json_encode($utilizadores); ?>,
            }]
        },
        options: {

            legend: {
                display: false,
                position: 'bottom',

                labels: {
                    fontColor: '#71748d',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>