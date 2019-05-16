<?php
function img_limit_resize($real,$wid_size){   //�̹������,�����Ұ��α���
	$img_info = GetImageSize("../".$real);
	$img_wid = $img_info[0];
	$img_hei = $img_info[1];
	$img_type = $img_info[mime];
	if($img_wid>$wid_size){ //���ε��̹����� ���ػ������ Ŭ��� �̹��� ������ �������
		$re_hei = (int)(($img_hei*$wid_size)/$img_wid);
		$im=ImageCreate($wid_size,$re_hei); //�̹����� ũ�⸦ ���մϴ�.
		if(ereg('gif',$img_type)){
		  $im2 = imagecreatefromgif('../'.$real);
		}elseif(ereg('jpeg',$img_type)){
		  $im2 = imagecreatefromjpeg('../'.$real);
		}elseif(ereg('png',$img_type)){
		  $im2 = imagecreatefrompng('../'.$real);
		}else{
		  echo "���������ʴ� �̹��������Դϴ�.";
		  exit;
		}
		imagecopyresized($im, $im2,0,0,0,0,$wid_size,$re_hei,$img_wid,$img_hei);
		ImagePNG($im,'../'.$real); //ImagePNG(�̹���, ���������)
	    ImageDestroy($im); // �̹����� ����� �޸� ����
	}
}