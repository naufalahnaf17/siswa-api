<?php

  $res['Error'] = "Token Belum Dimasukan , Harap Masukan Token Pada Header Postman / Http Request Mu";
  $res['Message'] = "You Should Insert Your Token Into Header Option In Postman On GuzzleHttp";
  $res['Example'] = "Bearer *insert Your Token Here  | Bearer abcdefghijklmnopqxxxx";
  return response($res,401);

?>
