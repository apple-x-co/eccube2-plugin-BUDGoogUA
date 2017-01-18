<h2>Google Universal Analytics</h2>

<!--{if $tpl_budgoogua_auth_error_message}-->
  <p>認証に失敗しました。アカウントでアプリケーション認証が済んでいないか、ID・パスワードが間違っています。</p>

<!--{else}-->
  <p>認証に成功しました。</p>
  <!--{if $arrGoogleAnalyticsGraph}-->
  <script src="https://www.google.com/jsapi"></script>
  <script>
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart()
  {
    var data = google.visualization.arrayToDataTable([
    ['日','ページビュー数（PV）','訪問数','ユニークユーザー数（UU）','受注金額'],
    <!--{foreach from=$arrGoogleAnalyticsGraph item=row name=data}-->
    [
      '<!--{$row->getDay()}-->日',
      <!--{$row->getPageviews()}-->,
      <!--{$row->getVisits()}-->,
      <!--{$row->getVisitors()}-->,
      <!--{$arrTotalMerge[$smarty.foreach.data.index].total}-->
    ],
    <!--{/foreach}-->
    ]);

    var options = {
      'fontName'  : 'メイリオ',
      'fontSize'  : 8,
      'height'    : 350,
      'chartArea' : {width: '90%', height: '80%'},
      'legend'    : {position: 'top', textStyle: {color: 'black', fontSize: 12}},
      'pointSize' : 7,
      'seriesType': "line",
      'series'    : {
                      0: {targetAxisIndex: 0, color: '#2689CC'},
                      1: {targetAxisIndex: 0, color: '#F9A819'},
                      2: {targetAxisIndex: 0, color: '#F94B19'},
                      3: {targetAxisIndex: 1, color: '#D8F380', type: 'bars'}
                    },
      'width'     : 1000
    };

    var chart = new google.visualization.ComboChart(document.getElementById('google-chart'));
    chart.draw(data, options);
  }
  $(function () {
    // Google Chart Area より上位に表示させる
    $('#navi li').css('z-index', 10);
  });
  </script>
  <h2>アクセス情報&nbsp;[&nbsp;表示期間：<!--{$strGoogleAnalyticsStartDate}-->&nbsp;～&nbsp;<!--{$strGoogleAnalyticsEndDate}-->&nbsp;]</h2>
  <div id="google-chart" style="width:100%;height:350px;margin: 0 0 10px 0;"></div>
  <!--{/if}-->
<!--{/if}-->