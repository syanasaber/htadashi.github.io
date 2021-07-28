<?
require_once ('../ini.php');
require_once ('../strDefine.php');
require_once ('../aki-lib.php');
require_once ('../ipAddrs.php');
require_once ('../common/cmnMkTagOptions.php');
require_once ('../common/cmnMakeConnectPgsDb.php');
require_once ('../common/cmnTax.php');

//	/*	認証	*/	★これ最後にやる★
//	if(!$_SESSION[staffId]){
//		echo "loginTimeOver or inccurentLogin
//		<br>back to <a href='$GLOBALS[topUrl]' target = '_top'>$GLOBALS[topUrl]</a> and register in your favorite.";
//		exit;
//	}


	$conn			= cmnMakeConnectPgsDb();

	$today		= getdate();
	$fYear		= (($_POST[fYear])?$_POST[fYear]:$today[year]);
	$fMonth		= (($_POST[fMonth])?$_POST[fMonth]:sprintf('%02d',$today[mon]));
	$fDay		= (($_POST[fDay])?$_POST[fDay]:$today[mday]);
	$targetYMD	= $fYear . '/' . sprintf('%02d',$fMonth) . '/' .  sprintf('%02d',$fDay);


	/*	例です	*/
	$sql	= "select m.m_lease_id, m.lease_nm,t.r36,t.r48,t.r60,t.r72,t.r84,t.r96
				from m_lease m, t_lease_rate t
				where
				m.m_lease_id = t.m_lease_id
				and flg_kessai = '1'
				and lease_ct = '2'
				and m.flg_del != '1'
				and t.flg_del != '1'";

	$rs	= pg_query($conn,$sql);

	for($i = 0;$i<pg_numrows($rs);$i++){
        $lease_id			= pg_result($rs,$i,m_lease_id);
		$lease_nm			= pg_result($rs,$i,lease_nm);
		$r36			= pg_result($rs,$i,r36);
		$r48			= pg_result($rs,$i,r48);
		$r60			= pg_result($rs,$i,r60);
		$r72			= pg_result($rs,$i,r72);
		$r84			= pg_result($rs,$i,r84);
		$r96			= pg_result($rs,$i,r96);
		$arrCrRt[$lease_id][36] = $r36;
		$arrCrRt[$lease_id][48] = $r48;
		$arrCrRt[$lease_id][60] = $r60;
		$arrCrRt[$lease_id][72] = $r72;
		$arrCrRt[$lease_id][84] = $r84;
		$arrCrRt[$lease_id][96] = $r96;
        $option .= "<option  value='$lease_id'>$lease_nm</option>";
		$arrYmkeLease[nm][$lease_id] = $lease_nm;
	}

	$tar_lease_id = $_GET[m_lease_id];
	$tar_lease_nm = $arrYmkeLease[nm][$tar_lease_id];


$arrYmkKbn = array(1=>'基本プラン', 2=>'取材・撮影', 3=>'制作', 4=>'その他');
/*

*/
$arrSmtl[1][1]=array('itemId'=>1,'itemNm'=>'ティアードワークス　ソフトウェア','tni'=>'','tnk'=>'1200000','itm_nt'=>'','note'=>'');
$arrSmtl[1][2]=array('itemNm'=>'ナミックスオンライン　ソフトウェア','tni'=>'','tnk'=>'1200000','itm_nt'=>'','note'=>'');
$arrSmtl[1][3]=array('itemNm'=>'アイスワン　ソフトウェア','tni'=>'','tnk'=>'1200000','itm_nt'=>'','note'=>'');
$arrSmtl[1][4]=array('itemNm'=>'ウェブジェネ　ソフトウェア','tni'=>'','tnk'=>'1000000','itm_nt'=>'','note'=>'');
$arrSmtl[1][5]=array('itemNm'=>'スマジェネ　ソフトウェア','tni'=>'','tnk'=>'1000000','itm_nt'=>'','note'=>'');
$arrSmtl[1][6]=array('itemNm'=>'スムース　ソフトウェア','tni'=>'','tnk'=>'1000000','itm_nt'=>'','note'=>'');
$arrSmtl[2][7]=array('itemNm'=>'操作・レクチャー費用（訪問）','tni'=>'式','tnk'=>'30000','itm_nt'=>'1回の2時間程度の訪問で、操作、レクチャーを行う','note'=>'');
$arrSmtl[3][8]=array('itemNm'=>'ディレクション費用','tni'=>'式','tnk'=>'100000','itm_nt'=>'','note'=>'');
$arrSmtl[3][9]=array('itemNm'=>'サイト構成作成','tni'=>'式','tnk'=>'150000','itm_nt'=>'サイトマップ、ディレクトリ構成の構築','note'=>'');
$arrSmtl[3][10]=array('itemNm'=>'トップﾍﾟｰｼﾞデザイン費用','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'100000','itm_nt'=>'デザイン案３ﾊﾟﾀｰﾝまで、追加デザインについては別途費用','note'=>'');
$arrSmtl[3][11]=array('itemNm'=>'トップﾍﾟｰｼﾞ追加デザイン費用','tni'=>'ﾊﾟﾀｰﾝ','tnk'=>'50000','itm_nt'=>'追加デザイン','note'=>'');
$arrSmtl[3][12]=array('itemNm'=>'トップﾍﾟｰｼﾞコーディング費用Ａ','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'100000','itm_nt'=>'静的ﾍﾟｰｼﾞ制作','note'=>'');
$arrSmtl[3][13]=array('itemNm'=>'トップﾍﾟｰｼﾞコーディング費用Ｂ','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'200000','itm_nt'=>'動的ﾍﾟｰｼﾞ制作','note'=>'');
$arrSmtl[3][14]=array('itemNm'=>'下層ﾍﾟｰｼﾞ作成費用','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'30000','itm_nt'=>'トップﾍﾟｰｼﾞデザインに準拠','note'=>'');
$arrSmtl[3][15]=array('itemNm'=>'下層ﾍﾟｰｼﾞコーディング費用','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'20000','itm_nt'=>'','note'=>'');
$arrSmtl[3][16]=array('itemNm'=>'メールフォーム構築','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'50000','itm_nt'=>'既存もしくは新規にメールフォームを利用しﾍﾟｰｼﾞを作成する場合','note'=>'');
$arrSmtl[3][17]=array('itemNm'=>'サイトポリシー・利用規約','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'50000','itm_nt'=>'','note'=>'');
$arrSmtl[3][18]=array('itemNm'=>'新規文章作成','tni'=>'ｾｯﾄ','tnk'=>'5000','itm_nt'=>'お客様のご用意の文章を入力。','note'=>'');
$arrSmtl[3][19]=array('itemNm'=>'各種HTMLの修正作業費用','tni'=>'ｾｯﾄ','tnk'=>'3000','itm_nt'=>'画像の配置、テキスト色・装飾、リンク設定など。','note'=>'');
$arrSmtl[3][20]=array('itemNm'=>'ライティング費用','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'20000','itm_nt'=>'文章新規構築','note'=>'');
$arrSmtl[3][21]=array('itemNm'=>'レスポンシブ用CSS構築','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'60000','itm_nt'=>'レスポンシブ対応','note'=>'');
$arrSmtl[3][22]=array('itemNm'=>'FLASH 作成(プランA)','tni'=>'ｾｯﾄ','tnk'=>'100000','itm_nt'=>'写真5枚-おまかせ秒　※動きの指定可能、音源はMP3,MIDIなど','note'=>'音声追加可能（別途費用）');
$arrSmtl[3][23]=array('itemNm'=>'FLASH 作成(プランB)','tni'=>'ｾｯﾄ','tnk'=>'50000','itm_nt'=>'写真3枚-10秒以内　※動きの指定可能、音源はMP3,MIDIなど','note'=>'音声追加可能（別途費用）');
$arrSmtl[3][24]=array('itemNm'=>'FLASH 作成(プランC)','tni'=>'ｾｯﾄ','tnk'=>'30000','itm_nt'=>'写真2枚-5秒以内　※動きの指定可能、音源はなし','note'=>'音声追加可能（別途費用）');
$arrSmtl[3][25]=array('itemNm'=>'ブログ設定','tni'=>'ｾｯﾄ','tnk'=>'30000','itm_nt'=>'ブログサイトの申込代行・設定手数料','note'=>'※別途設定費用');
$arrSmtl[3][26]=array('itemNm'=>'ポップアップ作成・設置費','tni'=>'点','tnk'=>'5000','itm_nt'=>'テキストのポップアップや画像の設置　','note'=>'');
$arrSmtl[3][27]=array('itemNm'=>'google map設置費','tni'=>'点','tnk'=>'30000','itm_nt'=>'google mapを利用して地図を表示させる','note'=>'');
$arrSmtl[3][28]=array('itemNm'=>'地図の追加　/　1地図あたり','tni'=>'点','tnk'=>'5000','itm_nt'=>'google mapを利用して地図を追加する','note'=>'');
$arrSmtl[3][29]=array('itemNm'=>'イラスト素材作成費用','tni'=>'点','tnk'=>'30000','itm_nt'=>'指定の画像、キャラクターなど用途にあったイラストを作成する','note'=>'');
$arrSmtl[3][30]=array('itemNm'=>'フラッシュ素材の作成費用','tni'=>'点','tnk'=>'70000','itm_nt'=>'FLASHサイトを作る際などの素材作成','note'=>'');
$arrSmtl[3][31]=array('itemNm'=>'動画作成費用','tni'=>'式','tnk'=>'100000','itm_nt'=>'動画、FlASH動画の撮影から設置までを行う','note'=>'');
$arrSmtl[3][32]=array('itemNm'=>'ホームﾍﾟｰｼﾞのBGM設置','tni'=>'式','tnk'=>'15000','itm_nt'=>'ホームﾍﾟｰｼﾞ内のBGMをサイト内へ設置する','note'=>'');
$arrSmtl[3][33]=array('itemNm'=>'アクセスカウンターの設置・設定','tni'=>'式','tnk'=>'5000','itm_nt'=>'ソフトを利用し、HPのアクセス数を検索','note'=>'');
$arrSmtl[3][34]=array('itemNm'=>'アクセス制限/設置・設定費用','tni'=>'式','tnk'=>'30000','itm_nt'=>'ファイル毎にパスワード・ID入力を行い、閲覧制限をかけます。','note'=>'');
$arrSmtl[3][35]=array('itemNm'=>'スマートホンサイト トップﾍﾟｰｼﾞデザイン費用','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'100000','itm_nt'=>'デザイン案３ﾊﾟﾀｰﾝまで、追加デザインについては別途費用','note'=>'');
$arrSmtl[3][36]=array('itemNm'=>'スマートホンサイト トップﾍﾟｰｼﾞ追加デザイン費用','tni'=>'ﾊﾟﾀｰﾝ','tnk'=>'50000','itm_nt'=>'追加デザイン','note'=>'');
$arrSmtl[3][37]=array('itemNm'=>'スマートホンサイト トップﾍﾟｰｼﾞコーディング費用','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'100000','itm_nt'=>'','note'=>'');
$arrSmtl[3][38]=array('itemNm'=>'スマートホンサイト 下層ﾍﾟｰｼﾞ作成費用','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'30000','itm_nt'=>'トップﾍﾟｰｼﾞデザインに準拠','note'=>'');
$arrSmtl[3][39]=array('itemNm'=>'スマートホンサイト 下層ﾍﾟｰｼﾞコーディング費用','tni'=>'ﾍﾟｰｼﾞ','tnk'=>'20000','itm_nt'=>'','note'=>'');
$arrSmtl[3][40]=array('itemNm'=>'バナー製作費用','tni'=>'点','tnk'=>'30000','itm_nt'=>'リンクﾍﾟｰｼﾞに設置する。','note'=>'');
$arrSmtl[3][41]=array('itemNm'=>'ロゴ製作費用','tni'=>'点','tnk'=>'50000','itm_nt'=>'基本デザインの選択から、ご希望のイメージ、カラー決定後製作','note'=>'');
$arrSmtl[3][42]=array('itemNm'=>'SEO対策費用','tni'=>'式','tnk'=>'300000','itm_nt'=>'SEO対策ソフトを使い、対象サイトの検索エンジン最適化を行う','note'=>'');
$arrSmtl[4][43]=array('itemNm'=>'通販システム','tni'=>'式','tnk'=>'500000','itm_nt'=>'商品5点初期登録ｾｯﾄ価格。','note'=>'');
$arrSmtl[4][44]=array('itemNm'=>'アンケート専用ﾍﾟｰｼﾞの追加','tni'=>'式','tnk'=>'100000','itm_nt'=>'アンケート形式のﾍﾟｰｼﾞ作成、メールフォームの設置','note'=>'');
$arrSmtl[4][45]=array('itemNm'=>'不動産検索システム','tni'=>'式','tnk'=>'300000','itm_nt'=>'特定不動産を調べられるシステム','note'=>'');
$arrSmtl[4][46]=array('itemNm'=>'ブログシステム','tni'=>'式','tnk'=>'150000','itm_nt'=>'ブログシステム作成','note'=>'');
$arrSmtl[4][47]=array('itemNm'=>'CMS構築費用','tni'=>'式','tnk'=>'300000','itm_nt'=>'ﾍﾟｰｼﾞ内テキスト・画像簡易更新可能。','note'=>'');
$arrSmtl[4][48]=array('itemNm'=>'ランディングサイト','tni'=>'式','tnk'=>'1000000','itm_nt'=>'ホームﾍﾟｰｼﾞ連動用ランディングサイト作成','note'=>'');

//与信管理にdata飛ばすための
$arrProductId = array(24=>'ホームページ制作', 25=>'ホームページ制作費用', 88=>'スムース',89=>'スムース(ホームページ作成費用)');
$arrLeaseId = array(3 =>'BPｸﾚｼﾞｯﾄ',5 =>'SMBCﾌｧｲﾅﾝｽｻｰﾋﾞｽ',9=>'ｵﾘｺｸﾚｼﾞｯﾄ',10=>'ｼﾞｬｯｸｽｸﾚｼﾞｯﾄ',32=>'ｱﾌﾟﾗｽｸﾚｼﾞｯﾄ',45 =>'ｼｬｰﾌﾟﾌｧｲﾅﾝｽｸﾚｼﾞｯﾄ');

//商品アイテムId　javascript処理用配列　1=>スムース  2=>HPのみにわけて配列作成
$arrSendItm = "var arrJsSendItmId = new Array(); \n arrJsSendItmId[1] = []; \n arrJsSendItmId[2] =[]; \n
arrJsSendItmId[1][3] = 88;
arrJsSendItmId[1][5] = 89;
arrJsSendItmId[1][9] = 89;
arrJsSendItmId[1][10] = 88;
arrJsSendItmId[1][32] = 89;
arrJsSendItmId[1][45] = 88;
arrJsSendItmId[2][3] = 24;
arrJsSendItmId[2][5] = 24;
arrJsSendItmId[2][9] = 25;
arrJsSendItmId[2][10] = 24;
arrJsSendItmId[2][32] = 25;
arrJsSendItmId[2][45] = 25;
";


//デフォルトセッティングの配列　デフォルトボタンで何を設置させるかは、ここの配列でコントロール
$arrDefaItm = "
var hash_arrDefItm = {'sms_snt6': '1',  'sms_snt8':'1',  'sms_snt9': '1',
	'sms_snt10': '1', 'sms_snt12': '1',  'sms_snt14': '9', 'sms_snt15' :'9', 'sms_snt18':'1', 'sms_snt19': '1', 'sms_snt21': '10'};
var defItmId = new Array();


//var arrDefItm = new Array(); arrDefItm[1] = [];
//arrDefItm[1] = Array('sms_snt6','sms_snt8','sms_snt9','sms_snt10','sms_snt12','sms_snt14','sms_snt15','sms_snt18','sms_snt19','sms_snt21');
//arrDefItm[2] = Array('hp_snt6','hp_snt8','hp_snt9','hp_snt10','hp_snt12','hp_snt14','hp_snt15','hp_snt18','hp_snt19','hp_snt21');";


//下層ページ作成、下層ページコーディング、レスポンシブは30個までリスト化
$arrOptQuantity = array(14 => '30', 15 => '30', 21 => '30');
$arrItmId = array();
foreach ($arrOptQuantity as $key => $val){
	array_push($arrItmId, $key);
}

//デフォルトは10個
$optSntMax = 10;
for ($i=0; $i<=$optSntMax;$i++){
	$optSnt .= "<option value='$i'>$i</option>";
}

		//javascript2次元配列　※2次元目を宣言しないとしようできないのがポイント！
		//1次元目の宣言
		$jsArrCorpToRt ="var arrJsCorpToRt =new Array(); \n ";
		foreach($arrCrRt as $lease_id => $arrRate){
			if($lease_id){
				//2次元目の宣言 ↓ =で上書きしないように。
				$jsArrCorpToRt .="arrJsCorpToRt[$lease_id] =[]; \n ";
				 foreach($arrRate as $kaisuu => $ryouritsu){
					 if ($kaisuu && $ryouritsu){
					 $jsArrCorpToRt .= "arrJsCorpToRt[$lease_id][$kaisuu] = $ryouritsu;\n";
					 }
				 }
			 }
		}

		$cnt = 0;
		$item_cnt = 0;
		foreach($arrYmkKbn as $KbnID => $KbnName){
		    $kbn_cnt = count($arrSmtl[$KbnID]);
		    $cnt =0;
		    foreach($arrSmtl[$KbnID] as $itm_id=> $arrAttr){
				$optQuantity = "";
				if(in_array($itm_id, $arrItmId)){
					$optSntMax = $arrOptQuantity[$itm_id];
					for ($i=0; $i<=$optSntMax;$i++){
						$optQuantity .= "<option value='$i'>$i</option>";
					}
				}else {
					$optQuantity = $optSnt;
				}
				$item_cnt++;
		        $itemTnk = number_format($arrAttr[tnk]);
		        if ($cnt == 0){
		            $addStl = "style='border-top:3px double #cccccc; background-color:;'";
		            $addTg  = "<th rowspan='$kbn_cnt' class='cccccc t_left' style='background-color:#ffcc66;' nowrap>$KbnName</th>";
		        }else{
		            $addTg  = $addStl = "";
		        }
		            $tag .= "<tr id='tr_select$itm_id' $addStl>
		            $addTg
		            <th class='cccccc t_left' nowrap>{$arrAttr[itemNm]}</th>
		            <th class='cccccc t_right'><input type='tel'  name='tnk$itm_id' value='$itemTnk' style='font-weight:bold; width:85px; text-align: right; border: #ffffff;' readonly>
		            <input type='hidden' id='tnk$itm_id'  value='{$arrAttr[tnk]}' ></th>
		            <td class='cccccc t_left' nowrap><select id='sms_snt{$itm_id}' name='sms_snt{$itm_id}' value=''
		            	style='width:45px; height:21px; text-align: right;' onChange=\"smlt_sbTtl($itm_id,'sms');\">$optQuantity</select>{$arrAttr[tni]}</td>
		            <td class='cccccc t_center' style='border-left:2px solid black; border-right:2px solid black;'
						nowrap><input type='tel' id='sms_sbTtl{$itm_id}' name='sms_sbTtl{$itm_id}'  value=''  style='width:85px; text-align: right; border: #ffffff;' readonly></td>
		            <td class='cccccc t_left' nowrap><select id='hp_snt{$itm_id}' name='hp_snt{$itm_id}' value='' style='width:45px; height:21px; text-align: right;'
						onChange=\"smlt_sbTtl($itm_id, 'hp');\">$optQuantity</select>{$arrAttr[tni]}</td>
		            <td class='cccccc t_center' style='border-left:2px solid black; border-right:2px solid black;'
						nowrap><input type='tel' id='hp_sbTtl{$itm_id}' name='hp_sbTtl{$itm_id}' value=''  style='width:85px; text-align: right; border: #ffffff;' readonly></td>
		            <td class='cccccc t_left' colspan='3' owrap>{$arrAttr[itm_nt]}</td>
		            <td class='cccccc t_left' nowrap>{$arrAttr[note]} </td>
		            </tr>";
		        $cnt++;
		    }
		}

		$tax = cmnRetTax($targetYMD);


$javascript ="
	function smlt_sbTtl(itm_id,ct) {
	    var elm_tnk = 'tnk' + itm_id;
	    var elm_sms_snt = ct + '_snt' + itm_id;
	    var elm_sms_sbTtl = ct + '_sbTtl' + itm_id;
	    var tnk = document.getElementById(elm_tnk).value;
	    var sms_snt = document.getElementById(elm_sms_snt).value;
		if (isNaN(sms_snt)){
			alert('数値の入力形式が違います。(半角数字で入力してください)');
		}
	    var sms_sbTotal = tnk * sms_snt;
	    document.getElementById(elm_sms_sbTtl).value = Number(sms_sbTotal).toLocaleString();
		if (sms_sbTotal){
			document.getElementById('tr_select' + itm_id).style.backgroundColor = '#33ffcc';
		}else {
			document.getElementById('tr_select' + itm_id).style.backgroundColor = null;
		}

		var elm_sbTtl = ct + '_sbTtl';
		sum_sbTtl(elm_sbTtl);
	}

	function calculateRt() {
	    var elm_lease_id = document.getElementById('creditcorp').value;
	    var elm_kaisuu = document.getElementById('kaisuu').value;
		var getugaku = document.getElementById('getugaku').value;
		var ryouritsu = arrJsCorpToRt[elm_lease_id][elm_kaisuu] + '%';
		if (ryouritsu == 'NaN%' || ryouritsu == 'undefined%'){
			ryouritsu = '対応不可';
			document.getElementById('ryouritsu').style.backgroundColor = 'yellow';
		}else {
			document.getElementById('ryouritsu').style.backgroundColor = null;
		}
		document.getElementById('ryouritsu').value = ryouritsu;
		if (ryouritsu != '対応不可'){
			ryouritsu = parseFloat(ryouritsu);
			var crSellPrice = parseInt(getugaku * (elm_kaisuu/((100 + ryouritsu)/100)));
		}
		crSellPrice = judgeNaN(crSellPrice);
		document.getElementById('sms_crSellPr').value = Number(crSellPrice).toLocaleString();
		document.getElementById('hp_crSellPr').value = Number(crSellPrice).toLocaleString();
		downPricePer();
	}

	function sum_sbTtl(elmSbTtl) {
		sum = 0;
		for(i=1; i < $item_cnt + 1; i++){
			var subTtl = document.getElementById(elmSbTtl + i).value;
			var subTlInt = removeComma(subTtl);
			if (isNaN(subTlInt)){
				sum += 0;
			}else {
				sum += subTlInt;
			}
		}
		var elm_goukei = elmSbTtl + 'Sum';
		document.getElementById(elm_goukei).value = Number(sum).toLocaleString();
		downPricePer();
	}

	function snt_resetDefault(def){
		$arrDefaItm
		for (var key in hash_arrDefItm) {
			 defItmId.push(key);
		}
			for(i=1; i < $item_cnt + 1; i++){
				var elm_sms_snt = 'sms_snt' + i;
				var elm_hp_snt = 'hp_snt' + i;
				var judge = defItmId.indexOf(elm_sms_snt);
				if (judge != -1){
						document.getElementById(elm_sms_snt).value = hash_arrDefItm[elm_sms_snt];
						document.getElementById('tr_select' + i).style.backgroundColor = '#33ffcc';
				}else {
					document.getElementById(elm_sms_snt).value = null;
				}
				document.getElementById(elm_hp_snt).value = null;
			}
			smlt_afterDef();
	}

	function downPricePer(){
		var sms_subTtl = document.getElementById('sms_sbTtlSum').value;
		sms_subTtl = removeComma(sms_subTtl);
		var sms_crSelPr = document.getElementById('sms_crSellPr').value;
		sms_crSelPr = removeComma(sms_crSelPr);
		var hp_subTtl = document.getElementById('hp_sbTtlSum').value;
		hp_subTtl = removeComma(hp_subTtl);
		var hp_crSelPr = document.getElementById('hp_crSellPr').value;
		hp_crSelPr = removeComma(hp_crSelPr);

		var sms_downPrPer = (1 - (sms_crSelPr/sms_subTtl)) * 100;
		sms_downPrPer = judgeNaN(sms_downPrPer);
		document.getElementById('sms_downPrPer').value = Math.round(sms_downPrPer) + '%';
		var sms_downPrice = sms_crSelPr - sms_subTtl;
		sms_downPrice = judgeNaN(sms_downPrice);
		document.getElementById('sms_downPrice').value = Number(sms_downPrice).toLocaleString();


		var hp_downPrPer = (1 - (hp_crSelPr/hp_subTtl)) * 100;
		hp_downPrPer = judgeNaN(hp_downPrPer);
		document.getElementById('hp_downPrPer').value = Math.round(hp_downPrPer) + '%';
		var hp_downPrice = hp_crSelPr - hp_subTtl;
		hp_downPrice = judgeNaN(hp_downPrice);
		document.getElementById('hp_downPrice').value = Number(hp_downPrice).toLocaleString();
	}

	function smlt_afterDef() {
		for(i=1; i < $item_cnt + 1; i++){
			var elm_tnk = 'tnk' + i;
			var elm_sms_snt = 'sms_snt' + i;
			var elm_sms_sbTtl = 'sms_sbTtl' + i;
			var elm_hp_snt = 'hp_snt' + i;
			var elm_hp_sbTtl = 'hp_sbTtl' + i;

			var tnk = document.getElementById(elm_tnk).value;
			var sms_snt = document.getElementById(elm_sms_snt).value;
			var hp_snt = document.getElementById(elm_hp_snt).value;
			var sms_sbTotal = tnk * sms_snt;
			var hp_sbTotal = tnk * hp_snt;

			document.getElementById(elm_sms_sbTtl).value = Number(sms_sbTotal).toLocaleString();
			document.getElementById(elm_hp_sbTtl).value =  Number(hp_sbTotal).toLocaleString();
		}
		sum_sbTtl('sms_sbTtl');
		sum_sbTtl('hp_sbTtl');
	}

	function setValYoshin() {
		$arrSendItm
		var lease_id = document.getElementById('creditcorp').value;
		var sms_total = document.getElementById('sms_sbTtlSum').value;
		var hp_total = document.getElementById('hp_sbTtlSum').value;
		var sendItmId;
		if (sms_total || hp_total){
			if (sms_total != 0 && hp_total != 0){
				alert('スムースとHP制作両方の合計をセットすることは出来ません。');
				sendItmId = null;
				return false;
			}else if (sms_total != 0 && hp_total == 0){
				sendItmId = arrJsSendItmId[1][lease_id];
			}else if (hp_total != 0 && sms_total == 0){
				sendItmId = arrJsSendItmId[2][lease_id];
			}
		}
		if (!sms_total && !hp_total || (sms_total == 0 && hp_total == 0)){
			alert('スムースかHP制作どちらかの合計金額をセットしてください。');
			sendItmId = null;
			return false;
		}
		if (sendItmId == undefined){
			sendItmId = null;
		}
		document.getElementById('sendItmId').value = sendItmId;



		var arrIsTextChk	= new Array('pay_num_select','month_sum_inc','itm_cnt_0','itm_prc_0','itm_nm_select_0');
		var obj;
		var objCount = 0;
		var flgIsText = false;
		if(arrIsTextChk.length > 0){
			for(var i=0;i<arrIsTextChk.length;i++){
				obj = eval('window.opener.document.mtmr.' + arrIsTextChk[i]);
				if(obj){
					objCount++;
					if(obj.value){
						flgIsText = true;
					}
				}
			}
		}
		if(objCount != arrIsTextChk.length){
			alert('エラー：正しく入力できません');
			return false;
		}
		if(flgIsText){
			if (!confirm('もともと入力されていた見積り情報を上書きします。よろしいですか？')){return false;}
		}

		if(sms_total){
			var total = sms_total;
		}else{
			var total = hp_total;
		}

		var getugakuInTax = document.getElementById('getugaku').value * (1 + {$tax})
		window.opener.document.mtmr.month_sum_inc.value	 = 		parseInt(getugakuInTax, 10);
		window.opener.document.mtmr.itm_cnt_0.value		 = 		'1';
		window.opener.document.mtmr.itm_prc_0.value		 = 		total;

		//支払回数はid='kaisuu'(回数) ではなく id='ryouritsu'(料率) で選択する
		var flgPayNum = 0;
		var ryo = document.getElementById('ryouritsu').value.replace(/%/g,''); //料率から%を省く
		var slct = window.opener.document.mtmr.pay_num_select;
		for(var i=0;i<slct.length;i++){
			if(slct.options[i].value == ryo){
				slct.selectedIndex = i;
				flgPayNum = 1;
			}
		}

		//商品名1行目
		var flgItmNm = 0;
		var slct = window.opener.document.mtmr.itm_nm_select_0;
		for(var i=0;i<slct.length;i++){
			if(slct.options[i].value == document.getElementById('sendItmId').value){
				//alert('index:' + i + ' value:' + slct.options[i].value);
				slct.selectedIndex = i;
				flgItmNm = 1;
			}
		}
		if(!flgPayNum || !flgItmNm){ alert('支払回数か商品名が反映されませんでした。'); }

		//値セット後親ウィンドウの自動計算ｽｸﾘﾌﾟﾄをたたく
		window.opener.monthSumIncToExc();
		window.opener.chkRate();
		window.opener.calcSim();
		window.opener.autoSummary('itm_cnt_0', 'itm_prc_0', 'itm_sum_0');
		window.opener.checkNumber('itm_cnt_0','itm_prc_0');

//		window.open('about:blank','_self').close();	2020/12/16 12:16:32	井上さん要望
	}

	function selColorReset() {
		for(i=1; i < $item_cnt + 1; i++){
			document.getElementById('tr_select' + i).style.backgroundColor = null;
		}
	}

	function roundFloat( number, n ) {
	  var _pow = Math.pow( 10 , n );
	  return Math.round( number * _pow ) / _pow;
	}

	function removeComma(number) {
	    var removed = number.replace(/,/g, '');
	    return parseInt(removed, 10);
	}

	function judgeNaN(num){
		if (isNaN(num)){
			num = 0;
			return num;
		}else {
			return num;
		}
	}

";

//<select id='creditcorp' name='creditcorp' onChange='calculateRt();'>$option</select>

echo <<< EOL
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta http-equiv="Content-Language" content="ja">
<LINK REL="stylesheet" TYPE="text/css" HREF="../mm.css">
<title>シミュレートチェック</title>
</head>
<body onload="calculateRt();">
<form name='smlt'>
<table class="f_9 cccccc collapse" style="word-break: break-all;  word-wrap: break-all; ">
<tr >
    <th class='t_right' >信販：</th>
    <td>
		$tar_lease_nm<input type='hidden' id='creditcorp' name='creditcorp' value='{$tar_lease_id}'  onChange='calculateRt();'>
		<!--<select id='creditcorp' name='creditcorp' onChange='calculateRt();'>$option</select>-->
	</td>

    <td colspan='2'></td>
    <td class='t_center bold' style='border-top:2px solid black; border-left:2px solid black; border-right:2px solid black;'>スムース</td>
    <td class='t_center bold' style='color:red;'>値引き</td>
    <td class='t_center bold' style='border-top:2px solid black; border-left:2px solid black; border-right:2px solid black;'>HP制作のみ</td>
    <td class='t_center bold' style='color:red; border-right:1px solid #CCCCCC;'>値引き</td>
	<td></td>
	<td></td>
	<td class='t_center' style='padding:4px;'><input type="reset" style="display: inline-block; padding: 0.35em 0.5em; text-decoration: none; background: #668ad8;
	color: #FFF; border-bottom: solid 4px #627295;" value="リセット" onclick="selColorReset();"></td>
</tr>
<tr>
    <th class='t_right' nowrap>月額(税抜)</th>
    <td><input type='tel'  id='getugaku' value=''  style='width:80px; text-align: right; ' onChange='calculateRt();' ><input type='button' value='計算' onclick='calculateRt();'>　
    <input type='tel' id='ryouritsu' value='%'  style='width:70px; text-align: right; border: #ffffff; background-color:;' readonly></td>

    <th colspan='2' class='t_right' style='border-left:1px solid #CCCCCC; border-top:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;' nowrap>クレジット販売金額(税抜)</th>
    <td class='t_center' style='border-left:2px solid black; border-right:2px solid black; border-top:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;'><input type='tel'  id='sms_crSellPr' value=''  style='font-weight:bold;
		font-size:16px; padding:0px;height:25px; width:85px;text-align: right; border: #ffffff; background-color:#ccffcc;' readonly></td>
    <td style='border-top:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;'><input type='tel'  id='sms_downPrice' value=''  style='font-weight:bold;
		font-size:16px; padding:0px;height:25px; width:85px; text-align: right; border: #ffffff; color:red;' readonly></td>
    <td class='t_right' style='border-left:2px solid black; border-right:2px solid black; border-top:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;'><input type='tel'  id='hp_crSellPr' value=''
		style='font-weight:bold; font-size:16px; padding:0px;height:25px; width:85px; text-align: right; border: #ffffff; background-color:#ccffcc;' readonly></td>
    <td class='t_right' style='border-top:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC; border-right:1px solid #CCCCCC;'><input type='tel'  id='hp_downPrice' value=''
		style='font-weight:bold; font-size:16px; padding:0px;height:25px; width:85px; text-align: right; border: #ffffff; color:red;' readonly></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
    <th class='t_right'>回数</th>
    <td>
        <select id='kaisuu' name='kaisuu' onChange='calculateRt();'>
            <option value='36'>36</option>
            <option value='48'>48</option>
            <option value='60'>60</option>
            <option value='72'>72</option>
            <option value='84'>84</option>
            <option value='96'>96</option>
        </select>
		<input type='tel' id='sendItmId' name='sendItmId'  value=''  style='width:85px; text-align: right; border: #ffffff;' readonly>
    </td>
    <th colspan='2' class='t_right' style='border-left:1px solid #CCCCCC;' nowrap>価格表設定金額(税抜)</th>
    <td class='t_center' style='border-left:2px solid black; border-right:2px solid black;'><input type='tel'  id='sms_sbTtlSum' value=''
		style='font-weight:bold; font-size:16px; padding:0px;height:25px; width:85px; text-align: right; border: #ffffff; background-color:#ccffcc;' readonly></td>
    <td><input type='tel'  id='sms_downPrPer' value='%'  style='font-weight:bold; font-size:16px; padding:0px;height:25px; width:85px; text-align: right; border: #ffffff;' readonly></td>
    <td class='t_center' style='border-left:2px solid black; border-right:2px solid black;'><input type='tel'  id='hp_sbTtlSum' value=''
		style='font-weight:bold; font-size:16px; padding:0px;height:25px; width:85px; text-align: right; border: #ffffff; background-color:#ccffcc;' readonly></td>
    <td class='t_right' style='border-right:1px solid #CCCCCC;'><input type='tel'  id='hp_downPrPer' value='%'
	style='font-weight:bold; font-size:16px; padding:0px;height:25px; width:85px; text-align: right; border: #ffffff;' readonly></td>
	<td>　<input type='button' style='display: inline-block; padding: 0.35em 0.5em; text-decoration: none; background: #668ad8; color: #FFF; border-bottom: solid 4px #627295; ' value="値セット" onclick='setValYoshin();'></td>

		<td ></td>
		<td class='t_center'><input type='button'  style='position: relative; display: inline-block;
			  padding: 0.5em 1em;
			  text-decoration: none;
			  color: #FFF;
			  background: #fd9535;
			  border-radius: 2px;

			  font-weight: bold;
			  border: solid 2px #d27d00;' value='デフォルト'  onclick="snt_resetDefault('1');">
	  </td>
</tr>
<tr style='background-color:skyblue;'>
    <th class='cccccc t_center'>区分</th>
    <th class='cccccc t_center'>商品名（項目）</th>
    <th class='cccccc t_center'>単価</th>
    <th class='cccccc t_center'>納品数</th>
    <th class='cccccc t_center' style='border-left:2px solid black; border-right:2px solid black;'>納品料金<br>（税抜）</th>
    <th class='cccccc t_center'>納品数</th>
    <th class='cccccc t_center' style='border-left:2px solid black; border-right:2px solid black;'>納品料金<br>（税抜）</th>
    <th colspan='3' class='cccccc t_center'>商品内容（作業内容）</th>
    <th class='cccccc t_center'>備考</th>
</tr>

$tag

</table>
</form>

<script language='javascript'>
$jsArrCorpToRt
$javascript
</script>
<style>
input[type=reset] {  -webkit-appearance: none;}

	th {vertical-align: middle;}
	td {vertical-align: middle;}
</style>

</body>
</HTML>

EOL;








?>
