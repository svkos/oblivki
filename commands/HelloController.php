<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
    $user_data = array('login'=>'sviridov.kos@rambler.ru', 'password'=>'sviridkos'); // Данные для авторизации					
		$base_url = "http://oblivochki.biz";
		$page_url = 'http://oblivochki.biz/login';
		//$page_url = 'http://oblivochki.biz/campaigns/index';
		//$page_url = 'http://oblivochki.biz';
		//$page_url = 'https://zot-fa.com/share/GlXMfVsgBqM1?sid=409&scheme=http&host=oblivochki.biz&uri=%2fcampaigns%2findex&t=1539928036331&sad=v%2fvHjgcQ%3d%3d&uid=fOR1fpjFTMq7G5t6&uct=1539928036331&kct=0&m=4&ver=7&flags=640&ua=2502795712769829454&v=tm820WRhysbw1e9NIpg0AQ';
		
		$error_page = array();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0");   
		curl_setopt($ch, CURLOPT_COOKIEJAR, '/gearbest2.txt'); 
		curl_setopt($ch, CURLOPT_COOKIEFILE, '/gearbest2.txt'); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Автоматом идём по редиректам
		//curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); // Не проверять SSL сертификат
		//curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0); // Не проверять Host SSL сертификата
		curl_setopt($ch, CURLOPT_URL, $page_url); // Куда отправляем
		//curl_setopt($ch, CURLOPT_REFERER, $base_url); // Откуда пришли
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query($user_data));  
		curl_setopt($ch, CURLOPT_HEADER, 1); 
		/*curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,/*;q=0.8',
			'Accept-Encoding: gzip, deflate',
			'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
			'Cache-Control: max-age=0',
			'Connection: keep-alive',
			'Cookie: rerf=AAAAAFurHrOPCWQaAzJsAg==; ipp_uid2=8oilvQTNBW0DFYTQ/ut961IQRp7gYJQptwaKzxQ==; ipp_uid1=1537941171919; _ym_uid=1537941172213154304; _ym_d=1537941172; ipp_uid=1537941171919/8oilvQTNBW0DFYTQ/ut961IQRp7gYJQptwaKzxQ==; sidebar_hide=0; ipp_key=v1539837710413/v3394bdc53be3fc299ccf57163aeca6afa04ab3/4RZ1MM7wct1ckYbZkDdcWg==; _ym_wasSynced=%7B%22time%22%3A1539837929615%2C%22params%22%3A%7B%22eu%22%3A0%7D%2C%22bkParams%22%3A%7B%7D%7D; _ym_isad=2; PHPSESSID=qq3tounqoe94u8244okldhcgam; _csrf=63cd36f36cb16c8f37d244be91396b94de45cbc2d7aa212fce2366292a330b63a%3A2%3A%7Bi%3A0%3Bs%3A5%3A%22_csrf%22%3Bi%3A1%3Bs%3A32%3A%22IHf-ECTwKYDlGcfKWLLH8LjLavSYSqnl%22%3B%7D; _ym_visorc_28193184=w',
			'Host: oblivochki.biz',
			'Referer: http://oblivochki.biz/news/index',
			'Upgrade-Insecure-Requests: 1'
		));*/
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Возвращаем, но не выводим на экран результат
		$response = curl_exec($ch);
		curl_close($ch);
		
		/*$response = array();
		$response['http_code'] = curl_exec($ch);
		$info = curl_getinfo($ch);
		//print_r($info);die;
		if($info['http_code'] != 200 && $info['http_code'] != 404) {
			$error_page[] = array(1, $page_url, $info['http_code']);
		}
		$response['code'] = $info['http_code'];
		$response['errors'] = $error_page;
		curl_close($ch);*/
		var_dump($response);
		
        return ExitCode::OK;
    }
	
}
